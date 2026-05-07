{{-- resources/views/success.blade.php --}}
@include('layout.head')
@include('layout.header')

@php
    // Pastikan $reservasi dan $detailReservasi dibawa dari controller
    $status = strtolower($reservasi->status ?? 'pending');
    $isCanceled = $status === 'cancelled' || $status === 'canceled';

    // Fungsi helper untuk memformat tanggal (karena kita tidak pakai model Eloquent)
    function formatTanggal($dateString) {
        // Cek jika string tanggal tidak null atau kosong
        return $dateString ? date('d-m-Y', strtotime($dateString)) : '-';
    }
@endphp

<div class="min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-16">
        <h1 class="text-3xl font-bold mb-8 text-center {{ $isCanceled ? 'text-gray-500' : 'text-green-700' }}">
            @if($isCanceled)
                ❌ Reservasi Dibatalkan
                <div class="mt-2 text-base font-normal text-gray-500">
                    Reservasi #{{ $reservasi->kode_reservasi }} telah dibatalkan.
                </div>
            @else
                ✅ Reservasi Berhasil
                <div class="mt-2 text-base font-normal text-green-600">
                    Silahkan menunggu konfirmasi admin.
                </div>
            @endif
        </h1>

        <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Detail Reservasi</h2>

            <p><strong>Nama Tamu:</strong> {{ $reservasi->nama_tamu }}</p>
            <p><strong>Email:</strong> {{ $reservasi->email ?? '-' }}</p>
            <p><strong>No. HP:</strong> {{ $reservasi->no_hp ?? '-' }}</p>
            <p><strong>Catatan:</strong> {{ $reservasi->catatan ?? '-' }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ strtoupper($reservasi->payment_method ?? '-') }}</p>

            @if($reservasi->bukti_pembayaran)
                <p><strong>Bukti Pembayaran:</strong></p>
                <img src="{{ asset($reservasi->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-64 mt-2 rounded-md border">
            @endif

            <h3 class="text-xl font-semibold text-gray-700 mt-4 mb-2">Detail Kamar</h3>
            
            <div class="overflow-x-auto border rounded-lg shadow-sm">
                <table class="min-w-[900px] w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-2 px-3">Tipe Kamar</th>
                            <th class="py-2 px-3">Nomor Kamar</th>
                            <th class="py-2 px-3">Dewasa</th>
                            <th class="py-2 px-3">Anak</th>
                            <th class="py-2 px-3">Check-in</th>
                            <th class="py-2 px-3">Check-out</th>
                            <th class="py-2 px-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailReservasi as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-3">{{ $item->tipe_nama ?? '-' }}</td> 
                            <td class="py-2 px-3">{{ $item->nomor_kamar ?? '-' }}</td>
                            <td class="py-2 px-3">{{ $item->jumlah_dewasa }}</td>
                            <td class="py-2 px-3">{{ $item->jumlah_anak }}</td>
                            
                            {{-- FORMAT TANGGAL --}}
                            <td class="py-2 px-3">{{ formatTanggal($item->check_in) }}</td> 
                            <td class="py-2 px-3">{{ formatTanggal($item->check_out) }}</td>
                            
                            <td class="py-2 px-3">Rp{{ number_format($item->subtotal,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 p-4 bg-blue-50 rounded-lg flex justify-between items-center font-semibold">
                <span>Total Harga:</span>
                <span class="text-xl text-blue-700">
                    Rp{{ number_format($reservasi->total_harga,0,',','.') }}
                </span>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('home.index') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')