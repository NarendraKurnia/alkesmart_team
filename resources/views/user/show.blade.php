@include('layout.head')
@include('layout.header')

<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
                <p class="text-sm text-gray-500">Dibuat pada {{ $reservasi->created_at->format('d M Y, H:i') }}</p>
            </div>
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                        <i class="fas fa-user-circle text-blue-500 mr-2 text-lg"></i>
                        <h3 class="text-lg font-bold text-gray-700">Data Tamu & Booking</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                            <div>
                                <label class="text-xs uppercase tracking-wider text-gray-400 font-bold">Kode Reservasi</label>
                                <p class="text-gray-900 font-mono font-bold text-blue-600">#{{ $reservasi->kode_reservasi }}</p>
                            </div>
                            <div>
                                <label class="text-xs uppercase tracking-wider text-gray-400 font-bold">Status Pesanan</label>
                                <div>
                                    @php
                                        $colors = [
                                            'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                            'confirmed' => 'bg-green-100 text-green-700 border-green-200',
                                            'paid' => 'bg-green-100 text-green-700 border-green-200',
                                        ];
                                        $statusClass = $colors[strtolower($reservasi->status)] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                    @endphp
                                    <span class="px-2 py-0.5 rounded text-xs font-bold border {{ $statusClass }}">
                                        {{ strtoupper($reservasi->status) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs uppercase tracking-wider text-gray-400 font-bold">Nama Tamu</label>
                                <p class="text-gray-800">{{ $reservasi->nama_tamu }}</p>
                            </div>
                            <div>
                                <label class="text-xs uppercase tracking-wider text-gray-400 font-bold">Kontak</label>
                                <p class="text-gray-800">{{ $reservasi->no_hp }} / {{ $reservasi->email }}</p>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-lg border border-blue-100">
                                <label class="text-xs uppercase text-blue-400 font-bold">Check-In</label>
                                <p class="text-gray-900 font-bold">{{ date('d F Y', strtotime($reservasi->check_in)) }}</p>
                            </div>
                            <div class="p-3 bg-red-50 rounded-lg border border-red-100">
                                <label class="text-xs uppercase text-red-400 font-bold">Check-Out</label>
                                <p class="text-gray-900 font-bold">{{ date('d F Y', strtotime($reservasi->check_out)) }}</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <h6 class="text-sm font-bold text-gray-700 mb-2">Catatan Tamu:</h6>
                            <p class="text-gray-600 text-sm italic bg-gray-50 p-3 rounded border">
                                "{{ $reservasi->catatan ?: 'Tidak ada catatan tambahan.' }}"
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                        <i class="fas fa-bed text-blue-500 mr-2 text-lg"></i>
                        <h3 class="text-lg font-bold text-gray-700">Detail Kamar</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Tipe Kamar</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase text-center">Tamu</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                {{-- Jika model Anda menggunakan Relasi details --}}
                                @forelse ($reservasi->details as $detail)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $detail->tipeKamar->nama_tipe ?? 'Tipe Tidak Dikenal' }}</div>
                                        <div class="text-xs text-gray-500">Nomor Kamar: {{ $detail->nomor_kamar ?: 'Menunggu Penugasan' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                                        {{ $detail->jumlah_dewasa }} Dewasa, {{ $detail->jumlah_anak }} Anak
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-gray-900">
                                        Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                {{-- Fallback jika struktur tabel simpel (langsung ke id_kamar) --}}
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $reservasi->kamar->tipe->nama_tipe ?? 'Kamar' }}</div>
                                        <div class="text-xs text-gray-500">No: {{ $reservasi->kamar->nomor_kamar }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                                        {{ $reservasi->jumlah_dewasa }} Dewasa, {{ $reservasi->jumlah_anak }} Anak
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-gray-900">
                                        Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <th colspan="2" class="px-6 py-4 text-right text-gray-500 uppercase text-xs font-bold">Total Pembayaran</th>
                                    <th class="px-6 py-4 text-right text-xl font-extrabold text-blue-600">
                                        Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden text-center p-6">
                    <div class="mb-4 flex items-center justify-center">
                        <i class="fas fa-wallet text-gray-400 mr-2 text-lg"></i>
                        <h3 class="text-lg font-bold text-gray-700">Metode Pembayaran</h3>
                    </div>
                    <p class="text-gray-600 font-semibold bg-gray-100 py-2 rounded-lg border border-dashed border-gray-300">
                        {{ $reservasi->payment_method ?: 'Belum ditentukan' }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center">
                        <i class="fas fa-image text-blue-500 mr-2 text-lg"></i>
                        <h3 class="text-lg font-bold text-gray-700">Bukti Transfer</h3>
                    </div>
                    <div class="p-6 text-center">
                        @if ($reservasi->bukti_pembayaran)
                            @php $buktiUrl = asset($reservasi->bukti_pembayaran); @endphp
                            <div class="group relative inline-block overflow-hidden rounded-lg border shadow-sm">
                                <img src="{{ $buktiUrl }}" class="max-h-64 mx-auto object-contain transition duration-300 group-hover:scale-105" alt="Bukti Pembayaran">
                                <a href="{{ $buktiUrl }}" target="_blank" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                    <span class="text-white text-xs font-bold bg-blue-600 px-3 py-1 rounded">Lihat Detail</span>
                                </a>
                            </div>
                        @else
                            <div class="py-8">
                                <div class="bg-red-50 text-red-500 rounded-lg p-4 border border-red-100">
                                    <i class="fas fa-exclamation-circle text-3xl mb-2"></i>
                                    <p class="text-sm font-bold uppercase tracking-tighter">Bukti Belum Diunggah</p>
                                </div>
                                <p class="text-xs text-gray-400 mt-4">Pesanan Anda akan dikonfirmasi setelah bukti pembayaran divalidasi oleh admin.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('layout.footer')