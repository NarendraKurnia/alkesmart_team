<?php

namespace App\Http\Controllers\Adminvillas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_Model; 
use App\Models\Reservasi; 
use Carbon\Carbon; 

class ReservasiController extends Controller
{
    // Mengambil data pegawai untuk wrapper
    protected function getPegawaiData()
    {
        $pegawai_id = session()->get('pegawai_id');
        return $pegawai_id ? Pegawai_Model::where('id_pegawai', $pegawai_id)->first() : null;
    }

    // Fungsi dasar untuk memuat data reservasi dengan Eager Loading
    private function loadReservasiByStatus($status)
    {
        return Reservasi::where('status', $status)
                        ->with(['details.tipeKamar'])
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15);
    }
    
    // --- 1. RESERVASI PENDING (Perlu Konfirmasi Pembayaran) ---
    public function pending()
    {
        $reservasi = $this->loadReservasiByStatus('pending');
        
        $data = [
            'title'     => 'Reservasi Perlu Konfirmasi (Pending)',
            'reservasi' => $reservasi,
            'pegawai'   => $this->getPegawaiData(),
            'content'   => 'adminvillas/reservasi/pending' 
        ];

        return view('adminvillas/layout/wrapper', $data);
    }
    
    // --- 2. RESERVASI PAID/CONFIRMED (Siap Check-in) ---
    public function confirmed()
    {
        $reservasi = $this->loadReservasiByStatus('paid');
        
        $data = [
            'title'     => 'Reservasi Berhasil (Paid/Siap Check-in)',
            'reservasi' => $reservasi,
            'pegawai'   => $this->getPegawaiData(),
            'content'   => 'adminvillas/reservasi/confirmed' 
        ];

        return view('adminvillas/layout/wrapper', $data);
    }

    // --- 3. RESERVASI CHECK-IN (Sedang Menginap) ---
    public function checkin()
    {
        $reservasi = $this->loadReservasiByStatus('checkin');
        
        $data = [
            'title'     => 'Reservasi Sedang Check-In',
            'reservasi' => $reservasi,
            'pegawai'   => $this->getPegawaiData(),
            'content'   => 'adminvillas/reservasi/checkin' 
        ];

        return view('adminvillas/layout/wrapper', $data);
    }

    // --- 4. RESERVASI COMPLETED (Selesai) ---
    public function completed()
    {
        $reservasi = $this->loadReservasiByStatus('selesai');
        
        $data = [
            'title'     => 'Reservasi Selesai',
            'reservasi' => $reservasi,
            'pegawai'   => $this->getPegawaiData(),
            'content'   => 'adminvillas/reservasi/completed' 
        ];

        return view('adminvillas/layout/wrapper', $data);
    }

    // ===================================================
    // AKSI CRUD / STATUS
    // ===================================================

    // Aksi untuk mengkonfirmasi pembayaran dari status 'pending' ke 'paid'
    public function konfirmasi($id_reservasi)
    {
        try {
            $reservasi = Reservasi::find($id_reservasi);

            if (!$reservasi || $reservasi->status !== 'pending') {
                return redirect()->back()->with('warning', 'Reservasi tidak ditemukan atau sudah dikonfirmasi/dibatalkan.');
            }

            $reservasi->status = 'paid'; 
            // BARIS DI BAWAH DIHAPUS KARENA KOLOM TIDAK ADA DI DB/MODEL: $reservasi->tanggal_konfirmasi = now();
            $reservasi->save(); 
            
            return redirect()->route('adminvillas.reservasi.confirmed')->with('success', 'Reservasi berhasil dikonfirmasi dan dipindahkan ke Pesanan Berhasil (Paid).');
            
        } catch (\Exception $e) {
            \Log::error("Konfirmasi Reservasi ID {$id_reservasi} Gagal: " . $e->getMessage());
            return redirect()->back()->with('error', 'Konfirmasi gagal diproses. Silakan cek log aplikasi.');
        }
    }


    // Aksi untuk membatalkan/menolak reservasi
    public function batalkan($id_reservasi)
    {
        $reservasi = Reservasi::find($id_reservasi);

        if (!$reservasi) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        try {
            $reservasi->status = 'cancelled';
            // BARIS DI BAWAH DIHAPUS KARENA KOLOM TIDAK ADA DI DB/MODEL: $reservasi->cancelled_at = Carbon::now();
            $reservasi->save();
            
            // TODO: Di sini Anda harus mengembalikan/mengupdate stok kamar
            
            return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan reservasi: ' . $e->getMessage());
        }
    }
    
    // Aksi untuk Check-in (dari 'paid' ke 'checkin')
    public function prosesCheckin($id_reservasi)
    {
        $reservasi = Reservasi::find($id_reservasi);

        if (!$reservasi || $reservasi->status !== 'paid') {
            return redirect()->back()->with('error', 'Reservasi tidak valid untuk Check-in. Status harus PAID.');
        }

        try {
            $reservasi->status = 'checkin';
            // BARIS DI BAWAH DIHAPUS KARENA KOLOM TIDAK ADA DI DB/MODEL: $reservasi->check_in_time = Carbon::now();
            $reservasi->save();
            
            return redirect()->route('adminvillas.reservasi.checkin')->with('success', 'Tamu berhasil Check-in. Reservasi dipindahkan ke Sedang Check-in.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Check-in: ' . $e->getMessage());
        }
    }
    
    // Aksi untuk Check-out (dari 'checkin' ke 'selesai')
    public function prosesCheckout($id_reservasi)
    {
        $reservasi = Reservasi::find($id_reservasi);

        if (!$reservasi || $reservasi->status !== 'checkin') {
            return redirect()->back()->with('error', 'Reservasi tidak valid untuk Check-out. Status harus CHECKIN.');
        }

        try {
            $reservasi->status = 'selesai';
            // BARIS DI BAWAH DIHAPUS KARENA KOLOM TIDAK ADA DI DB/MODEL: $reservasi->check_out_time = Carbon::now();
            $reservasi->save();
            
            // TODO: Di sini Anda mungkin perlu melakukan finalisasi tagihan
            
            return redirect()->route('adminvillas.reservasi.completed')->with('success', 'Tamu berhasil Check-out. Reservasi Selesai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Check-out: ' . $e->getMessage());
        }
    }
    
    public function show($id_reservasi)
    {
        // ... (Fungsi show tidak diubah, sudah benar)
        $reservasi = Reservasi::where('id_reservasi', $id_reservasi)
                              ->with(['details.tipeKamar'])
                              ->first();

        if (!$reservasi) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        $data = [
            'title'     => 'Detail Reservasi: ' . $reservasi->kode_reservasi,
            'reservasi' => $reservasi,
            'pegawai'   => $this->getPegawaiData(),
            'content'   => 'adminvillas/reservasi/show' 
        ];

        return view('adminvillas/layout/wrapper', $data);
    }
}