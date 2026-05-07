@include('layout.head')
@include('layout.header')

<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-6xl mx-auto py-12 sm:px-6 lg:px-8 pt-16">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Reservasi Kamar
        </h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form
            action="{{ route('reservasi.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-8 bg-white p-6 rounded-2xl shadow-lg border border-gray-100"
        >
            @csrf

            <section class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">
                    Data Diri
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Nama Tamu</label>
                        <input
                            type="text"
                            name="nama_tamu"
                            value="{{ old('nama_tamu') }}"
                            placeholder="Nama Tamu"
                            required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_tamu') border-red-500 @enderror"
                        />
                        @error('nama_tamu')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Nomor Handphone</label>
                        <input
                            type="text"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            placeholder="08123456789"
                            required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_hp') border-red-500 @enderror"
                        />
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
    <label class="block mb-1 font-medium text-gray-700">Email</label>
    <input
        type="email"
        name="email"
        {{-- Jika user login, ambil emailnya. Jika tidak, gunakan old value --}}
        value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
        {{-- Tambahkan readonly jika user sudah login agar email tidak bisa diubah-ubah --}}
        {{ Auth::check() ? 'readonly' : '' }}
        placeholder="aaaa@gmail.com"
        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @if(Auth::check()) bg-gray-100 cursor-not-allowed @endif @error('email') border-red-500 @enderror"
    />
    @if(Auth::check())
        <p class="text-xs text-blue-600 mt-1"><i class="fas fa-info-circle"></i> Menggunakan email akun yang sedang login.</p>
    @endif
    @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Catatan</label>
                        <input
                            type="text"
                            name="catatan"
                            value="{{ old('catatan') }}"
                            placeholder="Catatan Reservasi"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('catatan') border-red-500 @enderror"
                        />
                        @error('catatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">
                    Detail Reservasi
                </h2>

                <div class="relative">
                    <div id="tableSlider" class="overflow-x-auto scroll-smooth border rounded-lg shadow-sm bg-white scrollbar-thin scrollbar-thumb-blue-400 scrollbar-track-gray-100">
                        <table class="min-w-[900px] w-full text-left border-collapse">
                            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                                <tr>
                                    <th class="py-3 px-4 border-b">No.</th>
                                    <th class="py-3 px-4 border-b">Tipe Kamar</th>
                                    <th class="py-3 px-4 border-b">Nomor Kamar</th>
                                    <th class="py-3 px-4 border-b">Dewasa</th>
                                    <th class="py-3 px-4 border-b">Anak</th>
                                    <th class="py-3 px-4 border-b">Check-in</th>
                                    <th class="py-3 px-4 border-b">Check-out</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 text-sm" id="reservationBody">
                                @php $totalHarga = 0; @endphp
                                @foreach(session('cart', []) as $item)
                                    @php
                                        $jumlahKamar = $item['jumlah_kamar'] ?? 1;
                                        $subtotal = ($item['harga'] ?? 0) * $jumlahKamar;
                                        $totalHarga += $subtotal;

                                        // Pisahkan check-in & check-out dari date_range
                                        if(isset($item['date_range'])){
                                            $dates = explode(' - ', $item['date_range']);
                                            $checkIn = $dates[0] ?? '-';
                                            $checkOut = $dates[1] ?? '-';
                                        } else {
                                            $checkIn = $item['check_in'] ?? $item['tanggal'] ?? '-';
                                            $checkOut = $item['check_out'] ?? $item['tanggal'] ?? '-';
                                        }
                                    @endphp
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-4">
                                            <input type="hidden" name="tipe_id" value="{{ $item['tipe_id'] ?? '' }}">
                                            {{ $item['tipe'] ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="hidden" name="nomor_kamar[]" value="{{ $item['nomor_kamar'] ?? $item['nomor'] ?? '-' }}" class="nomor-kamar">
                                            {{ $item['nomor_kamar'] ?? $item['nomor'] ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="hidden" name="jumlah_dewasa[]" value="{{ $item['dewasa'] ?? 0 }}">
                                            {{ $item['dewasa'] ?? 0 }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="hidden" name="jumlah_anak[]" value="{{ $item['anak'] ?? 0 }}">
                                            {{ $item['anak'] ?? 0 }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="hidden" name="check_in[]" value="{{ $checkIn }}">
                                            {{ $checkIn }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="hidden" name="check_out[]" value="{{ $checkOut }}">
                                            {{ $checkOut }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between absolute inset-y-1/2 left-0 right-0 pointer-events-none sm:flex md:hidden px-2">
                        <button id="prevTable" class="pointer-events-auto bg-gray-200 hover:bg-gray-300 p-2 rounded shadow">&larr;</button>
                        <button id="nextTable" class="pointer-events-auto bg-gray-200 hover:bg-gray-300 p-2 rounded shadow">&rarr;</button>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 rounded-lg flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-800">Total Harga:</span>
                    <span class="text-xl font-bold text-blue-700">
                        Rp{{ number_format($totalHarga,0,',','.') }}
                    </span>
                </div>
            </section>

            <section class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">
                    Pilihan Pembayaran
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="payment-option bg-white p-4 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:border-blue-400 transition" data-method="bca">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-800 font-bold text-sm">BCA</span>
                            </div>
                            <h3 class="font-medium text-gray-800">BCA</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">3589908</p>
                        <p class="text-sm text-gray-600">a.n Sukses Abadi</p>
                    </div>

                    <div class="payment-option bg-white p-4 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:border-blue-400 transition" data-method="gopay">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-800 font-bold text-sm">G</span>
                            </div>
                            <h3 class="font-medium text-gray-800">GO-PAY</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">082289765478</p>
                        <p class="text-sm text-gray-600">a.n Sukses Abadi</p>
                    </div>
                </div>

                <input type="hidden" name="payment_method" id="payment_method" value="{{ old('payment_method') }}" />
                @error('payment_method')
                    <p class="text-red-500 text-xs mt-1">Metode pembayaran wajib dipilih.</p>
                @enderror

                <div id="uploadContainer" class="mt-4 @if(!old('payment_method')) hidden @endif">
                    <label class="block mb-1 font-medium text-gray-700">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" accept="image/*" class="w-full border rounded-md p-2" />
                    @error('bukti_pembayaran')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md font-medium hover:bg-blue-700 transition flex items-center justify-center">
                <i class="fas fa-check-circle mr-2"></i> Checkout Sekarang
            </button>
        </form>
    </div>
</div>

<script>
    // Pilihan pembayaran
    const paymentOptions = document.querySelectorAll(".payment-option");
    const paymentInput = document.getElementById("payment_method");
    const uploadContainer = document.getElementById("uploadContainer");

    // Tentukan status awal upload container berdasarkan old input
    if (paymentInput.value) {
        uploadContainer.classList.remove("hidden");
        const selectedOption = document.querySelector(`.payment-option[data-method="${paymentInput.value}"]`);
        if (selectedOption) {
            selectedOption.classList.add("border-blue-500", "shadow-lg");
        }
    }


    paymentOptions.forEach((option) => {
        option.addEventListener("click", () => {
            paymentOptions.forEach((o) => o.classList.remove("border-blue-500", "shadow-lg"));
            option.classList.add("border-blue-500", "shadow-lg");
            paymentInput.value = option.dataset.method;
            uploadContainer.classList.remove("hidden");
        });
    });

    // Update tabel dengan JS (pisahkan check-in & check-out)
    document.addEventListener("DOMContentLoaded", () => {
        const cart = @json(session('cart') ?? []);
        const reservationBody = document.getElementById('reservationBody');

        for (let i = 0; i < reservationBody.rows.length; i++) {
            const row = reservationBody.rows[i];
            
            // Mencari input hidden Check-in dan Check-out
            // Catatan: Di HTML Anda, input hidden Check-in dan Check-out tidak memiliki class unik.
            // Kita asumsikan urutan kolom: Tipe Kamar (1), Nomor Kamar (2), Dewasa (3), Anak (4), Check-in (5), Check-out (6).
            // Input hidden berada di dalam sel 5 dan 6.
            const hiddenCheckIn = row.cells[5].querySelector('input[name="check_in[]"]');
            const hiddenCheckOut = row.cells[6].querySelector('input[name="check_out[]"]');
            
            // Karena session cart adalah array asosiatif, kita harus mengaksesnya dengan Object.values
            const item = Object.values(cart)[i];

            if (item && item.date_range) {
                const dates = item.date_range.split(' - ');
                const checkIn = dates[0] ?? '-';
                const checkOut = dates[1] ?? '-';
                
                if (hiddenCheckIn) hiddenCheckIn.value = checkIn;
                if (hiddenCheckOut) hiddenCheckOut.value = checkOut;
                
                // Update tampilan teks (Jika Anda tidak ingin mengandalkan blade di awal)
                // row.cells[5].textContent = checkIn;
                // row.cells[6].textContent = checkOut;
            }
        }

        // Slider tabel horizontal
        const tableSlider = document.getElementById('tableSlider');
        const prevTable = document.getElementById('prevTable');
        const nextTable = document.getElementById('nextTable');

        prevTable?.addEventListener('click', () => tableSlider.scrollBy({ left: -300, behavior: 'smooth' }));
        nextTable?.addEventListener('click', () => tableSlider.scrollBy({ left: 300, behavior: 'smooth' }));
    });
</script>

@include('layout.footer')