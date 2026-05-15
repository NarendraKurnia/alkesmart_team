@include('layout.head') 
@include('layout.header')

<main class="relative min-h-screen overflow-hidden pt-20">

  <!-- Background -->
  <div class="absolute inset-0 ">
    <img 
      src="{{ asset('umum/images/bg-depan.png') }}" 
      class="w-full h-full object-cover pt-16"
      alt="Background"
    >
    
  </div>

  <!-- Content -->
  <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center text-white">

    <!-- LEFT TEXT -->
    <div>
      <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-6">
        Sistem Absensi Marketing <br>
        <span class="text-black">Alkesmart</span>
      </h1>

      <p class="text-sm md:text-base text-black mb-8 leading-relaxed">
        Sistem ini membantu pencatatan absensi, monitoring aktivitas lapangan, serta integrasi laporan secara real-time. 
      </p>

      <!-- Button -->
      <div class="flex flex-wrap gap-4">
        <a href="{{ route('login') }}" class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
          Mulai Sekarang
        </a>
      </div>
    </div>

    </div>

  </div>

  <!-- Wave bawah -->
  <div class="absolute bottom-0 left-0 w-full">
    <svg viewBox="0 0 1440 150" class="w-full">
      <path fill="#ffffff" fill-opacity="1" 
        d="M0,96L80,106.7C160,117,320,139,480,133.3C640,128,800,96,960,85.3C1120,75,1280,85,1360,90.7L1440,96L1440,160L1360,160C1280,160,1120,160,960,160C800,160,640,160,480,160C320,160,160,160,80,160L0,160Z">
      </path>
    </svg>
  </div>

</main>

<!-- SECTION FITUR -->
<section class="bg-white py-16 px-6">
  <div class="max-w-6xl mx-auto text-center">
    
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-10">
      Fitur Utama Sistem
    </h2>

    <div class="grid md:grid-cols-3 gap-8">

      <div class="p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-blue-600 text-3xl mb-3">📍</div>
        <h3 class="font-semibold text-lg mb-2">Absensi GPS</h3>
        <p class="text-gray-600 text-sm">
          Pantau kehadiran marketing berbasis lokasi secara real-time.
        </p>
      </div>

      <div class="p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-blue-600 text-3xl mb-3">📊</div>
        <h3 class="font-semibold text-lg mb-2">Laporan Otomatis</h3>
        <p class="text-gray-600 text-sm">
          Rekap absensi dan aktivitas langsung tersimpan dan siap digunakan.
        </p>
      </div>

      <div class="p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-blue-600 text-3xl mb-3">📱</div>
        <h3 class="font-semibold text-lg mb-2">Mobile Friendly</h3>
        <p class="text-gray-600 text-sm">
          Bisa diakses kapan saja melalui smartphone masing-masing.
        </p>
      </div>

    </div>
  </div>
</section>

@include('layout.footer')