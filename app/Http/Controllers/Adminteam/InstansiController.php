<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use App\Models\Instansi_Model;
use App\Models\Kabupaten_Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstansiController extends Controller
{
    // Daftar Instansi
    public function index(Request $request)
    {
        $query = Instansi_Model::with('kabupaten')->orderBy('id_instansi', 'DESC');
        $instansi = $query->paginate(10);

        $pegawai_id = session()->get('pegawai_id');
        $pegawai = null;

        $data = [
            'title'   => 'Daftar Instansi',
            'instansi'   => $instansi,
            'pegawai' => $pegawai,
            'content' => 'adminteam/instansi/index'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Form tambah kamar
    public function tambah()
    {
        // Ambil data dari model Kabupaten
        $kabupaten = \App\Models\Kabupaten_Model::all(); 

        $data = [
            'title'     => 'Tambah Instansi',
            'kabupaten' => $kabupaten, // Pastikan kuncinya bernama 'kabupaten'
            'content'   => 'adminteam/instansi/tambah'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Simpan kamar baru
    public function proses_tambah(Request $request)
    {
        $request->validate([
            'nama'         => 'required',
            'tipe_id'      => 'required|exists:kabupaten,id_kabupaten', // Pastikan ID kabupaten valid
        ]);

        $data = [
            'nama'         => $request->nama,
            'kabupaten_id' => $request->tipe_id, // Sesuaikan dengan nama kolom di tabel instansi
        ];

        $m_instansi = new \App\Models\Instansi_Model();
        $m_instansi->tambah($data);

        return redirect('adminteam/instansi')->with(['sukses' => 'Data Instansi berhasil ditambahkan']);
    }
    // Form edit kamar
    public function edit($id)
    {
        // Gunakan Model (huruf e), bukan Modal
        $instansi = Instansi_Model::findOrFail($id);
        $kabupaten = Kabupaten_Model::all(); 

        $data = [
            'title'     => 'Edit Instansi',
            'instansi'  => $instansi,   // Pastikan nama variabel sesuai
            'kabupaten' => $kabupaten,
            'content'   => 'adminteam/instansi/edit' // Pastikan path view benar
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Update kamar
    public function proses_edit(Request $request)
    {
        // Perbaiki typo Modal -> Model
        $m_instansi = new \App\Models\Instansi_Model();

        $request->validate([
            'id_instansi'  => 'required|exists:instansi,id_instansi',
            'kabupaten_id' => 'required|exists:kabupaten,id_kabupaten', // Sesuaikan dengan PK kabupaten
            'nama'         => 'required',
        ]);

        $data = [
            'id_instansi'  => $request->id_instansi,
            'kabupaten_id' => $request->kabupaten_id, // Pastikan nama input di select tadi adalah kabupaten_id
            'nama'         => $request->nama,
        ];

        $m_instansi->edit($data);

        return redirect('adminteam/instansi')->with(['sukses' => 'Data Instansi berhasil diedit']);
    }

    // Delete
     public function delete($id)
    {
        // Perbaiki typo Modal -> Model
        $m_instansi = new \App\Models\Instansi_Model();
        $data = ['id_instansi' => $id];
        
        // Pastikan nama variabelnya $m_instansi, bukan $m_kamar
        $m_instansi->hapus($data);   
        
        return redirect('adminteam/instansi')->with(['sukses' => 'Data Telah Dihapus']);
    }
}
