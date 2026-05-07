<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten_Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KabupatenController extends Controller
{
    // Daftar kamar
    public function index(Request $request)
    {
        $kabupaten = Kabupaten_Model::orderBy('id_kabupaten', 'DESC')->paginate(10);

        $data = [
            'title'     => 'Daftar Kabupaten',
            'kabupaten' => $kabupaten,
            'pegawai'   => null,
            'content'   => 'adminteam/kabupaten/index'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Form tambah kamar
    public function tambah()
    {
        $tipe = Kabupaten_Model::all();
        $pegawai_id = session()->get('pegawai_id');
        $pegawai = null;

        $data = [
            'title'   => 'Tambah Data Kabupaten',
            'tipe'    => $tipe,
            'pegawai' => $pegawai,
            'content' => 'adminteam/kabupaten/tambah'
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

    $m_kabupaten = new \App\Models\Kabupaten_Model();
    $m_kabupaten->tambah($data);

    return redirect('adminteam/kabupaten')->with(['sukses' => 'Data Kabupaten berhasil ditambahkan']);
    }
    // Form edit kamar
    public function edit($id)
    {
        $kabupaten = Kabupaten_Model::findOrFail($id);

        $data = [
            'title'   => 'Edit Data Kabupaten',
            'kabupaten'  => $kabupaten,
            'content' => 'adminteam/kabupaten/edit'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Update kamar
    public function proses_edit(Request $request)
    {
        $m_kabupaten = new \App\Models\Kabupaten_Model();

        $request->validate([
            'id_kabupaten'       => 'required|exists:kabupaten,id_kabupaten',
            'nama'               => 'required',
        ]);

        $id_kabupaten = $request->id_kabupaten;

        $data = [
            'id_kabupaten'           => $id_kabupaten,
            'nama'               => $request->nama,
        ];

        $m_kabupaten->edit($data);

        return redirect('adminteam/kabupaten')->with(['sukses' => 'Data Kabupaten berhasil diedit']);
    }

    // Delete
    public function delete($id)
    {
        $m_kabupaten = new \App\Models\Kabupaten_Model(); // Perbaiki nama model
        $data = ['id_kabupaten' => $id];
        $m_kabupaten->hapus($data);   
        
        return redirect('adminteam/kabupaten')->with(['sukses' => 'Data Telah Dihapus']);
    }

}
