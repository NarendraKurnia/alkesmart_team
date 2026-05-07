<?php

namespace App\Http\Controllers\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // PERBAIKAN: gunakan facade
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'     => 'required|email|max:50',
            'password'  => 'required|max:50',
        ]);

        // PERBAIKAN: Gunakan Auth facade dengan benar
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect('absensi/masuk')->with('sukses', 'Login berhasil!');
        }

        return back()->with('warning', 'Email atau Password salah');
    }

    public function register(Request $request) {
        $request->validate([
            'email'     => 'required|email|max:50|unique:users',
            'password'  => 'required|max:50|min:0',
            'confirm_password'  => 'required|max:50|min:0|same:password',
        ]);
        $request['status'] = "verify";
        $user   = User::create($request->all());
        Auth::login($user);
        return redirect('absensi/masuk');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('sukses', 'Logout berhasil!');
    }
    public function gantiPassword()
    {
        return view('user.edit_password', ['title' => 'Ganti Password']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            // current_password secara otomatis mengecek kecocokan password lama di DB
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)], 
        ], [
            'current_password.current_password' => 'Password lama Anda tidak sesuai.',
            'password.confirmed'                => 'Konfirmasi password baru tidak cocok.',
            'password.min'                      => 'Password baru minimal harus 8 karakter.',
        ]);

        $user = Auth::user();
        
        // Simpan dengan Hash::make
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('sukses', 'Password berhasil diperbarui!');
    }
}