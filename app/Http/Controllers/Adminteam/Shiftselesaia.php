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
            'content'       => 'adminteam/selesai/index'
        ]);
    }

    // Form Tambah Selesai Kunjungan
    public function tambah()
    {
        $kabupaten   = \App\Models\Kabupaten_Model::all();
        $instansi    = \App\Models\Instansi_Model::all();
        $currentTime = Carbon::now()->format('H:i'); 

        return view('absensi/layout/wrapper', [
            'title'       => 'Selesaikan Kunjungan',
            'kabupaten'   => $kabupaten,
            'instansi'    => $instansi,
            'currentTime' => $currentTime,
            'content'     => 'absensi/selesai/tambah'
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

        return redirect('absensi/selesai')->with('sukses', 'Laporan selesai kunjungan berhasil disimpan');
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

        return redirect('absensi/selesai')->with('sukses', 'Data laporan berhasil dihapus');
    }
}