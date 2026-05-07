@include('layout.head')
@include('layout.header')
<div class="bg-gray-50 pt-24">
<div class="container max-w-6xl mx-auto px-4 py-10">
    <!-- Booking form -->
    <form id="bookingForm" action="{{ route('kamar.search') }}" method="GET" 
      class="bg-blue-800 bg-opacity-70 rounded-xl p-6 flex flex-col md:flex-row flex-wrap gap-4 items-center justify-between mt-8">

  <!-- Date -->
  <div class="flex flex-col w-full sm:w-1/2 md:w-1/3">
    <label class="font-semibold mb-1 text-sm sm:text-base">Check-in & Check-out</label>
    <input 
      type="text" 
      name="date_range"
      id="dateRange" 
      class="w-full p-2 pl-10 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-black cursor-pointer text-sm sm:text-base" 
      readonly 
    />
    <!-- Hidden inputs untuk check-in dan check-out terpisah -->
    <input type="hidden" name="check_in" id="checkInInput">
    <input type="hidden" name="check_out" id="checkOutInput">
  </div>

  <!-- Guest Room -->
  <div class="w-full md:w-1/3 flex relative text-black text-sm">
    <div class="flex-1">
      <label class="font-semibold block mb-1">Guest Room</label>
      <input type="hidden" name="dewasa" id="dewasaInput" value="2">
      <input type="hidden" name="anak" id="anakInput" value="0">

      <button id="guestBtn" type="button" class="w-full flex justify-between items-center border p-2 rounded-l bg-white">
        <span id="guestSummary">2 Dewasa, 0 Anak</span>
        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <!-- Dropdown tamu -->
      <div id="guestDropdown" class="absolute z-10 mt-2 w-64 bg-white border rounded-lg shadow-lg p-4 hidden">
        <!-- Dewasa -->
        <div class="flex items-center justify-between mb-3">
          <div class="flex items-center space-x-2">
            <span>👤</span>
            <span class="font-medium">Dewasa</span>
          </div>
          <div class="flex items-center space-x-2">
            <button type="button" onclick="updateCount('dewasa', -1)" class="px-2 py-1 bg-gray-200 rounded">-</button>
            <span id="dewasaCount">2</span>
            <button type="button" onclick="updateCount('dewasa', 1)" class="px-2 py-1 bg-gray-200 rounded">+</button>
          </div>
        </div>
        <!-- Anak -->
        <div class="flex items-center justify-between mb-3">
          <div class="flex items-center space-x-2">
            <span>🧒</span>
            <span class="font-medium">Anak</span>
          </div>
          <div class="flex items-center space-x-2">
            <button type="button" onclick="updateCount('anak', -1)" class="px-2 py-1 bg-gray-200 rounded">-</button>
            <span id="anakCount">0</span>
            <button type="button" onclick="updateCount('anak', 1)" class="px-2 py-1 bg-gray-200 rounded">+</button>
          </div>
        </div>

        <button id="doneBtn" type="button" class="bg-blue-500 text-white w-full py-2 rounded">Selesai</button>
      </div>
    </div>

    <!-- Tombol Cari -->
    <button type="submit" class="bg-green-800 text-white p-2 rounded-r mt-4">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
    </button>
  </div>
</form>

<!-- lokasi -->
  <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
  <!-- Judul -->
  <h2 class="text-xl font-semibold text-gray-800 mb-4">
    Info Lokasi di sekitar Wyndham Surabaya
  </h2>

  <!-- Layout Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Peta -->
    <div class="space-y-3">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.7781147054175!2d113.02497617476745!3d-7.918230892105235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6496830610aa9%3A0xdd49f037c1acf215!2sArum%20Bromo%20Villas!5e0!3m2!1sid!2sid!4v1755582563865!5m2!1sid!2sid"
        class="w-full h-80 md:h-96 rounded-lg border border-gray-200"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
      <div class="flex flex-col md:flex-row gap-4">
        <a href="https://maps.app.goo.gl/duxnZzf4bCrtwSc88" target="_blank"
          class="flex items-center justify-center gap-2 w-full md:w-64 px-4 py-2 bg-gray-800 text-white text-sm rounded-md shadow hover:bg-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.894L9 1m0 0l6 3m-6-3v19m6-16l5.447 2.724A2 2 0 0121 8.618v9.764a2 2 0 01-1.553 1.894L15 23m0-19v19" />
          </svg>
          Buka Via Google Maps
        </a>
      </div>


      <p class="text-sm text-gray-600 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 00-5.657 0L2 18.172M15 10h.01M21 21l-6-6" />
        </svg>
        Jl. Raya Bromo, Dusun II Jombok rt. 08/03, Dusun 2, Sapikerep, Kec. Sukapura, Kabupaten Probolinggo, Jawa Timur 67254
      </p>

      <!-- Contact Person -->
      <div class="mt-4 space-y-2">
  <h3 class="font-semibold text-gray-800">Hubungi Kami</h3>
  <div class="flex flex-wrap items-center gap-3">
    <!-- WhatsApp -->
    <a href="https://wa.me/62811306477" target="_blank" 
      class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
      <i class="fab fa-whatsapp text-xl"></i>
      <span>WhatsApp</span>
    </a>

    <!-- Instagram -->
    <a href="https://instagram.com/arumbromovillas" target="_blank" 
      class="flex items-center gap-2 bg-pink-500 text-white px-4 py-2 rounded-lg shadow hover:bg-pink-600 transition">
      <i class="fab fa-instagram text-xl"></i>
      <span>Instagram</span>
    </a>
  </div>
</div>
</div>

      <!-- Informasi -->
      <div class="space-y-4">
        <!-- Tag lokasi -->
        <div class="flex flex-wrap gap-2">
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm rounded-md flex items-center gap-1">
            🔒 Kawasan perbelanjaan
          </span>
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm rounded-md flex items-center gap-1">
            🎡 Dekat tempat rekreasi
          </span>
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm rounded-md flex items-center gap-1">
            🏬 Dekat Tunjungan Plaza
          </span>
        </div>

        <!-- Di Sekitar Properti -->
        <div>
          <h3 class="font-semibold text-gray-800 mb-2">Di Sekitar Properti</h3>
          <ul class="space-y-2 text-sm">
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🟢 Gereja Bethany Mandarin
                <span class="text-gray-500">Tempat Suci & Religius</span>
              </span>
              <span>122 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                💼 ATM BNI
                <span class="text-gray-500">Bisnis</span>
              </span>
              <span>187 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                ➕ Gleneagles Diagnostic Center
                <span class="text-gray-500">Layanan Publik</span>
              </span>
              <span>393 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🚉 Stasiun Surabaya Gubeng
                <span class="text-gray-500">Pusat Transportasi</span>
              </span>
              <span>1.20 km</span>
            </li>
          </ul>
        </div>

        <!-- Populer -->
        <div>
          <h3 class="font-semibold text-gray-800 mb-2">Populer di Area Ini</h3>
          <ul class="space-y-2 text-sm">
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🚌 Stasiun Pasar Turi
                <span class="text-gray-500">Pusat Transportasi</span>
              </span>
              <span>2.46 km</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🛍️ Tunjungan Plaza
                <span class="text-gray-500">Pusat Hiburan</span>
              </span>
              <span>500 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🎓 Universitas Airlangga
                <span class="text-gray-500">Lainnya</span>
              </span>
              <span>1.99 km</span>
            </li>
          </ul>
        </div>

        <!-- Catatan -->
        <p class="text-xs text-gray-500">
          ⚠️ Jarak dihitung berdasarkan garis lurus. Jarak sebenarnya dapat bervariasi.
        </p>
      </div>
    </div>
    <!-- Review -->
    <div class="container max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Review Customer</h2>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Review -->
    <form action="{{ route('review.store') }}" method="POST" class="space-y-4 mb-6"> 
    @csrf

    <input type="text" name="nama" placeholder="Nama Anda" required
           class="border rounded px-3 py-2 w-full">

    <textarea name="keterangan" placeholder="Tulis review Anda..." required
              class="border rounded px-3 py-2 w-full"></textarea>

    <!-- Rating Bintang -->
    <div class="flex items-center space-x-2">
        <span class="font-medium">Rating:</span>

        <div id="starRating" class="flex space-x-1 cursor-pointer">
            @for ($i = 1; $i <= 5; $i++)
                <svg class="w-6 h-6 star text-gray-300 cursor-pointer"
                     data-value="{{ $i }}"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.172c.969 0 1.371 1.24.588 1.81l-3.37 2.447a1 1 0 00-.364 1.118l1.286 3.97c.3.921-.755 1.688-1.54 1.118l-3.37-2.447a1 1 0 00-1.175 0l-3.37 2.447c-.784.57-1.838-.197-1.539-1.118l1.286-3.97a1 1 0 00-.364-1.118L2.047 9.397c-.783-.57-.38-1.81.588-1.81h4.172a1 1 0 00.95-.69l1.286-3.97z"/>
                </svg>
            @endfor
        </div>

        <input type="hidden" name="rating" id="ratingInput" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kirim Review
    </button>
</form>
<div class="form-group row">
            <label class="col-md-3 text-right">Nama Pejabat yang ditemui</label>
            <div class="col-md-9">
                <input type="text" name="nama" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 text-right">Nomor handphone</label>
            <div class="col-md-9">
                <input type="text" name="nama" class="form-control">
            </div>
        </div>
</div>
  </div>

</div>
</div>
@include('layout.footer')
