@include('layout.head')
@include('layout.header')

<div class="bg-gray-50 min-h-screen py-10 pt-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $title }}</h1>
            <p class="mt-2 text-sm text-gray-600 font-medium">Halo, {{ $user->name }}. Berikut adalah daftar reservasi Anda.</p>
        </div>

        @if($reservasi->isEmpty())
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mt-2">Sepertinya Anda belum melakukan reservasi kamar.</p>
                <a href="/" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Cari Kamar Sekarang
                </a>
            </div>
        @else
            <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kamar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check-in / Out</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($reservasi as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-blue-600 font-bold">
                                    #{{ $row->kode_reservasi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $row->kamar->tipe->nama_tipe ?? 'Kamar' }}</div>
                                    <div class="text-xs text-gray-500">No: {{ $row->kamar->nomor_kamar ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900 font-medium">
                                        In: {{ \Carbon\Carbon::parse($row->check_in)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Out: {{ \Carbon\Carbon::parse($row->check_out)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    Rp{{ number_format($row->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColor = [
                                            'pending'   => 'bg-yellow-100 text-yellow-800',
                                            'paid'      => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            'checkin'   => 'bg-blue-100 text-blue-800',
                                            'checkout'  => 'bg-gray-100 text-gray-800'
                                        ];
                                        $color = $statusColor[strtolower($row->status)] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('user.reservasi.show', $row->id_reservasi) }}" 
   class="text-blue-600 hover:text-blue-900 bg-blue-50 px-3 py-1 rounded border border-blue-200 shadow-sm transition duration-200">
    <i class="fas fa-eye mr-1"></i> Detail
</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

@include('layout.footer')