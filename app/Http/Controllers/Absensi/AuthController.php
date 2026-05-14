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

        // Tambahkan 'status' => 'active' agar hanya user aktif yang bisa masuk
        if(Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password, 
            'status' => 'active'
        ], $request->remember)){
            return redirect('absensi/masuk')->with('sukses', 'Login berhasil!');
        }

        // Jika gagal, cek apakah karena status masih verify
        $user = User::where('email', $request->email)->first();
        if($user && $user->status !== 'active'){
            return back()->with('warning', 'Akun Anda belum aktif. Silakan hubungi Admin.');
        }

        return back()->with('warning', 'Email atau Password salah');
    }

    public function register(Request $request) 
    {
        try {
            $request->validate([
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:50|unique:users',
                'password'         => 'required|max:50|min:6',
                'confirm_password' => 'required|max:50|min:6|same:password',
                'gambar'           => 'required|image|mimes:jpeg,png,jpg|max:2048', 
            ]);

            $data = $request->all();
            $data['status']   = "verify";
            $data['password'] = bcrypt($request->password);

            if ($request->hasFile('gambar')) {
                $file     = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('umum/images'), $filename);
                $data['gambar'] = $filename;
            }

            User::create($data);

            return redirect('login')->with('sukses', 'Registrasi berhasil! Silakan tunggu akun Anda diaktifkan oleh Admin.');
            
        } catch (\Exception $e) {
            // Jika gagal simpan atau ada error database
            return back()->withInput()->with('warning', 'Register gagal: ' . $e->getMessage());
        }
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