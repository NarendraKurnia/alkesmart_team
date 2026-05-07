<?php

namespace App\Http\Controllers\Adminvillas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Digunakan untuk menghitung statistik reservasi
use App\Models\Pegawai_Model; // Diperlukan untuk mengambil data pegawai
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    // --- LOGIC PENGAMBILAN DATA STATISTIK RESERVASI ---
    
    // 1. Pesanan Perlu Konfirmasi (Status: pending) -> SUDAH BENAR
    $pendingCount = DB::table('reservasi')->where('status', 'pending')->count();

    // 2. Pesanan Berhasil (Status di DB adalah 'paid')
    // Sebelumnya Anda menulis 'confirmed', itu salah.
    $confirmedCount = DB::table('reservasi')->where('status', 'paid')->count();

    // 3. Pesanan Check-In (Status di DB adalah 'checkin')
    // Sebelumnya Anda menulis 'check_in', itu salah.
    $checkinCount = DB::table('reservasi')->where('status', 'checkin')->count();
    
    // 4. Pesanan Selesai (Status di DB adalah 'selesai')
    // Sebelumnya Anda menulis 'completed', itu salah.
    $completedCount = DB::table('reservasi')->where('status', 'selesai')->count();

    // 5. Total Keseluruhan Pesanan
    $totalReservasi = DB::table('reservasi')->count();


    // --- LOGIC PENGAMBILAN DATA PEGAWAI ---
    $pegawai_id = session()->get('pegawai_id');
    $pegawai = null;
    if ($pegawai_id) {
        $pegawai = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();
    }


    // --- RETURN VIEW ---
    $data = [
        'title'             => 'Dasbor Administrator',
        'pegawai'           => $pegawai,
        'pendingCount'      => $pendingCount,
        'confirmedCount'    => $confirmedCount,
        'checkinCount'      => $checkinCount,
        'completedCount'    => $completedCount,
        'totalReservasi'    => $totalReservasi,
        'content'           => 'adminvillas/dashboard/index' 
    ];

    return view('adminvillas/layout/wrapper', $data);
}
}