<?php

namespace App\Http\Controllers\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Dealing_Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DealingController extends Controller
{
    public function index(Request $request)
    {
        $m_dealing = new Dealing_Model();
        $all = collect($m_dealing->listing());

        // Ambil nama user login dan bersihkan spasi
        $userName = trim(strtolower(Auth::user()->name));
        
        // FILTER: Menggunakan properti database asli -> nama_item
        $all = $all->filter(function ($item) use ($userName) {
            return trim(strtolower($item->nama_pegawai)) === $userName;
        });

        // Filter pencarian keywords global
        if ($request->filled('keywords')) {
            $keywords = strtolower(trim($request->keywords));
            $all = $all->filter(function ($item) use ($keywords) {
                return str_contains(strtolower($item->nama_item), $keywords)
                    || str_contains(strtolower($item->nama_pegawai), $keywords)
                    || str_contains(strtolower($item->nama_petugas), $keywords);
            });
        }

        // Pagination Manual (10 data per halaman)
        $perPage = 10;
        $page = $request->get('page', 1);
        $slice = $all->slice(($page - 1) * $perPage)->values();
        
        $data_dealing = new LengthAwarePaginator(
            $slice,
            $all->count(),
            $perPage,
            $page,
            ['path' => url('absensi/dealing'), 'query' => $request->query()]
        );

        return view('absensi/layout/wrapper', [
            'title'        => 'Riwayat Data Dealing Saya',
            'data_dealing' => $data_dealing,
            'content'      => 'absensi/dealing/index'
        ]);
    }

    public function tambah()
    {
        $kabupaten   = \App\Models\Kabupaten_Model::all();
        $instansi    = \App\Models\Instansi_Model::all();
        $currentDate = Carbon::now()->format('Y-m-d'); 

        return view('absensi/layout/wrapper', [
            'title'       => 'Tambah Data Dealing',
            'kabupaten'   => $kabupaten,
            'instansi'    => $instansi,
            'currentDate' => $currentDate,
            'content'     => 'absensi/dealing/tambah'
        ]);
    }

    public function proses_tambah(Request $request)
    {
        $request->validate([
            'nama_item'            => 'required|string|max:255', // data input form
            'nama_pegawai'    => 'required|string|max:255',
            'nama_petugas'    => 'required|string|max:255',
            'no_petugas'      => 'required|numeric|digits_between:10,15',
            'tanggal_dealing' => 'required|date',
            'kabupaten_id'    => 'required|integer',
            'instansi_id'     => 'required|integer',
            'harga'           => 'required|numeric|min:0', 
            'foto'            => 'required|image|mimes:jpeg,png,jpg|max:8024'
        ]);

        $nama_file = null;
        if ($file = $request->file('foto')) {
            $filename  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/upload/dealing'), $nama_file);
        }

        // Kunci penyesuaian: Simpan data form ke kolom database 'nama_item'
        $data = [
            'nama_item'       => $request->nama_item, 
            'nama_pegawai'    => $request->nama_pegawai,
            'nama_petugas'    => $request->nama_petugas,
            'no_petugas'      => $request->no_petugas,
            'tanggal_dealing' => $request->tanggal_dealing,
            'kabupaten_id'    => $request->kabupaten_id,
            'instansi_id'     => $request->instansi_id,
            'foto'            => $nama_file,
            'harga'           => $request->harga,
            'link_reset'      => null 
        ];

        $m_dealing = new Dealing_Model();
        $m_dealing->tambah($data);

        return redirect('absensi/dealing')->with('sukses', 'Data dealing baru berhasil disimpan');
    }

    public function delete($id)
    {
        $m_dealing = new Dealing_Model();
        $detail = $m_dealing->detail($id);
        
        if ($detail && !empty($detail->foto)) {
            $path = public_path('admin/upload/dealing/' . $detail->foto);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $m_dealing->hapus(['id_dealing' => $id]);

        return redirect('absensi/dealing')->with('sukses', 'Data dealing berhasil dihapus');
    }
}