<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Shiftselesai_Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class Shiftselesaia extends Controller
{
    // Halaman Index (Riwayat Selesai Kunjungan)
    public function index(Request $request)
    {
        $m_selesai = new \App\Models\Shiftselesai_Model();
        $all = collect($m_selesai->listing());

        // Filter pencarian berdasarkan nama, kegiatan, atau catatan
        if ($request->filled('keywords')) {
            $keywords = strtolower($request->keywords);
            $all = $all->filter(function ($item) use ($keywords) {
                return str_contains(strtolower($item->nama), $keywords)
                    || str_contains(strtolower($item->kegiatan), $keywords)
                    || str_contains(strtolower($item->uraian_kegiatan), $keywords);
            });
        }

        // Pagination Manual
        $perPage = 10;
        $page = $request->get('page', 1);
        $slice = $all->slice(($page - 1) * $perPage)->values();
        
        $shift_selesai = new LengthAwarePaginator(
            $slice,
            $all->count(),
            $perPage,
            $page,
            ['path' => url('adminteam/selesai'), 'query' => $request->query()]
        );

        return view('adminteam/layout/wrapper', [
            'title'         => 'Riwayat Selesai Kunjungan',
            'shift_selesai' => $shift_selesai,
            'content'       => 'adminteam/selesaia/index'
        ]);
    }

    // Form Tambah Selesai Kunjungan
    public function tambah()
    {
        $kabupaten   = \App\Models\Kabupaten_Model::all();
        $instansi    = \App\Models\Instansi_Model::all();
        $currentTime = Carbon::now()->format('H:i'); 

        return view('adminteam/layout/wrapper', [
            'title'       => 'Selesaikan Kunjungan',
            'kabupaten'   => $kabupaten,
            'instansi'    => $instansi,
            'currentTime' => $currentTime,
            'content'     => 'adminteam/selesaia/tambah'
        ]);
    }

    // Proses Simpan Data Selesai
    public function proses_tambah(Request $request)
    {
        // 1. Validasi Input sesuai struktur database shift_selesai
        $request->validate([
            'nama'               => 'required|string|max:255',
            'kegiatan'           => 'required|in:kunjungan,byWA',
            'kabupaten_id'       => 'required|integer',
            'instansi_id'        => 'required|integer',
            'uraian_kegiatan'    => 'required|string',
            'catatan_berikutnya' => 'nullable|string',
            'foto'               => 'required|image|mimes:jpeg,png,jpg|max:8024'
        ]);

        $now = Carbon::now();

        // 2. Upload Foto
        $nama_file = null;
        if ($file = $request->file('foto')) {
            $filename  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('admin/upload/selesai'), $nama_file);
        }

        // 3. Susun data (tanpa link_reset karena default NULL)
        $data = [
            'nama'                        => $request->nama,
            'jam_selesai'                 => $now->format('H:i:s'),
            'tanggal_shift'               => $now->format('Y-m-d'),
            'kegiatan'                    => $request->kegiatan,
            'foto'                        => $nama_file,
            'uraian_kegiatan'             => $request->uraian_kegiatan,
            'catatan_shift_selanjutnya'   => $request->catatan_berikutnya,
            'kabupaten_id'                => $request->kabupaten_id,
            'instansi_id'                 => $request->instansi_id,
            'link_reset'                  => null
        ];

        // 4. Simpan ke database via Model
        $m_selesai = new \App\Models\Shiftselesai_Model();
        $m_selesai->tambah($data);

        return redirect('adminteam/selesaia')->with('sukses', 'Laporan selesai kunjungan berhasil disimpan');
    }

    public function edit($id)
    {
        $m_selesai = new \App\Models\Shiftselesai_Model();
        $detail    = $m_selesai->detail($id);

        // Jika data tidak ditemukan, kembalikan ke halaman index dengan pesan error
        if (!$detail) {
            return redirect('adminteam/selesaia')->with('error', 'Data riwayat kunjungan tidak ditemukan');
        }

        // Mengambil data pendukung untuk dropdown pilihan di form edit
        $kabupaten = \App\Models\Kabupaten_Model::all();
        $instansi  = \App\Models\Instansi_Model::all();

        return view('adminteam/layout/wrapper', [
            'title'     => 'Edit Riwayat Selesai Kunjungan',
            'detail'    => $detail,
            'kabupaten' => $kabupaten,
            'instansi'  => $instansi,
            'content'   => 'adminteam/selesaia/edit' // Arahkan ke berkas view edit Anda
        ]);
    }

    // Proses Simpan Pembaruan Data Selesai Kunjungan
    public function proses_edit(Request $request)
    {
        // 1. Tambahkan validasi untuk jam_selesai dan tanggal_shift
        $request->validate([
            'id_selesai'         => 'required',
            'nama'               => 'required|string|max:255',
            'jam_selesai'        => 'required', // Tambahan validasi jam
            'tanggal_shift'      => 'required|date', // Tambahan validasi tanggal
            'kegiatan'           => 'required|in:kunjungan,byWA',
            'kabupaten_id'       => 'required|integer',
            'instansi_id'        => 'required|integer',
            'uraian_kegiatan'    => 'required|string',
            'catatan_berikutnya' => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpeg,png,jpg|max:8024'
        ]);

        $id_selesai = $request->id_selesai;
        $m_selesai  = new \App\Models\Shiftselesai_Model();
        $detail     = $m_selesai->detail($id_selesai);

        if (!$detail) {
            return redirect('adminteam/selesaia')->with('error', 'Gagal memperbarui, data tidak ditemukan');
        }

        $nama_file = $detail->foto;

        if ($file = $request->file('foto')) {
            if (!empty($detail->foto)) {
                $old_path = public_path('admin/upload/selesai/' . $detail->foto);
                if (file_exists($old_path)) {
                    @unlink($old_path);
                }
            }

            $filename  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/upload/selesai'), $nama_file);
        }

        // 2. Masukkan jam_selesai dan tanggal_shift ke dalam array data untuk diupdate
        $data = [
            'id_selesai'                 => $id_selesai,
            'nama'                       => $request->nama,
            'jam_selesai'                => $request->jam_selesai, // Menyimpan perubahan jam baru
            'tanggal_shift'              => $request->tanggal_shift, // Menyimpan perubahan tanggal baru
            'kegiatan'                   => $request->kegiatan,
            'foto'                       => $nama_file,
            'uraian_kegiatan'            => $request->uraian_kegiatan,
            'catatan_shift_selanjutnya'  => $request->catatan_berikutnya,
            'kabupaten_id'               => $request->kabupaten_id,
            'instansi_id'                => $request->instansi_id,
        ];

        $m_selesai->edit($data);

        return redirect('adminteam/selesaia')->with('sukses', 'Laporan riwayat kunjungan berhasil diperbarui');
    }

    // Hapus Data
    public function delete($id)
    {
        $m_selesai = new \App\Models\Shiftselesai_Model();
        
        $detail = $m_selesai->detail($id);
        if ($detail && !empty($detail->foto)) {
            $path = public_path('admin/upload/absensi/' . $detail->foto);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $m_selesai->hapus(['id_selesai' => $id]);

        return redirect('adminteam/selesai')->with('sukses', 'Data laporan berhasil dihapus');
    }
}