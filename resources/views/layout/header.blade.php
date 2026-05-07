<header class="fixed top-0 left-0 w-full bg-dark bg-opacity-80 text-white text-sm md:text-base z-50 shadow">
  <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center py-3 gap-5 text-base">

    <!-- Logo -->
    <!-- Logo -->
<div class="flex items-center gap-2">
    <a href="{{ route('home.index') }}" class="flex items-center gap-1 underline hover:text-gray-300">
        <!-- Optional SVG icon -->
        <svg role="img" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 50 50" width="30" height="30">
            <path d="..." />
        </svg>
        
        <!-- Logo responsive -->
        <img 
            src="{{ asset('umum/images/logo-arumbromo.png') }}" 
            alt="Arum Bromo Logo" 
            class="h-8 md:h-12 lg:h-16 w-auto object-contain"
        >
    </a>
</div>


    <!-- Menu Desktop -->
    <div class="hidden md:flex items-center gap-6">

      <a href="{{ route('home.index') }}" class="hover:underline">Fasilitas</a>
      <a href="{{ route('home.index') }}" class="hover:underline">Lokasi & Kontak</a>


      @auth
      <!-- DROPDOWN USER -->
      <!-- Desktop User -->
@auth
<div class="relative">
    <button onclick="toggleUserMenu()" class="flex items-center gap-2 hover:text-gray-300">
        <i class="fas fa-user"></i>
        <span>{{ Auth::user()->name ?: Auth::user()->email }}</span>
        <i class="fas fa-chevron-down text-xs"></i>
    </button>

    <div id="userDropdown" class="hidden absolute right-0 mt-3 w-56 bg-white text-gray-800 rounded-lg shadow-lg overflow-hidden z-50">
        <div class="px-4 py-2 bg-gray-100 font-semibold text-sm">
            Menu User
        </div>

        <a href="{{ route('home.index') }}" class="block px-4 py-2 hover:bg-gray-100">
            <i class="fas fa-book mr-2"></i> Riwayat Pesanan
        </a>

        <div class="border-t"></div>

        <a href="{{ route('home.index') }}" class="block px-4 py-2 hover:bg-gray-100">
            <i class="fas fa-key mr-2"></i> Ganti Password
        </a>

        <div class="border-t"></div>

        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-red-50 text-red-600 font-semibold">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</div>
@endauth
      @else
        <a href="{{ route('login') }}"
          class="bg-white text-black rounded px-4 py-1 hover:bg-gray-200 transition font-semibold inline-block">
          Login
        </a>
      @endauth
    </div>

    <!-- Hamburger Menu -->
    <button id="menu-toggle" class="md:hidden flex flex-col gap-1">
      <span class="w-6 h-0.5 bg-white"></span>
      <span class="w-6 h-0.5 bg-white"></span>
      <span class="w-6 h-0.5 bg-white"></span>
    </button>

  </nav>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden flex flex-col items-center gap-3 py-4 border-t border-gray-500 md:hidden bg-dark bg-opacity-90 relative">
    <a href="{{ route('home.index') }}" class="hover:underline">Fasilitas</a>
    <a href="{{ route('home.index') }}" class="hover:underline">Lokasi & Kontak</a>
    

   @auth
<button onclick="toggleUserMenuMobile()" class="flex items-center gap-2 hover:text-gray-300">
    <i class="fas fa-user"></i>
    <span>{{ Auth::user()->name ?: Auth::user()->email }}</span>
    <i class="fas fa-chevron-down text-xs"></i>
</button>

<div id="userDropdownMobile" class="hidden mt-3 w-56 bg-white text-gray-800 rounded-lg shadow-lg overflow-hidden z-50">
    <div class="px-4 py-2 bg-gray-100 font-semibold text-sm">
        Menu User
    </div>

    <a href="{{ route('home.index') }}" class="block px-4 py-2 hover:bg-gray-100">
            <i class="fas fa-book mr-2"></i> Riwayat Pesanan
        </a>

    <div class="border-t"></div>

    <a href="{{ route('userpublic.ganti_password') }}" class="block px-4 py-2 hover:bg-gray-100">
        <i class="fas fa-key mr-2"></i> Ganti Password
    </a>

    <div class="border-t"></div>

    <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-red-50 text-red-600 font-semibold">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </a>
</div>
@endauth

<!-- Guest -->
@guest
<a href="{{ route('login') }}" class="bg-white text-black rounded px-4 py-1 hover:bg-gray-200 transition font-semibold inline-block">
    Login
</a>
@endguest
  </div>
</header>

<script>
function toggleUserMenu() {
  document.getElementById('userDropdown').classList.toggle('hidden');
}

// Klik di luar → tutup dropdown
window.addEventListener('click', function(e) {
  const dropdown = document.getElementById('userDropdown');
  const button = e.target.closest("button[onclick='toggleUserMenu()']");
  if (!button && !dropdown.contains(e.target)) {
    dropdown.classList.add('hidden');
  }
});
</script>
<script>
function toggleUserMenu() {
    document.getElementById('userDropdown').classList.toggle('hidden');
}

function toggleUserMenuMobile() {
    document.getElementById('userDropdownMobile').classList.toggle('hidden');
}

// Klik di luar → tutup desktop dropdown
window.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    const button = e.target.closest("button[onclick='toggleUserMenu()']");
    if (!button && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});

// Klik di luar → tutup mobile dropdown
window.addEventListener('click', function(e) {
    const dropdownMobile = document.getElementById('userDropdownMobile');
    const buttonMobile = e.target.closest("button[onclick='toggleUserMenuMobile()']");
    if (!buttonMobile && !dropdownMobile.contains(e.target)) {
        dropdownMobile.classList.add('hidden');
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== LANGUAGE SYSTEM DEBUG ===');
    
    // Debug info
    console.log('Current App Locale:', '{{ app()->getLocale() }}');
    console.log('Session Locale:', '{{ session("locale") }}');
    console.log('App Fallback Locale:', '{{ config("app.fallback_locale") }}');
    
    // Function untuk handle language change dengan debug
    function setupLanguageSelect(selectElement, selectName) {
        if (!selectElement) {
            console.error(`${selectName} select element not found!`);
            return;
        }
        
        console.log(`Setting up ${selectName} select:`, selectElement);
        
        selectElement.addEventListener('change', function() {
            const selectedValue = this.value;
            const selectedText = this.options[this.selectedIndex].text;
            
            console.log(`${selectName} changed:`, {
                text: selectedText,
                value: selectedValue,
                currentUrl: window.location.href
            });
            
            // Validasi URL
            if (!selectedValue || selectedValue === '#' || selectedValue === '') {
                console.error('Invalid URL in select value:', selectedValue);
                alert('Error: Invalid language URL');
                return;
            }
            
            // Test URL sebelum redirect
            console.log('Testing URL before redirect...');
            fetch(selectedValue, { method: 'HEAD' })
                .then(response => {
                    console.log('URL test response:', {
                        status: response.status,
                        statusText: response.statusText,
                        url: response.url
                    });
                    
                    if (response.ok) {
                        console.log('Redirecting to:', selectedValue);
                        window.location.href = selectedValue;
                    } else {
                        console.error('URL returned error status:', response.status);
                        alert('Error: Language change failed. Server returned ' + response.status);
                    }
                })
                .catch(error => {
                    console.error('URL test failed:', error);
                    alert('Error: Cannot connect to server. Please check your connection.');
                });
        });
    }
    
    // Setup both selects
    setupLanguageSelect(document.getElementById('languageSelect'), 'Desktop');
    setupLanguageSelect(document.getElementById('mobileLanguageSelect'), 'Mobile');
    
    // Manual test functions
    window.testLanguage = function(locale) {
        const url = `http://127.0.0.1:8000/lang/${locale}`;
        console.log('Manual test redirect to:', url);
        window.location.href = url;
    };
});

// Quick test commands untuk console
console.log('Quick test commands:');
console.log('- testLanguage("id") - Change to Indonesian');
console.log('- testLanguage("en") - Change to English');
</script>