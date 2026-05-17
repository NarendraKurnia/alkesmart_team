<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use App\Models\Pegawai_Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class pegawaiController extends Controller
{
    // Daftar kamar
    public function index(Request $request)
    {
        // 1. Ambil data dengan query pencarian (jika ada keywords)
        $query = Pegawai_Model::orderBy('id_pegawai', 'DESC');

        if ($request->filled('keywords')) {
            $keywords = $request->keywords;
            $query->where('nama_pegawai', 'LIKE', '%' . $keywords . '%') // sesuaikan nama kolom 'nama_pegawai' atau 'nama' di DB Anda
                  ->orWhere('username', 'LIKE', '%' . $keywords . '%');
        }

        // 2. WAJIB menggunakan paginate() agar fungsi ->appends() dan ->links() di blade tidak error
        $pegawai = $query->paginate(10);

        $data = [
            'title'     => 'Daftar Akses Pegawai',
            'pegawai'   => $pegawai, // KUNCI: Nama key array ini harus 'pegawai'
            'content'   => 'adminteam/pegawai/index' // Sesuaikan dengan path view kamu
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Form tambah kamar
    public function tambah()
    {
        $tipe = Pegawai_Model::all();
        $pegawai_id = session()->get('pegawai_id');
        $pegawai = null;

        $data = [
            'title'   => 'Tambah Data Pegawai',
            'pegawai' => $pegawai,
            'content' => 'adminteam/pegawai/tambah'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Simpan kamar baru
    public function proses_tambah(Request $request)
    {
    $request->validate([
        'nama'               => 'required',
    ]);

    $data = [
        'nama'          => $request->nama,
    ];

    $m_pegawai = new \App\Models\Pegawai_Model();
    $m_pegawai->tambah($data);

    return redirect('adminteam/pegawai')->with(['sukses' => 'Data Akses Pegawai berhasil ditambahkan']);
    }
    // Form edit kamar
    public function edit($id)
    {
        $pegawai = Pegawai_Model::findOrFail($id);

        $data = [
            'title'   => 'Edit Data Akses Pegawai',
            'pegawai'  => $pegawai,
            'content' => 'adminteam/pegawai/edit'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Update kamar
    public function proses_edit(Request $request)
    {
        $m_pegawai = new \App\Models\Pegawai_Model();

        $request->validate([
            'id_pegawai'       => 'required|exists:pegawai,id_pegawai',
            'nama'               => 'required',
        ]);

        $id_pegawai = $request->id_pegawai;

        $data = [
            'id_pegawai'           => $id_pegawai,
            'nama'               => $request->nama,
        ];

        $m_pegawai->edit($data);

        return redirect('adminteam/pegawai')->with(['sukses' => 'Data Akses Pegawai berhasil diedit']);
    }

    // Delete
    public function delete($id)
    {
        $m_pegawai = new \App\Models\Pegawai_Model(); // Perbaiki nama model
        $data = ['id_pegawai' => $id];
        $m_pegawai->hapus($data);   
        
        return redirect('adminteam/pegawai')->with(['sukses' => 'Data Telah Dihapus']);
    }

}
