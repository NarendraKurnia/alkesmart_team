<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User_model;
use App\Models\Pegawai_Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //// Index
    public function index(Request $request)
    {
        $query = User_model::with('pegawai')->orderBy('id_user', 'DESC');
        $user = $query->paginate(10); 
    
        $pegawai_id = session()->get('pegawai_id');
        $pegawai = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();
    
        $data = [ 
            'title'   => 'Data User Administrator',
            'user'    => $user,
            'pegawai'    => $pegawai,
            'content' => 'adminteam/user/index'
        ];

        return view('adminteam/layout/wrapper', $data);
    }
    // tambah
    public function tambah()
    {
        // Ini untuk info pegawai yang login (Object Tunggal)
        $pegawai_id = session()->get('pegawai_id');
        $pegawai_login = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();
        
        $list_pegawai = Pegawai_Model::select('id_pegawai', 'nama')->get(); 

        $data = [ 
            'title'        => 'Tambah Data User Administrator',
            'pegawai_login' => $pegawai_login, 
            'list_pegawai' => $list_pegawai,  
            'content'      => 'adminteam/user/tambah'
        ];

        return view('adminteam/layout/wrapper', $data);
    }
    public function proses_tambah(Request $request)
    {
        $m_user = new User_model();

        // 1. Tambahkan validasi 'confirmed' pada field password
        // Ini akan otomatis mencari input bernama 'password_confirmation' di form Anda
        $request->validate([
            'username'   => 'required|unique:pengguna',
            'email'      => 'required|email|unique:pengguna',
            'nama'       => 'required',
            'password'   => 'required|min:6|confirmed', // Tambahan: confirmed
            'pegawai_id' => 'required|exists:pegawai,id_pegawai'
        ], [
            // 2. Custom pesan error agar informatif
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password utama.',
            'password.min'       => 'Password minimal harus 6 karakter.',
            'username.unique'    => 'Username sudah terdaftar, gunakan yang lain.',
            'email.unique'       => 'Email sudah terdaftar.',
        ]);

        // proses data input
        $data = [
            'nama'       => $request->nama,
            'email'      => $request->email,
            'username'   => $request->username,
            // Tetap menggunakan sha1 sesuai struktur coding yang kamu miliki
            'password'   => sha1($request->password), 
            'pegawai_id' => $request->pegawai_id,
        ];

        $m_user->tambah($data);
        
        // end proses
        return redirect('adminteam/user')->with(['sukses' => 'Data Telah Ditambah']);
    }
    // edit
    public function edit($id_user) 
{
    $m_user = new User_Model();
    $user   = $m_user->detail($id_user); 

    // 1. Data untuk admin yang sedang login (HANYA 1 ORANG)
    // Variabel ini biarkan namanya $pegawai agar Layout Sidebar Anda tidak error
    $pegawai_id = session()->get('pegawai_id');
    $pegawai    = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();
    
    // 2. Data untuk isi Dropdown (BANYAK ORANG / LIST)
    // KITA BERI NAMA BERBEDA: $semua_pegawai
    $semua_pegawai = Pegawai_Model::select('id_pegawai', 'nama')->get(); 

    $data = [ 
        'title'         => 'Edit Data User Administrator',
        'user'          => $user,
        'pegawai'       => $pegawai,       // Ini untuk layout (Object)
        'semua_pegawai' => $semua_pegawai, // Ini untuk form (Collection/Array)
        'content'       => 'adminteam/user/edit'
    ];

    return view('adminteam/layout/wrapper', $data);
}

     // proses_edit
     public function proses_edit(Request $request)

    {
         $m_user     = new User_model();
         request()->validate([
                             'username'      => 'required',
                             'email'         => 'required',
                             'nama'          => 'required',
                                     ]);
         // proses data input
         $password      = $request->password;
        //  cek panjang pendek password
        if(strlen($password) >= 6 && strlen($password) <= 32) {
            $data   = [  'id_user'       => $request->id_user,
                         'nama'          => $request->nama,
                         'email'	     => $request->email,
                         'username'   	 => $request->username,
                         'password'      => sha1($request->password),
                         'pegawai_id'    => $request->pegawai_id
 
                     ];

        }else{   
            // tidak ganti password
            $data   = [  'id_user'       => $request->id_user,
                         'nama'          => $request->nama,
                         'email'	     => $request->email,
                         'username'   	 => $request->username,
                         'pegawai_id'    => $request->pegawai_id,
 
                     ];

        }
         $m_user->edit($data);
         // end proses
         return redirect('adminteam/user')->with(['sukses' => 'Data Telah Diedit']);
    }
     //  delete
     public function delete($id)
    {
         $m_user = new User_model();
         $data   = ['id_user' => $id];
         $m_user->hapus($data);   
          
         return redirect('adminteam/user')->with(['sukses' => 'Data Telah Dihapus']);
    }
}
