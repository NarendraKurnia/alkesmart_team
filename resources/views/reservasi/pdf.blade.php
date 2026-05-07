<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservasi #{{ $reservasi->kode_reservasi }}</title>
    <style>
        /* Menggunakan font sederhana dan aman untuk mPDF */
        body { font-family: sans-serif; font-size: 12px; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #1e40af; margin: 0; font-size: 24px; }
        .header h2 { font-size: 14px; color: #555; }
        .data-tamu, .data-kamar { margin-bottom: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
        .data-tamu p, .total p { margin: 5px 0; }
        
        /* Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; color: #333; font-weight: bold; }
        
        .total { text-align: right; margin-top: 20px; font-size: 16px; }
        .total strong { color: #1e40af; }

        /* Fungsi format tanggal bawaan Blade */
        .tanggal { font-style: italic; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KONFIRMASI RESERVASI KAMAR</h1>
        <h2>Kode Reservasi: {{ $reservasi->kode_reservasi }}</h2>
        <h2>Status: {{ strtoupper($reservasi->status) }}</h2>
    </div>

    <div class="data-tamu">
        <h3>INFORMASI TAMU</h3>
        <p><strong>Nama Tamu:</strong> {{ $reservasi->nama_tamu }}</p>
        <p><strong>Email:</strong> {{ $reservasi->email ?? '-' }}</p>
        <p><strong>No. HP:</strong> {{ $reservasi->no_hp ?? '-' }}</p>
        <p><strong>Catatan:</strong> {{ $reservasi->catatan ?? '-' }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ strtoupper($reservasi->payment_method ?? '-') }}</p>
    </div>

    <div class="data-kamar">
        <h3>DETAIL KAMAR YANG DIBOOKING</h3>
        <table>
            <thead>
                <tr>
                    <th>Tipe Kamar</th>
                    <th>No. Kamar</th>
                    <th>Tamu (D/A)</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    function formatTanggalPDF($dateString) {
                        return $dateString ? date('d-m-Y', strtotime($dateString)) : '-';
                    }
                @endphp
                @foreach($detailReservasi as $item)
                <tr>
                    {{-- Menggunakan tipe_nama dari Controller yang sudah di JOIN --}}
                    <td>{{ $item->tipe_nama ?? 'Tipe Tidak Diketahui' }}</td> 
                    <td>{{ $item->nomor_kamar ?? '-' }}</td>
                    <td>{{ $item->jumlah_dewasa }}/{{ $item->jumlah_anak }}</td>
                    <td>{{ formatTanggalPDF($item->check_in) }}</td>
                    <td>{{ formatTanggalPDF($item->check_out) }}</td>
                    <td>Rp{{ number_format($item->subtotal,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <p>Total Pembayaran: <strong>Rp{{ number_format($reservasi->total_harga,0,',','.') }}</strong></p>
    </div>

    <p class="tanggal">Dokumen ini dibuat pada {{ date('d-m-Y H:i:s') }}.</p>
</body>
</html>