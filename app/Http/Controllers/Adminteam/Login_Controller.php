<?php

namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use App\Models\User_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Login_Controller extends Controller
{
    //Index
     public function index()
    {
        $data = [
            'title'   => 'Login Administrator',
            'content' => 'adminteam/login/index'
        ];
        return view('adminteam/login/layout', $data);
    }

    // Cek Login
    public function cek_login(Request $request)
    {
        $m_pengguna = new User_Model();
        $username   = $request->username;
        $password   = $request->password;

        // Panggil method login di model
        $pengguna = $m_pengguna->login($username, $password);

        if ($pengguna) {
            // Simpan session
            $request->session()->put('id_user',   $pengguna->id_user);
            $request->session()->put('username',  $pengguna->username);
            $request->session()->put('nama',      $pengguna->nama);
            $request->session()->put('pegawai_id',   $pengguna->pegawai_id);

            return redirect('adminteam/user')->with(['sukses' => 'Anda Berhasil Login']);
        } else {
            return redirect('adminteam/login')->with(['warning' => 'Username atau Password salah']);
        }
    }
    public function logout()
    {
        Session::forget(['id_user', 'username', 'nama', 'pegawai_id']);
        return redirect('adminteam/login')->with(['sukses' => 'Anda Berhasil logout']);
    }

}
