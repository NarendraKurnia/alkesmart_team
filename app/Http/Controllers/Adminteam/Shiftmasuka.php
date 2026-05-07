<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Shiftmasuk_Model;
use App\Models\Shiftselesai_Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Pegawai_Model;
use Mpdf\Mpdf;
use Carbon\Carbon;

class Shiftmasuka extends Controller
{
    public function index(Request $request)
    {
        $m_shift = new \App\Models\Shiftmasuk_Model();
        $all = collect($m_shift->listing());

        // Filter berdasarkan kolom baru: nama atau tanggal_kunjungan
        if ($request->filled('keywords')) {
            $keywords = strtolower($request->keywords);
            $all = $all->filter(function ($item) use ($keywords) {
                return str_contains(strtolower($item->nama), $keywords)
                    || str_contains(strtolower($item->tanggal_kunjungan), $keywords)
                    || str_contains(strtolower($item->kegiatan), $keywords);
            });
        }

        // Manual pagination (tetap sama)
        $perPage = 10;
        $page = $request->get('page', 1);
        $slice = $all->slice(($page - 1) * $perPage)->values();
        
        $shift_masuk = new LengthAwarePaginator(
            $slice,
            $all->count(),
            $perPage,
            $page,
            ['path' => url('adminteam/masuka'), 'query' => $request->query()]
        );

        return view('adminteam/layout/wrapper', [
            'title'       => 'Riwayat Kunjungan',
            'shift_masuk' => $shift_masuk,
            'content'     => 'adminteam/masuka/index'
        ]);
    }

    // Form tambah
    public function tambah()
    {
        $kabupaten = \App\Models\Kabupaten_Model::all();
        $instansi  = \App\Models\Instansi_Model::all();
        
        // Tambahkan baris ini untuk mendefinisikan jam sekarang
        $currentTime = \Carbon\Carbon::now()->format('H:i'); 

        return view('adminteam/layout/wrapper', [
            'title'       => 'Tambah Kunjungan Untuk Marketing',
            'kabupaten'   => $kabupaten,
            'instansi'    => $instansi,
            'currentTime' => $currentTime, // Kirim variabel ke view
            'content'     => 'adminteam/masuka/tambah'
        ]);
    }

    // Proses tambah
    public function proses_tambah(Request $request)
{
    // 1. Validasi sesuai field database baru
    $request->validate([
        'nama'           => 'required|string|max:255',
        'kegiatan'       => 'required|in:kunjungan,byWA',
        'kabupaten_id'   => 'required|integer',
        'instansi_id'    => 'required|integer',
        'foto'           => 'required|image|mimes:jpeg,png,jpg|max:8024'
    ]);

    $now = Carbon::now();

    // 2. Penanganan Upload Foto
    $nama_file = null;
    if ($file = $request->file('foto')) {
        $filename  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $nama_file = Str::slug($filename, '-') . '-' . time() .'.'. $file->getClientOriginalExtension();
        // Pastikan folder ini ada: public/admin/upload/absensi
        $file->move(public_path('admin/upload/absensi'), $nama_file);
    }

    // 3. Susun data sesuai kolom tabel (id_masuk otomatis AI)
    $data = [
        'nama'              => $request->nama,
        'jam_kehadiran'     => $now->format('H:i:s'),
        'tanggal_kunjungan' => $now->format('Y-m-d'),
        'kegiatan'          => $request->kegiatan,
        'kabupaten_id'      => $request->kabupaten_id,
        'instansi_id'       => $request->instansi_id,
        'foto'              => $nama_file,
        'link_reset'        => null // Sesuai struktur database yang boleh NULL
    ];

    // 4. Simpan ke database
    $m_shift = new \App\Models\Shiftmasuk_Model();
    $m_shift->tambah($data);

    return redirect('absensi/masuk')->with('sukses', 'Presensi berhasil disimpan');
}
    public function ambil_catatan(Request $request)
    {
        $instansi_id = $request->instansi_id;

        // Ambil data terbaru dari tabel shift_selesai
        $catatan = \DB::table('shift_selesai')
                    ->where('instansi_id', $instansi_id)
                    ->orderBy('id_selesai', 'DESC')
                    ->first();

        // Pastikan $catatan tidak null sebelum mengakses propertinya
        if ($catatan && isset($catatan->catatan_shift_selanjutnya)) {
            
            // Cek apakah kolom bernama 'tanggal_shift' atau 'tanggal_kunjungan'
            // Kita gunakan fallback ke 'tanggal_shift' sesuai struktur terakhir Anda
            $tanggal = isset($catatan->tanggal_shift) ? $catatan->tanggal_shift : date('Y-m-d');

            return response()->json([
                'status'  => 'success',
                'catatan' => $catatan->catatan_shift_selanjutnya,
                'oleh'    => $catatan->nama,
                'tanggal' => date('d-m-Y', strtotime($tanggal))
            ]);
        } else {
            return response()->json([
                'status'  => 'empty',
                'catatan' => 'Tidak ada catatan untuk instansi ini.'
            ]);
        }
    }


    // Delete
    public function delete($id)
    {
        $m_shift = new Shiftmasuk_Model();

        // Ambil detail dulu untuk hapus file
        $detail = $m_shift->detail($id);
        if ($detail && !empty($detail->foto)) {
            $path = public_path('admin/upload/shift/' . $detail->foto);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        // Hapus record
        $m_shift->hapus(['id_masuk' => $id]);

        return redirect('security/shift-masuk')
            ->with('sukses', 'Data berhasil dihapus');
    }
    // Fitur print
    public function cetak($id)
    {
        $unit_id = session()->get('unit_id');
        $unit = Unit::where('id_unit', $unit_id)->first();

        // Ambil satu data shift masuk berdasarkan ID
        $m_shift = new Shiftmasuk_Model();
        $shift = $m_shift->detail($id);

        if (!$shift) {
            abort(404, 'Data shift tidak ditemukan');
        }

        // Ambil semua data shift selesai
        $m_shift_selesai = new Shiftselesai_Model();
        $selesai_all = collect($m_shift_selesai->listing());

        // Urutan shift
        $shift_order = ['Pagi' => 1, 'Siang' => 2, 'Malam' => 3];

        // Proses catatan shift sebelumnya
        $current_order = $shift_order[$shift->shift] ?? null;

        if ($current_order && $current_order > 1) {
            $prev_shift = array_search($current_order - 1, $shift_order);
            $prev_shift_item = $selesai_all->first(function ($s) use ($shift, $prev_shift) {
                return $s->tanggal_shift === $shift->tanggal_shift && $s->shift === $prev_shift;
            });
        } else {
            $prev_date = date('Y-m-d', strtotime($shift->tanggal_shift . ' -1 day'));
            $prev_shift_item = $selesai_all->first(function ($s) use ($prev_date) {
                return $s->tanggal_shift === $prev_date && $s->shift === 'Malam';
            });
        }

        $shift->catatan_shift_sebelumnya = $prev_shift_item->catatan_shift_selanjutnya ?? null;

        // Kirim ke view cetak
        return view('security.shift-masuk.cetak', compact('shift', 'unit'));
    }

}
