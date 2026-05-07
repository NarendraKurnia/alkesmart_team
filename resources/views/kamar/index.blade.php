@include('layout.head')
@include('layout.header')
{{-- TEMPATKAN SETELAH @include('layout.header') --}}
@if(isset($debug))
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 m-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-bug text-yellow-400"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-yellow-800">Debug Info</h3>
            <div class="mt-2 text-sm text-yellow-700">
                <p><strong>Tanggal Check-in:</strong> {{ $filters['check_in'] ?? 'null' }}</p>
                <p><strong>Tanggal Check-out:</strong> {{ $filters['check_out'] ?? 'null' }}</p>
                <p><strong>Total Kamar di DB:</strong> {{ \App\Models\Kamar::count() }}</p>
                <p><strong>Kamar tersedia tanpa filter:</strong> {{ \App\Models\Kamar::where('status', 'Tersedia')->count() }}</p>
                <p><strong>Reservasi aktif:</strong> 
                    @php
                        $reservasiAktif = \App\Models\Reservasi::whereIn('status', ['Confirmed', 'Paid', 'Check-in', 'Pending'])
                            ->pluck('id_kamar');
                        echo $reservasiAktif->implode(', ');
                    @endphp
                </p>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Notifikasi Custom -->
<div id="customAlert" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-4 max-w-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <p id="alertMessage" class="text-sm font-medium text-gray-800"></p>
            </div>
            <button onclick="hideCustomAlert()" class="ml-auto flex-shrink-0 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<!-- Notifikasi Error -->
<div id="errorAlert" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg border-l-4 border-red-500 p-4 max-w-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <p id="errorMessage" class="text-sm font-medium text-gray-800"></p>
            </div>
            <button onclick="hideErrorAlert()" class="ml-auto flex-shrink-0 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<!-- Modal Login Required -->
<div id="loginRequiredModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60] hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-4 shadow-xl">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Login Diperlukan</h3>
                <p class="text-sm text-gray-600" id="loginRequiredMessage">Anda harus login untuk melanjutkan</p>
            </div>
        </div>
        <p class="text-gray-600 mb-6 text-sm">
            Silakan login terlebih dahulu untuk mengakses fitur ini. Jika belum memiliki akun, Anda dapat mendaftar terlebih dahulu.
        </p>
        <div class="flex flex-col sm:flex-row gap-2">
            <button onclick="hideLoginRequiredModal()" 
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors border border-gray-300 rounded order-2 sm:order-1">
                Nanti Saja
            </button>
            <div class="flex gap-2 order-1 sm:order-2">
                <a href="{{ route('register') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors text-center flex-1">
                    Daftar
                </a>
                <a href="{{ route('login') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors text-center flex-1">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto p-6 pt-20">
  <h2 class="text-2xl font-semibold mb-4 pt-4">
    Tipe Kamar yang Tersedia di <span class="font-bold">Arum Bromo Villas</span>
  </h2>

  @if($kamar->count() > 0)
    @foreach($kamar as $item)
    @php
      // uniq id modal
      $uniq = $item->id ?? $item->id_kamar ?? $loop->index;

      // prefer gambar per-kamar jika ada, lalu gambar per-tipe, lalu fallback placeholder
      $images = collect();
      if (isset($item->images) && count($item->images)) {
          $images = collect($item->images)->map(fn($g) => $g->gambar ?? $g->path ?? $g->url);
      } elseif (isset($item->tipe) && isset($item->tipe->images) && count($item->tipe->images)) {
          $images = collect($item->tipe->images)->map(fn($g) => $g->gambar ?? $g->path ?? $g->url);
      }

      // -- gallery dari relasi gambarKamar (kalau ada judul per gambar)
      $galleryCollection = collect();
      if (isset($item->tipe) && isset($item->tipe->gambarKamar) && count($item->tipe->gambarKamar)) {
          $galleryCollection = collect($item->tipe->gambarKamar)
            ->filter(fn($g) => !empty($g->gambar))
            ->values();
      }

      // buat url dan judul untuk gallery (dipakai di modal)
      $galleryUrls = $galleryCollection->map(fn($g) => asset('admin/upload/room/'.$g->gambar))->values();
      $galleryTitles = $galleryCollection->map(fn($g) => $g->judul ?? '')->values();

      // fallback jika kosong
      if ($galleryUrls->isEmpty()) {
          $galleryUrls = collect(['https://via.placeholder.com/1200x800?text=No+Image']);
          $galleryTitles = collect(['No Image']);
      }

      $totalImages = $galleryUrls->count();

      // existing $images (dipakai di card preview) => kalau kosong gunakan first of galleryUrls
      if ($images->isEmpty()) {
          $images = collect([$galleryUrls->first()]);
      }

      $uniq = $item->id ?? $item->id_kamar ?? $loop->index;
    $basePrice = $item->base_price ?? $item->harga ?? 0;
    $finalPrice = $item->final_price ?? $basePrice;
    $holidayMarkup = $item->holiday_markup_percentage ?? 20.00;
    $calculatedPrice = $item->calculated_price;
    @endphp

    <!-- Card -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden border mb-6">
      <div class="md:flex">
        <!-- LEFT -->
        <div class="md:w-1/3 p-4">
          <div class="rounded-lg overflow-hidden bg-gray-100">
            <img src="{{ $images->first() }}" alt="{{ $item->tipe->nama_tipe ?? 'Kamar' }}" class="w-full h-48 object-cover">
          </div>

          <div class="flex items-center gap-2 mt-3">
            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
            <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            <div class="w-2 h-2 rounded-full bg-gray-300"></div>
          </div>

          <div class="mt-4 grid grid-cols-2 gap-3 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18M3 12h18M3 17h18"></path></svg>
              <span>{{ $item->luas ?? '42' }} m²</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18v10H3zM7 7v6"></path></svg>
              <span>{{ $item->bed ?? '1 king bed' }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 12h8M16 8c1.333 1.333 1.333 3 0 4.333"></path></svg>
              <span>{{ $item->smooking_tipe ?? 'Non Smoking' }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2 8a16 16 0 0120 0M5 11a11 11 0 0114 0M8 14a6 6 0 018 0"></path></svg>
              <span>WIFI Gratis</span>
            </div>
          </div>

          <!-- open modal - FIXED -->
          <button onclick="openModal('modal-{{ $uniq }}')" class="inline-block mt-4 text-blue-600 font-medium hover:underline">
            Lihat Detail Kamar
          </button>
        </div>

        <!-- RIGHT -->
        <div class="md:flex-1 p-4 border-l">
          <div class="md:flex md:items-start md:justify-between">
            <div>
              <h3 class="text-xl font-semibold">{{ $item->tipe->nama_tipe ?? 'Tipe' }}</h3>
              <p class="text-sm text-gray-500 mt-1">{{ $item->tipe->nama_tipe ?? 'Tipe' }} - Room Only • Tidak termasuk sarapan</p>
            </div>

            <div class="mt-3 md:mt-0 md:text-right">
              <div class="text-sm text-gray-600">Tamu</div>
              <div class="flex items-center gap-4 justify-end">
                <div class="flex items-center gap-1">
                  <span class="text-lg">👤</span>
                  <span class="text-gray-700">{{ $item->kapasitas_dewasa ?? 2 }}</span>
                </div>
                <div class="flex items-center gap-1">
                  <span class="text-lg">👶</span>
                  <span class="text-gray-700">{{ $item->kapasitas_anak ?? 0 }}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4 border rounded-md overflow-hidden">
            <div class="grid md:grid-cols-3 gap-0">
              <div class="p-4 col-span-2">
                <div class="text-sm text-gray-700">
                  <div class="font-medium">{{ $item->nomor_kamar ?? 'No' }} - Room Only</div>
                  <div class="text-xs text-gray-500 mt-1">Tidak termasuk sarapan</div>
                </div>
                <!-- Tampilkan tanggal yang dipilih -->
                <div class="mt-2 text-xs text-gray-600" id="selectedDatesDisplay-{{ $uniq }}">
                  Tanggal: <span id="checkInDisplay-{{ $uniq }}"></span> - <span id="checkOutDisplay-{{ $uniq }}"></span>
                  <div class="nights-info text-xs text-green-600 font-semibold mt-1" id="nightsInfo-{{ $uniq }}"></div>
                </div>
              </div>
              
              <div class="p-4 border-l bg-gray-50 flex flex-col justify-between">
  <div class="text-xs text-gray-500 text-right">Harga/kamar/malam</div>
  <div class="mt-2 text-right"> 
    @if($item->harga_diskon && $item->harga_diskon < $item->harga)
      <!-- Jika ada harga diskon yang valid -->
      <div class="harga-wrapper">
        <span class="text-secondary"><strike>Rp {{ number_format($item->harga, 0, ',', '.') }}</strike></span> 
        @php
          $diskonPersen = round((($item->harga - $item->harga_diskon) / $item->harga) * 100);
        @endphp
        <span class="text-danger">{{ $diskonPersen }}%</span> 
        <div class="text-2xl font-bold text-orange-600">
          Rp {{ number_format($item->harga_diskon, 0, ',', '.') }}
        </div> 
        <div class="text-xs text-gray-500">Harga normal: Rp {{ number_format($item->harga, 0, ',', '.') }}</div> 
      </div> 
    @else
      <!-- Jika tidak ada diskon, tampilkan harga normal -->
      <div class="harga-wrapper">
        <div class="text-2xl font-bold text-orange-600">
          Rp {{ number_format($item->harga, 0, ',', '.') }}
        </div> 
        <div class="text-xs text-gray-500">Di luar pajak & biaya</div> 
      </div> 
    @endif
  </div>
  <div class="mt-4">
    <!-- FORM AJAX VERSION -->
    <form class="add-to-cart-form" 
          data-id="{{ $item->id ?? $item->id_kamar }}" 
          data-nama="{{ $item->tipe->nama_tipe ?? '' }}"
          data-nomor="{{ $item->nomor_kamar ?? '' }}"
          data-tipe="{{ $item->tipe->nama_tipe ?? 'Deluxe' }}"
          data-harga="{{ $item->harga_diskon && $item->harga_diskon < $item->harga ? $item->harga_diskon : $item->harga }}"
          data-dewasa="{{ $item->kapasitas_dewasa ?? 1 }}"
          data-anak="{{ $item->kapasitas_anak ?? 0 }}"
          data-gambar="{{ $images->first() }}"
          data-csrf-token="{{ csrf_token() }}">
      @csrf
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full inline-block text-center hover:bg-blue-700">
          Pilih
      </button>
    </form>
  </div>
</div>
            </div>
          </div>

          <div class="mt-4 text-sm text-gray-500">
            <span class="font-medium">Catatan:</span> Harga dapat berubah berdasarkan tanggal dan ketersediaan.
          </div>
        </div>
      </div>
    </div>

    <!-- ================= DETAIL KAMAR MODAL CONTENT ================= -->
<!-- ================== MODAL DETAIL KAMAR ================== -->
<div id="modal-{{ $uniq }}"
     class="fixed inset-0 bg-black/60 z-50 hidden flex justify-center items-start overflow-y-auto py-10">

    <div class="bg-white w-full max-w-4xl rounded-lg shadow-xl p-6 relative">

        <!-- Tombol Close -->
        <button onclick="closeModal('modal-{{ $uniq }}')" 
                class="absolute top-3 right-3 text-gray-600 hover:text-black text-2xl">
            &times;
        </button>

        <!-- === MASUKKAN SEMUA KONTEN DETAIL DI SINI === -->
        <div class="grid md:grid-cols-3 gap-6">

            <!-- LEFT: Gambar besar + Thumbnail -->
            <div class="md:col-span-2">
                <div class="relative w-full h-[300px] md:h-[380px] bg-gray-200 rounded-lg overflow-hidden">
                    <img id="mainImage-{{ $uniq }}" 
                        src="{{ $galleryUrls->first() }}" 
                        class="w-full h-full object-cover transition-all">
                </div>

                <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                    @foreach($galleryUrls as $idx => $img)
                    <img 
                        src="{{ $img }}"
                        onclick="changeMainImage('{{ $uniq }}', '{{ $img }}')"
                        class="w-24 h-20 object-cover rounded cursor-pointer border hover:opacity-80 transition"
                    >
                    @endforeach
                </div>
            </div>

            <!-- RIGHT: Info Kamar -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-800">Info Kamar</h4>
                <div class="space-y-2 text-sm text-gray-700">
                <!-- Luas kamar -->
                <div class="flex items-center gap-2">
                    📐 {{ $item->luas ?? '42' }} m²
                </div>

                <!-- Kapasitas tamu -->
                <div class="flex items-center gap-2">
                    👥 {{ $item->kapasitas_dewasa ?? 2 }} tamu
                </div>

                <!-- Tipe Bed -->
                <div class="flex items-center gap-2">
                    🛏️ {{ $item->bed ?? 'Queen Bed' }}
                </div>

                <!-- Smoking / Non-smoking -->
                <div class="flex items-center gap-2">
                    🚬 {{ $item->smooking_tipe ?? 'Non-Smoking' }}
                </div>
            </div>

                <hr>

                <h4 class="text-lg font-semibold text-gray-800">Fitur Kamar</h4>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li>🛁 Bathtub</li>
                    <li>❄️ AC</li>
                    <li>🪑 Area tempat duduk</li>
                </ul>
                <hr>
                <div class="text-lg font-semibold text-gray-800">{!! $item->item_room ?? '<em>Tidak ada Item</em>' !!} </div>
                <hr>
                <div class="text-lg font-semibold text-gray-800">Deskripsi </div>
                <div class="text-small text-gray-800">{!! $item->keterangan ?? '<em>Tidak ada keterangan</em>' !!}</div>

                <hr>
                

                <div class="bg-gray-50 p-4 rounded-lg border">
                    <div class="text-sm text-gray-500">Mulai dari:</div>
                    <div class="text-2xl font-bold text-orange-600">
                        Rp {{ number_format($item->harga_diskon ?? $item->harga, 0, ',', '.') }}
                    </div>
                    <div class="text-xs text-gray-500">/ malam</div>
                </div>
            </div>
        </div>
        <!-- === END KONTEN MODAL === -->

    </div>
</div>

    @endforeach

  @else
    <!-- TAMPILAN KETIKA TIDAK ADA KAMAR -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
      <div class="max-w-md mx-auto">
        <!-- Icon -->
        <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
          <i class="fas fa-bed text-gray-400 text-3xl"></i>
        </div>
        
        <!-- Judul -->
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Kamar Tidak Tersedia</h3>
        
        <!-- Pesan -->
        <p class="text-gray-600 mb-6">
          @if(isset($filters) && ($filters['room_tipe'] || $filters['check_in'] || $filters['dewasa'] > 1))
            Maaf, tidak ada kamar yang sesuai dengan kriteria pencarian Anda.
            @if($filters['room_tipe'])
              <br><span class="text-sm text-gray-500">Tipe: {{ $filters['room_tipe'] }}</span>
            @endif
            @if($filters['check_in'])
              <br><span class="text-sm text-gray-500">Tanggal: {{ $filters['check_in'] }} - {{ $filters['check_out'] }}</span>
            @endif
            @if($filters['dewasa'] > 1 || $filters['anak'] > 0)
              <br><span class="text-sm text-gray-500">Tamu: {{ $filters['dewasa'] }} Dewasa, {{ $filters['anak'] }} Anak</span>
            @endif
          @else
            Saat ini tidak ada kamar yang tersedia. Silakan coba lagi nanti atau hubungi customer service untuk informasi lebih lanjut.
          @endif
        </p>
        
        <!-- Tombol Action -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
          <a href="{{ route('home.index') }}" 
             class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors font-medium">
            <i class="fas fa-home mr-2"></i>Kembali ke Home
          </a>
        </div>
        
        <!-- Tips -->
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
          <p class="text-sm text-blue-700">
            <i class="fas fa-lightbulb mr-2"></i>
            <strong>Tips:</strong> Coba ubah kriteria pencarian atau tanggal untuk menemukan kamar yang tersedia.
          </p>
        </div>
      </div>
    </div>
  @endif
</div>

<!-- Tombol Keranjang - FIXED -->
@if($kamar->count() > 0)
<div class="fixed bottom-0 left-0 w-full flex justify-center pb-4 z-50">
  <button id="cartButton" 
    class="flex items-center gap-2 bg-amber-200 hover:bg-amber-300 text-black px-6 py-3 rounded-xl shadow-md transition cursor-pointer">
    <i class="fas fa-shopping-cart"></i> 
    Keranjangku (<span id="cartCount">0</span>)
  </button>
</div>
@endif

<!-- Modal Keranjang -->
<div id="cartModal" 
     class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-end sm:items-center sm:justify-center overflow-y-auto pt-12">
  <div class="bg-white rounded-t-2xl sm:rounded-xl shadow-lg w-full sm:w-[600px] max-h-[75vh] overflow-y-auto p-6 pb-[80px] sm:pb-6">
      
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
          <i class="fas fa-shopping-cart mr-3 text-blue-600"></i>Keranjangku
        </h2>
        <button onclick="toggleCart()" class="text-gray-500 hover:text-gray-800 text-2xl cursor-pointer">&times;</button>
      </div>

      <!-- Cart Items -->
      <div id="cartItems" class="space-y-4">
          <!-- Items akan di-render di sini -->
      </div>

      <!-- Total & Checkout -->
      <div class="mt-8 pt-6 border-t border-gray-200">
          <div class="flex justify-between items-center mb-6">
              <span class="text-lg font-medium text-gray-700">Total</span>
              <span id="cartTotal" class="text-xl font-bold text-blue-600">Rp0</span>
          </div>

          <form action="{{ route('reservasi.index') }}" method="get" id="checkoutForm">
            <button type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center cursor-pointer">
                <i class="fas fa-check-circle mr-2"></i>Checkout Sekarang
            </button>
          </form>
      </div>
  </div>
</div>
</div>
@include('layout.footer') 