@include('layout.head')
@include('layout.header')
<div class="bg-gray-50 text-gray-900 pt-16 ">
<div class="container max-w-6xl mx-auto px-4 py-10">
    <!-- Booking form -->
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
    <h2 class="text-2xl font-bold mb-6 mt-12">Semua Fasilitas di Arum Bromo Villas</h2>

    <!-- Grid Fasilitas -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
      <!-- Card -->
      <div class="relative rounded-lg overflow-hidden cursor-pointer group" onclick="openGallery('bar')">
        <img src="{{ asset('umum/images/exam-image1.jpeg') }}" class="w-full h-40 object-cover group-hover:scale-105 transition">
        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white px-3 py-2 text-sm">
          Bar, Kafe, dan Lounge
        </div>
      </div>

      <div class="relative rounded-lg overflow-hidden cursor-pointer group" onclick="openGallery('pool')">
        <img src="{{ asset('umum/images/exam-image2.jpeg') }}" class="w-full h-40 object-cover group-hover:scale-105 transition">
        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white px-3 py-2 text-sm">
          Kolam Renang
        </div>
      </div>

      <div class="relative rounded-lg overflow-hidden cursor-pointer group" onclick="openGallery('meeting')">
        <img src="{{ asset('umum/images/exam-image3.jpeg') }}" class="w-full h-40 object-cover group-hover:scale-105 transition">
        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white px-3 py-2 text-sm">
          Meeting Room
        </div>
      </div>

      <div class="relative rounded-lg overflow-hidden cursor-pointer group" onclick="openGallery('gym')">
        <img src="{{ asset('umum/images/exam-image4.jpeg') }}" class="w-full h-40 object-cover group-hover:scale-105 transition">
        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white px-3 py-2 text-sm">
          Pusat Kebugaran
        </div>
      </div>
       <div class="relative rounded-lg overflow-hidden cursor-pointer group " onclick="openGallery('room')">
        <img src="{{ asset('umum/images/exam-image5.jpeg') }}" class="w-full h-40 object-cover group-hover:scale-105 transition">
        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white px-3 py-2 text-sm">
          Room
        </div>
    </div>
    </div>

    <!-- List Fasilitas (biar tetap ada) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
      <div>
        <h3 class="text-lg font-bold flex items-center gap-2 mb-3">🏨 Fasilitas Kamar</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Bathtub</li><li>TV kabel</li><li>Meja</li><li>Brankas kamar</li><li>Shower</li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-bold flex items-center gap-2 mb-3">🏢 Fasilitas Publik</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Area parkir</li><li>Kafe</li><li>Restoran</li><li>WiFi</li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-bold flex items-center gap-2 mb-3">🎯 Kegiatan Lainnya</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Pusat kebugaran</li><li>Jacuzzi</li><li>Sauna</li><li>Spa</li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-bold flex items-center gap-2 mb-3"><i class="fa fa-building mr-2 text-gray-700"></i> Umum</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Aula</li><li>Area bebas asap rokok</li><li>Kolam renang</li><li>Area merokok</li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-bold flex items-center gap-2 mb-3"><i class="fa fa-utensils mr-2 text-gray-700"></i> Makanan dan Minuman</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Bar</li><li>Sarapan</li><li>Makan malam bermenu</li><li>Menu makan siang</li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-bold flex items-center gap-2 mb-3"><i class="fa fa-bell-concierge mr-2 text-gray-700"></i> Servis Hotel</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Bellboy</li><li>Concierge/layanan tamu</li><li>Resepsionis 24 jam</li><li>Penitipan bagasi</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Modal Gallery -->
  <div id="galleryModal" class="fixed inset-0 bg-black/80 hidden flex-col items-center justify-center z-50">
    <!-- Close -->
    <button onclick="closeGallery()" class="absolute top-4 right-6 text-white text-3xl">✖</button>

    <!-- Image -->
    <div class="flex items-center justify-center relative">
      <button onclick="prevImage()" class="absolute left-0 text-white text-4xl px-4">❮</button>
      <img id="galleryImage" src="" class="max-h-[80vh] max-w-[90vw] rounded-lg shadow-lg">
      <button onclick="nextImage()" class="absolute right-0 text-white text-4xl px-4">❯</button>
    </div>

    <!-- Caption -->
    <p id="galleryCaption" class="text-white mt-4"></p>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mt-6">
      <button onclick="openGallery('allpicture')" class="px-4 py-2 bg-gray-700 text-white rounded">Semua Foto</button>
      <button onclick="openGallery('bar')" class="px-4 py-2 bg-gray-700 text-white rounded">Bar</button>
      <button onclick="openGallery('pool')" class="px-4 py-2 bg-gray-700 text-white rounded">Kolam Renang</button>
      <button onclick="openGallery('meeting')" class="px-4 py-2 bg-gray-700 text-white rounded">Meeting Room</button>
      <button onclick="openGallery('gym')" class="px-4 py-2 bg-gray-700 text-white rounded">Gym</button>
      <button onclick="openGallery('room')" class="px-4 py-2 bg-gray-700 text-white rounded">Room</button>
      
    </div>
  </div>
</div>
@include('layout.footer')