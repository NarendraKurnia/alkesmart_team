<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TipeKamar;

class CheckoutController extends Controller
{
    public function index()
    {
        $title = "Reservasi Kamar";
        return view('reservasi.index', compact('title'));
    }

    // CATATAN: Method ini sepertinya tidak terpakai/tertimpa, saya hapus saja.

    // app/Http/Controllers/Public/CheckoutController.php

    public function store(Request $request)
    {
        // 1. Perbaiki Validasi & Nama Field
        $request->validate([
            'nama_tamu' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'payment_method' => 'required|string',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Ambil Cart Session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('kamar.index')->with('error', 'Keranjang Anda kosong.');
        }

        // 2. Hitung Total Harga dari Cart (Lebih akurat)
        $totalHarga = 0;
        $jumlahKamarTotal = 0;
        $jumlahDewasaTotal = 0;
        $jumlahAnakTotal = 0;

        foreach ($cart as $item) {
            // Asumsi $item['harga'] adalah harga subtotal untuk item tersebut (harga * malam * quantity)
            $jumlahKamar = $item['quantity'] ?? 1;
            $totalHarga += ($item['harga'] ?? 0);
            $jumlahKamarTotal += $jumlahKamar;
            $jumlahDewasaTotal += ($item['dewasa'] ?? 0) * $jumlahKamar;
            $jumlahAnakTotal += ($item['anak'] ?? 0) * $jumlahKamar;
        }
        
        // Ambil Check-in/out dari item pertama untuk disimpan di header reservasi
        $firstItem = reset($cart);
        $checkInGlobal = $firstItem['check_in_raw'] ?? $firstItem['check_in'] ?? null;
        $checkOutGlobal = $firstItem['check_out_raw'] ?? $firstItem['check_out'] ?? null;
        
        // Cek dan upload bukti pembayaran
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('admin/upload/transaksi'), $filename);
            $buktiPath = 'admin/upload/transaksi/'.$filename;
        }


        // 3. Gunakan Transaction untuk menyimpan
        try {
            DB::beginTransaction();

            // Simpan ke tabel reservasi (Header)
            $idReservasi = DB::table('reservasi')->insertGetId([
                'kode_reservasi'   => 'RSV-'.time(),
                'nama_tamu'        => $request->nama_tamu,
                'email'            => $request->email,
                'no_hp'            => $request->no_hp,
                
                'jumlah_dewasa'    => $jumlahDewasaTotal,
                'jumlah_anak'      => $jumlahAnakTotal,
                'jumlah_kamar'     => $jumlahKamarTotal, 
                'check_in'         => $checkInGlobal,
                'check_out'        => $checkOutGlobal,
                
                'payment_method'   => $request->payment_method,
                'bukti_pembayaran' => $buktiPath,
                'total_harga'      => $totalHarga,
                'status'           => 'pending',
                'catatan'          => $request->catatan,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // Simpan ke tabel detail reservasi (Loop Cart Items)
            $detailData = [];
            foreach ($cart as $id_kamar => $item) {
                $tipeId = $item['tipe_id'] ?? null;
                
                // 🛑 PERBAIKAN UTAMA: Jika tipe_id tidak ada di cart, cari berdasarkan nama.
                // Kueri yang salah: TipeKamar::where('nama', $item['tipe'] ?? '')->first(); 
                // Kueri yang benar (asumsi kolom nama adalah 'nama_tipe'):
                if (!$tipeId && isset($item['tipe'])) {
                    $tipe = TipeKamar::where('nama_tipe', $item['tipe'])->first();
                    $tipeId = $tipe->id ?? null;
                }
                
                // Jika tipeId masih null, kita abaikan atau lempar exception
                if (!$tipeId) {
                    throw new \Exception("Tipe Kamar tidak ditemukan untuk item: " . ($item['tipe'] ?? 'Unknown'));
                }

                $detailData[] = [
                    'reservasi_id' => $idReservasi,
                    'tipe_id' => $tipeId,
                    'nomor_kamar' => $item['nomor'] ?? null,
                    'jumlah_dewasa' => $item['dewasa'] ?? 0,
                    'jumlah_anak' => $item['anak'] ?? 0,
                    'harga' => $item['harga_permalam'] ?? 0, 
                    'subtotal' => $item['harga'] ?? 0, 
                    'check_in' => $item['check_in_raw'] ?? $item['check_in'] ?? $checkInGlobal,
                    'check_out' => $item['check_out_raw'] ?? $item['check_out'] ?? $checkOutGlobal,
                    'catatan_detail' => null, // Jika ada
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($detailData)) {
                DB::table('reservasi_detail')->insert($detailData);
            }
            
            // 4. Hapus Cart Session setelah berhasil
            session()->forget('cart');

            DB::commit();

            return redirect()->route('reservasi.succes', ['orderId' => $idReservasi]);

        } catch (\Exception $e) {
            DB::rollBack();
            // Log error untuk debug
            \Log::error("Reservasi failed: " . $e->getMessage()); 
            // Tampilkan error yang terperinci di flash session untuk debugging
            return back()->withInput()->with('error', 'Pemesanan gagal diproses. Silakan coba lagi. Detail: ' . $e->getMessage());
        }
    }

    // app/Http/Controllers/Public/CheckoutController.php

    public function succes($orderId) // Ganti $id menjadi $orderId agar konsisten
    {
        // Ambil data reservasi utama
        $reservasi = DB::table('reservasi')->where('id_reservasi', $orderId)->first();
        
        if (!$reservasi) {
            abort(404, 'Reservasi tidak ditemukan.');
        }
        
        // Ambil data detail reservasi dan JOIN dengan tipe_kamar
        $detailReservasi = DB::table('reservasi_detail')
                            ->leftJoin('tipe_kamar', 'reservasi_detail.tipe_id', '=', 'tipe_kamar.id')
                            ->select('reservasi_detail.*', 'tipe_kamar.nama_tipe as tipe_nama') // Asumsi nama kolom adalah nama_tipe
                            ->where('reservasi_id', $orderId)
                            ->get(); 
                            
        $title = "Reservasi Berhasil";

        // Kirim data dengan nama variabel yang sesuai dengan di view
        return view('reservasi.succes', compact('reservasi', 'detailReservasi', 'title'));
    }

    public function downloadPdf($id)
{
    // Ambil data reservasi utama
    $reservasi = DB::table('reservasi')->where('id_reservasi', $id)->first();
    
    if (!$reservasi) {
        abort(404, 'Reservasi tidak ditemukan.');
    }
    
    // Ambil data detail reservasi dan JOIN dengan tipe_kamar
    $detailReservasi = DB::table('reservasi_detail')
                        ->leftJoin('tipe_kamar', 'reservasi_detail.tipe_id', '=', 'tipe_kamar.id')
                        ->select('reservasi_detail.*', 'tipe_kamar.nama_tipe as tipe_nama')
                        ->where('reservasi_id', $id)
                        ->get(); 
                        
    // Cek apakah status sudah confirmed
    if (strtolower($reservasi->status) !== 'confirmed') {
        return back()->with('error', 'Tiket hanya dapat diunduh setelah pembayaran dikonfirmasi oleh admin.');
    }

    // Load view PDF dengan data yang sudah diambil
    $pdf = Pdf::loadView('reservasi.pdf', compact('reservasi', 'detailReservasi'));

    // Unduh PDF
    return $pdf->download('tiket-reservasi-'.$reservasi->kode_reservasi.'.pdf');
}

    public function cancel($id)
    {
        DB::table('reservasi')->where('id_reservasi', $id)->update([
            'status' => 'cancelled',
            'shipping_status' => 'cancelled', // Asumsi kolom ini ada
            'updated_at' => now()
        ]);

        // Perbaikan: gunakan $id, bukan $orderId
        return redirect()->route('reservasi.succes', ['orderId' => $id])
                         ->with('success', 'Reservasi berhasil dibatalkan.');
    }
}