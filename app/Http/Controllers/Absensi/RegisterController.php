<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client_Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login.layout', [
            'title'   => 'Registrasi',
            'content' => 'login.register'
        ]);
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|email|unique:clients,email',
            'password'     => 'required|min:6|confirmed',
            'phone_number' => 'required|string|max:20',
        ]);

        // Generate OTP & expired 5 menit
        $otp = rand(100000, 999999);

        $client = Client_Model::create([
            'nama'           => $request->nama,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'phone_number'   => $request->phone_number,
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'is_verified'    => false,
        ]);

        // Kirim OTP ke email
        Mail::raw("Kode OTP Anda adalah: $otp (berlaku 5 menit)", function ($message) use ($client) {
            $message->to($client->email)
                    ->subject('Kode OTP Registrasi');
        });

        return redirect()->route('otp.verify.form', ['email' => $client->email])
                         ->with('success', 'Registrasi berhasil! Cek email untuk OTP.');
    }

    /**
     * Tampilkan form verifikasi OTP
     */
    public function showOtpForm($email)
    {
        return view('auth.verify-otp', ['email' => $email]);
    }

    /**
     * Proses verifikasi OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|exists:clients,email',
            'otp_code'  => 'required|digits:6',
        ]);

        $client = Client_Model::where('email', $request->email)->first();

        if (!$client) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Cek OTP valid & tidak expired
        if ($client->otp_code == $request->otp_code) {
            if ($client->otp_expires_at < now()) {
                return back()->withErrors(['otp_code' => 'Kode OTP sudah kadaluarsa, silakan kirim ulang OTP.']);
            }

            // Verifikasi berhasil
            $client->is_verified = true;
            $client->otp_code = null;
            $client->otp_expires_at = null;
            $client->save();

            // ✅ Redirect langsung ke home.index
            return redirect()->route('home.index')->with('success', 'Akun sudah terverifikasi, selamat datang!');
        }

        return back()->withErrors(['otp_code' => 'Kode OTP tidak valid.']);
    }

    /**
     * Kirim ulang OTP baru
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
        ]);

        $client = Client_Model::where('email', $request->email)->first();

        if (!$client) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Generate OTP baru
        $otp = rand(100000, 999999);

        $client->otp_code = $otp;
        $client->otp_expires_at = now()->addMinutes(5);
        $client->save();

        // Kirim OTP baru ke email
        Mail::raw("Kode OTP baru Anda adalah: $otp (berlaku 5 menit)", function ($message) use ($client) {
            $message->to($client->email)
                    ->subject('Kode OTP Baru Registrasi');
        });

        return back()->with('success', 'Kode OTP baru sudah dikirim ke email Anda.');
    }
}
