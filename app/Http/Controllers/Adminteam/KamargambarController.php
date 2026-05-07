<?php

namespace App\Http\Controllers\Adminvillas;

use App\Http\Controllers\Controller;
use App\Models\GambarkamarModel;
use App\Models\Pegawai_Model;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KamargambarController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $pegawai_id = session()->get('pegawai_id');
        // Tidak perlu pakai with('unit') karena tidak ada relasi unit
        $query = GambarkamarModel::orderBy('id_gambar', 'DESC');
        $gambar = GambarkamarModel::with('tipe')->paginate(10);

        // Ambil data unit
        $pegawai = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();

        $data = [ 
            'title'   => 'Data Gambar',
            'gambar'  => $gambar,
            'pegawai' => $pegawai,
            'content' => 'adminvillas/gambar_kamar/index'
        ];

        return view('adminvillas/layout/wrapper', $data);
    }
    // Form tambah kamar
    public function tambah()
    {
        $tipe = TipeKamar::all();
        $data = [
            'title'   => 'Tambah Gambar Kamar',
            'tipe'    => $tipe,
            'content' => 'adminvillas/gambar_kamar/tambah'
        ];

        return view('adminvillas/layout/wrapper', $data);
    }
    // proses_tambah
    public function proses_tambah(Request $request)

    {
        $m_gambar     = new GambarkamarModel();
        request()->validate([
                                    'judul'   => 'required',
                                    'gambar'  => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
                                    'tipe_id' => 'required|exists:tipe_kamar,id',
                                ]);
        // proses data input
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'admin/upload/room/';
            $image->move($destinationPath, $input['nama_file']);

        $data   = [     'judul'         => $request->judul,
                        'gambar'   	    => $input['nama_file'],
                         'tipe_id'      => $request->tipe_id,
                    ];
                  }              
        $m_gambar->tambah($data);
        // end proses
        return redirect('adminvillas/gambar_kamar')->with(['sukses' => 'Data Telah Ditambah']);
    }
    // Form edit kamar
    public function edit($id)
    {
        $gambar = GambarkamarModel::findOrFail($id);
        $tipe  = TipeKamar::all();

        $data = [
            'title'   => 'Edit Gambar Kamar',
            'gambar'  => $gambar,
            'tipe'    => $tipe,
            'content' => 'adminvillas/gambar_kamar/edit'
        ];

        return view('adminvillas/layout/wrapper', $data);
    }
    // proses edit
    public function proses_edit(Request $request)
    {
    $m_gambar = new GambarkamarModel();

    // Ambil id_banner dari form input
    $id_gambar = $request->input('id_gambar');
    $image     = $request->file('gambar');

    // 1. Validasi
    $request->validate([
        'judul'    => 'required',
        'gambar'   => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
        'tipe_id'    => 'required|exists:tipe_kamar,id'
    ]);

    // 2. Siapkan data dasar untuk update
    $data = [
        'id_gambar' => $id_gambar,
        'judul'     => $request->judul,
        'tipe_id'       => $request->tipe_id
    ];

    // 3. Jika ada gambar baru diupload
    if ($image) {
        // a) Hapus file lama jika ada
        $old = $m_gambar->detail($id_gambar);
        if (!empty($old->gambar)) {
            $oldPath = public_path('admin/upload/room/' . $old->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // b) Simpan file baru
        $origName  = $image->getClientOriginalName();
        $filename  = pathinfo($origName, PATHINFO_FILENAME);
        $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
        $destPath  = public_path('admin/upload/room/');
        $image->move($destPath, $nama_file);

        $data['gambar'] = $nama_file;
    }

    // 4. Update data
    $m_gambar->edit($data);

    return redirect('adminvillas/gambar_kamar')->with(['sukses' => 'Data Telah Diedit']);
    }
    // Delete
     public function delete($id)
    {
         $m_gambar = new GambarkamarModel();
         $data   = ['id_gambar' => $id];
         $m_gambar->hapus($data);   
          
         return redirect('adminvillas/gambar_kamar')->with(['sukses' => 'Data Telah Dihapus']);
    }

}
