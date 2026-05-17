<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use App\Models\Dealing_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DealingadminController extends Controller
{
    // Daftar data dealing seluruh marketing
    public function index(Request $request)
    {
        $m_dealing = new Dealing_Model();
        // Menggunakan method listing() bawaan model kamu yang mengambil data dari DB langsung
        $all = collect($m_dealing->listing());

        // Fitur pencarian keywords global jika diperlukan
        if ($request->filled('keywords')) {
            $keywords = strtolower(trim($request->keywords));
            $all = $all->filter(function ($item) use ($keywords) {
                return str_contains(strtolower($item->nama_item), $keywords)
                    || str_contains(strtolower($item->nama_pegawai), $keywords)
                    || str_contains(strtolower($item->nama_petugas), $keywords);
            });
        }

        // Pagination Manual (10 data per halaman) mengikuti gaya data link Laravel
        $perPage = 10;
        $page = $request->get('page', 1);
        $slice = $all->slice(($page - 1) * $perPage)->values();
        
        $data_dealing = new \Illuminate\Pagination\LengthAwarePaginator(
            $slice,
            $all->count(),
            $perPage,
            $page,
            ['path' => url('adminteam/dealing'), 'query' => $request->query()]
        );

        $data = [
            'title'        => 'Kontrol Semua Data Dealing Marketing',
            'data_dealing' => $data_dealing,
            'pegawai'      => null,
            'content'      => 'adminteam/dealingadmin/index'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Form tambah data
    public function tambah()
    {
        $kabupaten   = \App\Models\Kabupaten_Model::all();
        $instansi    = \App\Models\Instansi_Model::all();
        $currentDate = Carbon::now()->format('Y-m-d'); 

        $data = [
            'title'       => 'Tambah Data Dealing Baru',
            'kabupaten'   => $kabupaten,
            'instansi'    => $instansi,
            'currentDate' => $currentDate,
            'pegawai'     => null,
            'content'     => 'adminteam/dealingadmin/tambah'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Proses simpan data baru
    public function proses_tambah(Request $request)
    {
        $request->validate([
            'nama_item'       => 'required|string|max:255',
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

        return redirect('adminteam/dealingadmin')->with(['sukses' => 'Data Dealing berhasil ditambahkan']);
    }

    // Form edit data
    public function edit($id)
    {
        $m_dealing = new Dealing_Model();
        $detail    = $m_dealing->detail($id);
        $kabupaten = \App\Models\Kabupaten_Model::all();
        $instansi  = \App\Models\Instansi_Model::all();

        $data = [
            'title'     => 'Edit Data Dealing Marketing',
            'detail'    => $detail,
            'kabupaten' => $kabupaten,
            'instansi'  => $instansi,
            'pegawai'   => null,
            'content'   => 'adminteam/dealingadmin/edit'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Proses update data
    public function proses_edit(Request $request)
    {
        $request->validate([
            'id_dealing'      => 'required',
            'nama_item'       => 'required|string|max:255',
            'nama_pegawai'    => 'required|string|max:255',
            'nama_petugas'    => 'required|string|max:255',
            'no_petugas'      => 'required|numeric|digits_between:10,15',
            'tanggal_dealing' => 'required|date',
            'kabupaten_id'    => 'required|integer',
            'instansi_id'     => 'required|integer',
            'harga'           => 'required|numeric|min:0', 
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg|max:8024'
        ]);

        $id_dealing = $request->id_dealing;
        $m_dealing  = new Dealing_Model();
        $detail     = $m_dealing->detail($id_dealing);

        $nama_file = $detail->foto; // default gunakan foto lama

        if ($file = $request->file('foto')) {
            // Hapus foto lama dari server jika ganti berkas baru
            if (!empty($detail->foto)) {
                $old_path = public_path('admin/upload/dealing/' . $detail->foto);
                if (file_exists($old_path)) {
                    @unlink($old_path);
                }
            }
            $filename  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/upload/dealing'), $nama_file);
        }

        // Jalankan update data ke DB tabel dealing
        \Illuminate\Support\Facades\DB::table('dealing')
            ->where('id_dealing', $id_dealing)
            ->update([
                'nama_item'       => $request->nama_item, 
                'nama_pegawai'    => $request->nama_pegawai,
                'nama_petugas'    => $request->nama_petugas,
                'no_petugas'      => $request->no_petugas,
                'tanggal_dealing' => $request->tanggal_dealing,
                'kabupaten_id'    => $request->kabupaten_id,
                'instansi_id'     => $request->instansi_id,
                'foto'            => $nama_file,
                'harga'           => $request->harga,
                'tanggal_update'  => Carbon::now()
            ]);

        return redirect('adminteam/dealingadmin')->with(['sukses' => 'Data Dealing berhasil diedit']);
    }

    // Hapus data permanen
    public function delete($id)
    {
        $m_dealing = new Dealing_Model();
        $detail    = $m_dealing->detail($id);
        
        // Hapus file fisik gambar lampiran berkas terlebih dahulu
        if ($detail && !empty($detail->foto)) {
            $path = public_path('admin/upload/dealing/' . $detail->foto);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $m_dealing->hapus(['id_dealing' => $id]); 
        
        return redirect('adminteam/dealingadmin')->with(['sukses' => 'Data Dealing Berhasil Dihapus']);
    }
}