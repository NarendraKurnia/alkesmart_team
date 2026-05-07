<!-- Footer -->
<footer class="bg-green-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        <!-- Logo -->
        <div class="text-left md:text-left">
            <h1 class="text-3xl font-serif tracking-wide">Alkesmart</h1>
        </div>

        <hr class="border-t border-yellow-500">

        <!-- Contact + Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Social Media -->
            <div class="flex justify-center md:justify-start space-x-4 text-xl">
                <a href="https://facebook.com" target="_blank" class="hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank" class="hover:text-sky-500"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank" class="hover:text-pink-500"><i class="fab fa-instagram"></i></a>
                <a href="https://pinterest.com" target="_blank" class="hover:text-red-500"><i class="fab fa-pinterest-p"></i></a>
                <a href="https://youtube.com" target="_blank" class="hover:text-red-600"><i class="fab fa-youtube"></i></a>
            </div>

            <!-- Get in Touch -->
            <div class="text-left md:text-left">
                <h3 class="text-lg font-bold mb-4">Alkesmart</h3>
                <p class="mb-2">alkesmart@gmail.com</p>
                <p class="mb-2">031 - 111 111 11</p>
                <p>Ruko Taman Jenggala Mas, Jl. Sunandar Priyo Sudarmo RTB-9, Kuthuk, Sidokare, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61214</p>
            </div>

            <!-- Navigation -->
            <div class="grid grid-cols-2 gap-4 text-left md:text-left">
                <div>
                    <h3 class="text-lg font-bold mb-4">Navigate</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Home</a></li>
                        <li><a href="#" class="hover:underline">Property</a></li>
                        <li><a href="#" class="hover:underline">News</a></li>
                        <li><a href="#" class="hover:underline">Project</a></li>
                    </ul>
                </div>
                <div class="mt-[2.3rem] md:mt-16">
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">About us</a></li>
                        <li><a href="#" class="hover:underline">Careers</a></li>
                        <li><a href="#" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-12">
            <p>Copyright © 2025 ARUM BROMO VILLAS All Rights Reserved</p>
        </div>
</footer>


<!-- Instalasi Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://unpkg.com/lenis@1.1.5/dist/lenis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script>
  const toggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');
  toggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>
<!-- Input Pencarian Kamar -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();

  // Daftar tanggal merah
  const holidayList = [
    '2025-08-17', // Hari Kemerdekaan RI
    '2025-12-25', // Natal
    '2025-12-31', // Tahun Baru
  ];

  // Cek ukuran layar untuk menentukan jumlah bulan
  const isSmallScreen = window.innerWidth < 640;

  const picker = new Litepicker({
    element: document.getElementById('dateRange'),
    singleMode: false,
    numberOfMonths: isSmallScreen ? 1 : 2,
    numberOfColumns: isSmallScreen ? 1 : 2,
    format: 'DD MMM YYYY',
    lang: 'id',
    minDate: today,
    tooltipText: { one: 'hari', other: 'hari' },
    tooltipNumber: (totalDays) => totalDays,
    setup: (picker) => {
      picker.on('render', (ui) => {
        ui.querySelectorAll('.day-item').forEach(dayEl => {
          const date = dayEl.getAttribute('data-time');
          if (date) {
            const dayDate = new Date(parseInt(date));
            const dateStr = dayDate.toISOString().split('T')[0];
            if (dayDate.getDay() === 0 || holidayList.includes(dateStr)) {
              dayEl.classList.add('red-day');
            }
          }
        });
      });

      picker.on('selected', (date1, date2) => {
        const dateRange = date1.format('DD MMM YYYY') + ' - ' + date2.format('DD MMM YYYY');
        document.getElementById('dateRange').value = dateRange;
        
        // Simpan ke hidden inputs
        document.getElementById('checkInInput').value = date1.format('YYYY-MM-DD');
        document.getElementById('checkOutInput').value = date2.format('YYYY-MM-DD');
        
        // Simpan ke localStorage untuk digunakan di halaman lain
        const bookingDates = {
          check_in: date1.format('DD MMM YYYY'),
          check_out: date2.format('DD MMM YYYY'),
          check_in_raw: date1.format('YYYY-MM-DD'),
          check_out_raw: date2.format('YYYY-MM-DD')
        };
        localStorage.setItem('bookingDates', JSON.stringify(bookingDates));
      });
    }
  });

  // Set default range: hari ini & besok
  let start = new Date();
  let end = new Date();
  end.setDate(end.getDate() + 1);
  picker.setDateRange(start, end);

  // Set default values untuk hidden inputs
  document.getElementById('checkInInput').value = start.toISOString().split('T')[0];
  document.getElementById('checkOutInput').value = end.toISOString().split('T')[0];

  // Event listener untuk dropdown tamu
  document.getElementById('guestBtn').addEventListener('click', function() {
    document.getElementById('guestDropdown').classList.toggle('hidden');
  });

  document.getElementById('doneBtn').addEventListener('click', function() {
    document.getElementById('guestDropdown').classList.add('hidden');
  });
});

// Fungsi untuk memperbarui jumlah tamu
function updateCount(type, change) {
  const countElement = document.getElementById(`${type}Count`);
  const inputElement = document.getElementById(`${type}Input`);
  let count = parseInt(countElement.textContent);
  
  count += change;
  
  // Batasan minimal dan maksimal
  if (count < 0) count = 0;
  if (type === 'dewasa' && count < 1) count = 1; // Minimal 1 dewasa
  
  countElement.textContent = count;
  inputElement.value = count;
  
  // Update summary
  document.getElementById('guestSummary').textContent = 
    `${document.getElementById('dewasaInput').value} Dewasa, ${document.getElementById('anakInput').value} Anak`;
}
</script>
<!-- Fasilitas -->
<script>
const galleries = {
  allpicture: [
    {src: "{{ asset('umum/images/exam-image1.jpeg') }}", caption: "Bar"},
    {src: "{{ asset('umum/images/exam-image2.jpeg') }}", caption: "Kolam Renang"},
    {src: "{{ asset('umum/images/exam-image3.jpeg') }}", caption: "Meeting Room"},
    {src: "{{ asset('umum/images/exam-image4.jpeg') }}", caption: "GYM Area"},
    {src: "{{ asset('umum/images/exam-image5.jpeg') }}", caption: "Superior Room"}
  ],
  bar: [
    {src: "{{ asset('umum/images/exam-image1.jpeg') }}", caption: "Bar - Foto 1"},
    {src: "https://via.placeholder.com/800x500?text=Bar+2", caption: "Bar - Foto 2"},
    {src: "https://via.placeholder.com/800x500?text=Gym+1", caption: "Gym - Foto 1"}
  ],
  pool: [
    {src: "{{ asset('umum/images/exam-image2.jpeg') }}", caption: "Kolam Renang - Foto 1"},
    {src: "https://via.placeholder.com/800x500?text=Pool+2", caption: "Kolam Renang - Foto 2"}
  ],
  meeting: [
    {src: "{{ asset('umum/images/exam-image3.jpeg') }}", caption: "Meeting Room - Foto 1"}
  ],
  gym: [
    {src: "{{ asset('umum/images/exam-image4.jpeg') }}", caption: "Gym - Foto 1"}
  ],
  room: [
    {src: "{{ asset('umum/images/exam-image5.jpeg') }}", caption: "Superior Room - Foto 1"}
  ]
};

let currentCategory = null;
let currentIndex = 0;

function openGallery(category) {
  currentCategory = category;
  currentIndex = 0;
  showImage();
  document.getElementById("galleryModal").classList.remove("hidden");
  document.getElementById("galleryModal").classList.add("flex");
}

function closeGallery() {
  document.getElementById("galleryModal").classList.add("hidden");
}

function showImage() {
  const data = galleries[currentCategory][currentIndex];
  document.getElementById("galleryImage").src = data.src;
  document.getElementById("galleryCaption").innerText = data.caption + ` (${currentIndex+1}/${galleries[currentCategory].length})`;
}

function nextImage() {
  currentIndex = (currentIndex + 1) % galleries[currentCategory].length;
  showImage();
}

function prevImage() {
  currentIndex = (currentIndex - 1 + galleries[currentCategory].length) % galleries[currentCategory].length;
  showImage();
}
</script>
<script>
function updateCount(type, delta) {
  let countEl = document.getElementById(type + 'Count');
  let inputEl = document.getElementById(type + 'Input');
  let count = parseInt(countEl.textContent) + delta;
  if (count < 0) count = 0;
  countEl.textContent = count;
  inputEl.value = count;

  let dewasa = document.getElementById('dewasaCount').textContent;
  let anak = document.getElementById('anakCount').textContent;
  document.getElementById('guestSummary').textContent = `${dewasa} Dewasa, ${anak} Anak`;
}
</script>

<!-- <script>
document.addEventListener('DOMContentLoaded', () => {
  // Global modal open/close (works with data-modal-open / data-modal-close)
  document.addEventListener('click', (e) => {
    const openBtn = e.target.closest('[data-modal-open]');
    if (openBtn) {
      const id = openBtn.getAttribute('data-modal-open');
      const modal = document.getElementById(id);
      if (modal) modal.classList.remove('hidden');
      return;
    }
    
    const closeBtn = e.target.closest('[data-modal-close]');
    if (closeBtn) {
      const id = closeBtn.getAttribute('data-modal-close');
      const modal = document.getElementById(id);
      if (modal) modal.classList.add('hidden');
      return;
    }
    // optional: click backdrop to close (if you add class "modal-backdrop" to modal container)
    const backdrop = e.target.closest('.modal-backdrop');
    if (backdrop) backdrop.classList.add('hidden');
  });

  // Initialize gallery/carousel in each modal found on the page
  const modals = Array.from(document.querySelectorAll('[id^="modal-"]'));
  modals.forEach(modal => {
    // scope queries to this modal only
    const images = Array.from(modal.querySelectorAll('.modal-main-image'));
    if (!images.length) return; // nothing to do

    const titles = Array.from(modal.querySelectorAll('.modal-title'));
    const thumbnails = Array.from(modal.querySelectorAll('.thumbnail-btn'));
    const prevBtn = modal.querySelector('[id^="prevBtn-"]') || modal.querySelector('.prev-btn');
    const nextBtn = modal.querySelector('[id^="nextBtn-"]') || modal.querySelector('.next-btn');
    const counter = modal.querySelector('[id^="counter-"]') || modal.querySelector('.gallery-counter');

    let currentIndex = 0;
    const total = images.length;

    function showImage(index) {
      // clamp index
      if (index < 0) index = (index % total + total) % total;
      if (index >= total) index = index % total;

      images.forEach((img, i) => {
        if (i === index) {
          img.classList.remove('opacity-0', 'pointer-events-none');
          img.classList.add('opacity-100');
        } else {
          img.classList.remove('opacity-100');
          img.classList.add('opacity-0', 'pointer-events-none');
        }
      });

      titles.forEach((t, i) => {
        if (i === index) {
          t.classList.remove('opacity-0', 'pointer-events-none');
          t.classList.add('opacity-100');
        } else {
          t.classList.remove('opacity-100');
          t.classList.add('opacity-0', 'pointer-events-none');
        }
      });

      thumbnails.forEach((thumb, i) => {
        thumb.classList.toggle('ring-white', i === index);
        thumb.classList.toggle('ring-transparent', i !== index);
      });

      if (counter) counter.textContent = `${index + 1}/${total}`;
      currentIndex = index;
    }

    // bind buttons (safe checks)
    prevBtn && prevBtn.addEventListener('click', () => showImage((currentIndex - 1 + total) % total));
    nextBtn && nextBtn.addEventListener('click', () => showImage((currentIndex + 1) % total));

    // thumbnails clickable
    thumbnails.forEach(btn => {
      btn.addEventListener('click', () => {
        const idx = parseInt(btn.dataset.thumbIndex);
        if (!isNaN(idx)) showImage(idx);
      });
    });

    // init first slide
    showImage(0);
  });
});
</script> -->
<script>
// ==================== MODAL FUNCTIONS ====================
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

function changeMainImage(uniq, src) {
    document.getElementById("mainImage-" + uniq).src = src;
}

// Close modal when clicking backdrop
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-backdrop')) {
        e.target.classList.add('hidden');
    }
});

// ==================== DATE CALCULATION FUNCTIONS ====================
function calculateNights(checkIn, checkOut) {
    if (!checkIn || !checkOut) return 1; // Default 1 malam jika tidak ada tanggal
    
    try {
        const start = new Date(checkIn);
        const end = new Date(checkOut);
        
        // Validasi tanggal
        if (start >= end) return 1;
        
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        return diffDays > 0 ? diffDays : 1;
    } catch (error) {
        console.error('Error calculating nights:', error);
        return 1;
    }
}

function formatDate(dateString) {
    if (!dateString) return 'Tanggal tidak ditentukan';
    
    try {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    } catch (error) {
        return dateString;
    }
}

// ==================== ROOM AVAILABILITY CHECK ====================
async function checkRoomAvailability(nomorKamar, checkIn, checkOut) { // GANTI: idKamar → nomorKamar
    console.log('Memeriksa ketersediaan kamar:', { nomorKamar, checkIn, checkOut });
    
    try {
        // ============ CARI CSRF TOKEN DARI BERBAGAI SUMBER ============
        let csrfToken = '';
        
        // 1. Cari dari meta tag (cara standar)
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        if (metaToken) {
            csrfToken = metaToken.content;
            console.log('CSRF token ditemukan di meta tag');
        }
        
        // 2. Jika tidak ada di meta, cari dari form input
        if (!csrfToken) {
            const inputToken = document.querySelector('input[name="_token"]');
            if (inputToken) {
                csrfToken = inputToken.value;
                console.log('CSRF token ditemukan di form input');
            }
        }
        
        // 3. Jika masih tidak ada, cari dari semua elemen dengan data attribute
        if (!csrfToken) {
            const tokenElement = document.querySelector('[data-csrf-token]');
            if (tokenElement) {
                csrfToken = tokenElement.dataset.csrfToken;
                console.log('CSRF token ditemukan di data attribute');
            }
        }
        
        // 4. Cari dari global Laravel JS object (jika ada)
        if (!csrfToken && window.Laravel && window.Laravel.csrfToken) {
            csrfToken = window.Laravel.csrfToken;
            console.log('CSRF token ditemukan di Laravel object');
        }
        
        // ============ VALIDASI TOKEN ============
        if (!csrfToken) {
            console.error('CSRF token TIDAK ditemukan di halaman!');
            
            // Coba buat token baru secara manual
            try {
                // Ambil token dari cookies (fallback)
                const cookies = document.cookie.split(';');
                const xsrfCookie = cookies.find(c => c.trim().startsWith('XSRF-TOKEN='));
                if (xsrfCookie) {
                    csrfToken = decodeURIComponent(xsrfCookie.split('=')[1]);
                    console.log('CSRF token ditemukan di cookies');
                }
            } catch (e) {
                console.error('Tidak bisa ambil token dari cookies:', e);
            }
            
            // Jika tetap tidak ada, tampilkan error
            if (!csrfToken) {
                return { 
                    available: false, 
                    message: 'Token keamanan tidak ditemukan. Silakan refresh halaman dan coba lagi.' 
                };
            }
        }
        
        console.log('CSRF Token yang akan digunakan:', csrfToken.substring(0, 20) + '...');
        
        // ============ VALIDASI INPUT ============
        if (!nomorKamar || !checkIn || !checkOut) { // GANTI: idKamar → nomorKamar
            return { 
                available: false, 
                message: 'Data tanggal tidak lengkap. Silakan pilih tanggal check-in dan check-out.' 
            };
        }

        // ============ KIRIM REQUEST ============
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 10000);

        const response = await fetch('/check-availability', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                nomor_kamar: nomorKamar, // GANTI: id_kamar → nomor_kamar
                check_in: checkIn,
                check_out: checkOut
            }),
            signal: controller.signal,
            credentials: 'same-origin' // Penting untuk cookies
        });

        clearTimeout(timeoutId);

        console.log('Response status:', response.status);
        console.log('Response headers:', [...response.headers.entries()]);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Error response:', errorText);
            
            let errorMessage = 'Terjadi kesalahan jaringan';
            try {
                const errorData = JSON.parse(errorText);
                errorMessage = errorData.message || errorMessage;
            } catch (e) {
                // Tetap gunakan errorText jika bukan JSON
            }
            
            return { 
                available: false, 
                message: errorMessage 
            };
        }

        const data = await response.json();
        console.log('API Response:', data);
        
        return {
            available: data.available || false,
            message: data.message || 'Kamar tersedia'
        };
        
    } catch (error) {
        console.error('Error checking availability:', error);
        
        let errorMessage = 'Terjadi kesalahan saat mengecek ketersediaan kamar';
        
        if (error.name === 'AbortError') {
            errorMessage = 'Waktu pengecekan habis. Silakan coba lagi.';
        } else if (error.message.includes('Failed to fetch')) {
            errorMessage = 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
        }
        
        return { 
            available: false, 
            message: errorMessage 
        };
    }
}

// ==================== MAIN SCRIPT ====================
document.addEventListener("DOMContentLoaded", () => {
    console.log('=== SCRIPT KERANJANG DIMUAT ===');
    
    // Elements
    const cartModal = document.getElementById("cartModal");
    const cartItemsContainer = document.getElementById("cartItems");
    const cartCount = document.getElementById("cartCount");
    const cartTotal = document.getElementById("cartTotal");
    const checkoutForm = document.getElementById("checkoutForm");
    const cartButton = document.getElementById("cartButton");

    // ==================== AUTH FUNCTIONS ====================
    function checkLogin() {
        try {
            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
            console.log('Status login dari Laravel:', isLoggedIn);
            return isLoggedIn;
        } catch (error) {
            console.error('Error checking login:', error);
            return false;
        }
    }

    function showLoginRequiredModal(action = 'mengakses fitur ini') {
        console.log('Menampilkan modal login required untuk:', action);
        
        const modal = document.getElementById('loginRequiredModal');
        const messageEl = document.getElementById('loginRequiredMessage');
        
        if (modal && messageEl) {
            messageEl.textContent = `Anda harus login untuk ${action}`;
            modal.classList.remove('hidden');
        }
    }

    // ==================== NOTIFICATION FUNCTIONS ====================
    function showSuccessAlert(message) {
        const alert = document.getElementById('customAlert');
        const messageEl = document.getElementById('alertMessage');
        
        if (alert && messageEl) {
            messageEl.textContent = message;
            alert.classList.remove('hidden');
            
            setTimeout(() => {
                hideCustomAlert();
            }, 3000);
        }
    }

    function showErrorAlert(message) {
        const alert = document.getElementById('errorAlert');
        const messageEl = document.getElementById('errorMessage');
        
        if (alert && messageEl) {
            messageEl.textContent = message;
            alert.classList.remove('hidden');
            
            setTimeout(() => {
                hideErrorAlert();
            }, 5000);
        }
    }

    // ==================== PRICE CALCULATION FUNCTIONS ====================
    function calculateItemTotal(item) {
        // Pastikan kita menggunakan harga per malam yang benar
        const hargaPermalam = parseInt(item.harga_permalam) || parseInt(item.harga) || 0;
        
        // Hitung jumlah malam
        let nights = parseInt(item.malam);
        if (!nights || nights < 1) {
            nights = calculateNights(item.check_in_raw, item.check_out_raw);
        }
        
        console.log('Perhitungan item:', {
            hargaPermalam: hargaPermalam,
            nights: nights,
            check_in: item.check_in_raw,
            check_out: item.check_out_raw,
            total: hargaPermalam * nights
        });
        
        return hargaPermalam * nights;
    }

    function updatePriceDisplay() {
        const savedDates = localStorage.getItem('bookingDates');
        let nights = 1;
        
        if (savedDates) {
            try {
                const dates = JSON.parse(savedDates);
                nights = calculateNights(dates.check_in_raw, dates.check_out_raw);
                console.log('Jumlah malam untuk display:', nights);
            } catch (e) {
                console.error('Error calculating nights:', e);
            }
        }

        // Update semua card harga dan info malam
        document.querySelectorAll('.harga-wrapper').forEach(wrapper => {
            const basePrice = parseInt(wrapper.dataset.harga) || 0;
            const hargaDiskonPermalam = Math.floor(basePrice * 0.5);
            const totalHarga = hargaDiskonPermalam * nights;
            
            // Update harga per malam
            const hargaElement = wrapper.querySelector('.harga-diskon');
            if (hargaElement) {
                hargaElement.textContent = `Rp${hargaDiskonPermalam.toLocaleString('id-ID')}/malam`;
            }
            
            // Update total harga
            const totalElement = wrapper.querySelector('.total-harga');
            if (totalElement) {
                totalElement.textContent = `Rp${totalHarga.toLocaleString('id-ID')}`;
            }
            
            // Update info jumlah malam
            const card = wrapper.closest('.p-4');
            if (card) {
                const nightsInfo = card.querySelector('.nights-info');
                if (nightsInfo) {
                    nightsInfo.textContent = `${nights} Malam`;
                }
            }
        });
    }

    // ==================== CART FUNCTIONS ====================
    window.toggleCart = function() {
        console.log('=== TOGGLE CART DIPANGGIL ===');
        
        if (!checkLogin()) {
            console.log('User belum login, tampilkan modal login required');
            showLoginRequiredModal('mengakses keranjang belanja');
            return;
        }
        
        console.log('User sudah login, toggle modal keranjang');
        if (cartModal) {
            cartModal.classList.toggle("hidden");
            console.log('Modal keranjang status:', cartModal.classList.contains('hidden') ? 'tersembunyi' : 'terbuka');
            
            if (!cartModal.classList.contains('hidden')) {
                loadCart();
                // Scroll ke atas modal saat dibuka
                const modalContent = cartModal.querySelector('.max-h-[90vh]');
                if (modalContent) {
                    modalContent.scrollTop = 0;
                }
            }
        } else {
            console.error('Modal keranjang tidak ditemukan!');
        }
    }

    function updateCartCount(count) {
        if (cartCount) {
            cartCount.textContent = count;
            console.log('Cart count diperbarui:', count);
        }
    }

    function renderCart(cart) {
        console.log('Render cart dipanggil dengan data:', cart);
        
        if (!cartItemsContainer) {
            console.error('Cart items container tidak ditemukan!');
            return;
        }

        cartItemsContainer.innerHTML = '';
        let total = 0;
        let count = 0;

        // Check if cart is object (keyed by ID) or array
        const cartItems = Array.isArray(cart) ? cart : Object.values(cart || {});
        
        if (cartItems.length > 0) {
            cartItems.forEach(item => {
                // Hitung total untuk item ini
                const itemTotal = item.harga || (item.harga_permalam * item.malam) || 0;
                total += itemTotal;
                count += (item.quantity || 1);

                const div = document.createElement("div");
                div.classList.add("flex", "flex-col", "border-b", "pb-4", "mb-4");
                div.innerHTML = `
                    <div class="flex justify-between items-start gap-3">
                        <img src="${item.gambar || 'https://via.placeholder.com/100?text=No+Image'}" 
                             class="w-16 h-16 object-cover rounded" 
                             alt="${item.tipe || 'Kamar'}">
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-800">${item.tipe || 'Kamar Deluxe'}</h4>
                            <div class="text-xs text-gray-600 mt-1">
                                <div>Nomor: ${item.nomor || '-'}</div>
                                <div>Dewasa: ${item.dewasa || 2}, Anak: ${item.anak || 0}</div>
                                <div class="font-semibold mt-1">Check-in: ${item.check_in || 'Tidak ditentukan'}</div>
                                <div class="font-semibold">Check-out: ${item.check_out || 'Tidak ditentukan'}</div>
                                <div class="text-green-600 font-semibold mt-2">
                                    ${item.malam || 1} Malam × Rp${(item.harga_permalam || 0).toLocaleString('id-ID')}/malam
                                </div>
                            </div>
                            <div class="text-sm font-semibold text-blue-600 mt-2">
                                Total: Rp${itemTotal.toLocaleString('id-ID')}
                            </div>
                        </div>
                        <button class="text-red-500 hover:text-red-700 text-lg font-bold transition-colors cursor-pointer remove-cart-item" 
                                data-id="${item.id}"
                                title="Hapus dari keranjang">
                            &times;
                        </button>
                    </div>
                `;
                cartItemsContainer.appendChild(div);
            });
            
            // Tambahkan event listener untuk tombol hapus
            document.querySelectorAll('.remove-cart-item').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    removeFromCart(itemId);
                });
            });
            
        } else {
            cartItemsContainer.innerHTML = `
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-shopping-cart text-4xl mb-4 opacity-50"></i>
                    <p class="text-lg">Keranjang Anda kosong</p>
                    <p class="text-sm mt-2">Silakan pilih kamar untuk ditambahkan ke keranjang</p>
                </div>
            `;
        }

        updateCartCount(count);
        
        if (cartTotal) {
            cartTotal.textContent = `Rp${total.toLocaleString('id-ID')}`;
            console.log('Total keranjang:', total);
        }

        console.log('Render cart selesai. Total items:', count, 'Total harga:', total);
    }

    // FUNGSI REMOVE FROM CART YANG BENAR
    function removeFromCart(id) {
        console.log('Menghapus item dari keranjang:', id);
        
        if (!checkLogin()) {
            showLoginRequiredModal('mengelola keranjang');
            return;
        }

        const token = document.querySelector('input[name="_token"]')?.value;
        
        if (!token) {
            console.error('CSRF token tidak ditemukan!');
            showErrorAlert('Token keamanan tidak ditemukan. Silakan refresh halaman.');
            return;
        }

        fetch(`/cart/remove/${id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                "Accept": "application/json"
            }
        })
        .then(res => {
            if (!res.ok) {
                return res.text().then(text => {
                    throw new Error(`HTTP error! status: ${res.status}, response: ${text}`);
                });
            }
            return res.json();
        })
        .then(data => {
            console.log('Item berhasil dihapus:', data);
            if (data.success) {
                renderCart(data.cart);
                showSuccessAlert('Item berhasil dihapus dari keranjang');
                
                // Update cart count
                updateCartCount(data.cart_count || Object.keys(data.cart || {}).length);
            } else {
                throw new Error(data.message || 'Gagal menghapus item');
            }
        })
        .catch(error => {
            console.error('Error removing from cart:', error);
            showErrorAlert('Gagal menghapus item: ' + error.message);
        });
    }

    // Export fungsi ke global scope
    window.removeFromCart = removeFromCart;

    function loadCart() {
        console.log('Memuat cart dari server...');
        
        fetch('/cart/get')
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok: ' + res.status);
                }
                return res.json();
            })
            .then(data => {
                console.log('Data cart dari server:', data);
                renderCart(data.cart);
            })
            .catch(err => {
                console.error('Error loading cart:', err);
                try {
                    const initialCart = @json(session('cart') ?? []);
                    console.log('Menggunakan cart dari session:', initialCart);
                    renderCart(initialCart);
                } catch (e) {
                    console.error('Error parsing session cart:', e);
                    renderCart({});
                }
            });
    }

    async function addToCart(form) {
        console.log('=== MENAMBAH KE KERANJANG ===');
        console.log('Form data:', form.dataset);
        
        if (!checkLogin()) {
            console.log('User belum login, tampilkan modal login required');
            showLoginRequiredModal('menambahkan kamar ke keranjang');
            return;
        }

        const id = form.dataset.id;
        const token = form.querySelector('input[name="_token"]').value;
        const nomorKamar = form.dataset.nomor; // AMBIL nomor_kamar dari form

        // Validasi: pastikan form punya data nomor kamar
        if (!nomorKamar) {
            console.error('Form tidak memiliki data-nomor attribute!');
            console.log('Form attributes:', Object.keys(form.dataset));
            showErrorAlert('Data kamar tidak lengkap. Silakan refresh halaman.');
            return;
        }

        // Ambil data tanggal dari localStorage
        const savedDates = localStorage.getItem('bookingDates');
        let dates = {
            check_in: 'Tanggal tidak ditentukan',
            check_out: 'Tanggal tidak ditentukan',
            check_in_raw: '',
            check_out_raw: ''
        };

        if (savedDates) {
            try {
                dates = JSON.parse(savedDates);
                console.log('Tanggal dari localStorage:', dates);
                
                // VALIDASI: Pastikan tanggal sudah dipilih
                if (!dates.check_in_raw || !dates.check_out_raw) {
                    showErrorAlert('Silakan pilih tanggal check-in dan check-out terlebih dahulu');
                    return;
                }
            } catch (e) {
                console.error('Error parsing booking dates:', e);
                showErrorAlert('Format tanggal tidak valid. Silakan pilih ulang tanggal.');
                return;
            }
        } else {
            showErrorAlert('Silakan pilih tanggal check-in dan check-out terlebih dahulu');
            return;
        }

        // CEK KETERSEDIAAN KAMAR SEBELUM MENAMBAH KE KERANJANG
        try {
            // PERBAIKAN: Kirim nomorKamar, bukan id
            const availability = await checkRoomAvailability(nomorKamar, dates.check_in_raw, dates.check_out_raw);
            
            if (!availability.available) {
                showErrorAlert(availability.message);
                return;
            }
        } catch (error) {
            console.error('Error checking room availability:', error);
            showErrorAlert('Tidak dapat memverifikasi ketersediaan kamar. Silakan coba lagi.');
            return;
        }

        // Hitung jumlah malam
        const nights = calculateNights(dates.check_in_raw, dates.check_out_raw);
        const hargaPermalam = parseInt(form.dataset.hargaPermalam) || parseInt(form.dataset.harga) || 0;

        // Format tanggal untuk display (bahasa Indonesia)
        const formatDateForDisplay = (dateString) => {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };

        const formData = {
            nama: form.dataset.nama || 'Kamar',
            nomor: nomorKamar, // Gunakan nomorKamar yang sudah diambil
            tipe: form.dataset.tipe || 'Deluxe',
            harga_permalam: hargaPermalam,
            harga: hargaPermalam, // untuk kompatibilitas
            malam: nights,
            dewasa: parseInt(form.dataset.dewasa) || 2,
            anak: parseInt(form.dataset.anak) || 0,
            check_in: formatDateForDisplay(dates.check_in_raw),
            check_out: formatDateForDisplay(dates.check_out_raw),
            check_in_raw: dates.check_in_raw,
            check_out_raw: dates.check_out_raw,
            gambar: form.dataset.gambar || 'https://via.placeholder.com/100?text=Kamar',
            _token: token // tambahkan token di body juga
        };

        console.log('Data yang akan dikirim ke server:', formData);

        fetch(`/cart/add/${id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(formData)
        })
        .then(res => {
            console.log('Response status:', res.status);
            
            if (res.status === 401) {
                throw new Error('SESSION_EXPIRED');
            }
            
            if (!res.ok) {
                return res.text().then(text => {
                    console.error('Response text:', text);
                    throw new Error(`HTTP error! status: ${res.status}`);
                });
            }
            return res.json();
        })
        .then(data => {
            console.log('Response sukses dari server:', data);
            
            if (data.success) {
                renderCart(data.cart);
                if (cartModal) {
                    cartModal.classList.remove("hidden");
                }
                showSuccessAlert(`Kamar berhasil ditambahkan ke keranjang untuk ${nights} malam!`);
                
                // Update cart count
                updateCartCount(data.cart_count || Object.keys(data.cart || {}).length);
            } else {
                throw new Error(data.message || 'Unknown error from server');
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            
            if (error.message === 'SESSION_EXPIRED') {
                showLoginRequiredModal('sesi login telah berakhir. Silakan login kembali.');
            } else if (error.message.includes('Tanggal Check-in')) {
                showErrorAlert(error.message);
            } else {
                showErrorAlert('Gagal menambahkan ke keranjang: ' + error.message);
            }
        });
    }

    // ==================== DATE DISPLAY FUNCTIONS ====================
    function displaySelectedDates() {
        const savedDates = localStorage.getItem('bookingDates');
        if (savedDates) {
            try {
                const dates = JSON.parse(savedDates);
                const nights = calculateNights(dates.check_in_raw, dates.check_out_raw);
                
                console.log('Menampilkan tanggal:', dates, 'Jumlah malam:', nights);
                
                // Update semua kartu kamar
                document.querySelectorAll('[id^="selectedDatesDisplay-"]').forEach(display => {
                    const id = display.id.replace('selectedDatesDisplay-', '');
                    const checkInEl = document.getElementById(`checkInDisplay-${id}`);
                    const checkOutEl = document.getElementById(`checkOutDisplay-${id}`);
                    const nightsInfo = document.getElementById(`nightsInfo-${id}`);
                    
                    if (checkInEl) checkInEl.textContent = formatDate(dates.check_in_raw);
                    if (checkOutEl) checkOutEl.textContent = formatDate(dates.check_out_raw);
                    if (nightsInfo) nightsInfo.textContent = `${nights} Malam`;
                });

                // Update harga display
                updatePriceDisplay();
                
            } catch (e) {
                console.error('Error parsing booking dates:', e);
            }
        } else {
            console.log('Tidak ada tanggal yang disimpan di localStorage');
            // Set default 1 malam untuk harga display
            updatePriceDisplay();
        }
    }

    // ==================== EVENT LISTENERS ====================
    document.querySelectorAll(".add-to-cart-form").forEach(form => {
        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            console.log('Form tambah ke keranjang diklik, ID:', this.dataset.id, 'Nomor Kamar:', this.dataset.nomor);
            await addToCart(this);
        });
    });

    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            if (!checkLogin()) {
                e.preventDefault();
                console.log('Block checkout karena belum login');
                showLoginRequiredModal('melanjutkan ke checkout');
            }
        });
    }

    if (cartButton) {
        console.log('Tombol keranjang ditemukan:', cartButton);
        cartButton.addEventListener('click', function(e) {
            console.log('Tombol keranjang diklik via event listener');
            toggleCart();
        });
    }

    document.getElementById('loginRequiredModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            hideLoginRequiredModal();
        }
    });

    // ==================== MODAL SCROLL FIX ====================
    // Mencegah scroll body saat modal cart terbuka
    function toggleBodyScroll(enable) {
        if (enable) {
            document.body.style.overflow = 'auto';
        } else {
            document.body.style.overflow = 'hidden';
        }
    }

    // Override toggleCart untuk handle scroll
    const originalToggleCart = window.toggleCart;
    window.toggleCart = function() {
        originalToggleCart();
        const isModalOpen = !cartModal.classList.contains('hidden');
        toggleBodyScroll(!isModalOpen);
    };

    // Tutup modal saat klik di luar konten
    cartModal?.addEventListener('click', function(e) {
        if (e.target === this) {
            toggleCart();
        }
    });

    // ==================== INITIALIZATION ====================
    console.log('=== INISIALISASI KERANJANG ===');
    
    // Load cart dan display dates
    loadCart();
    displaySelectedDates();
    
    // Listen untuk perubahan tanggal
    window.addEventListener('storage', function(e) {
        if (e.key === 'bookingDates') {
            console.log('Tanggal berubah, update display');
            displaySelectedDates();
        }
    });

    console.log('=== SCRIPT KERANJANG SELESAI DIMUAT ===');
});

// Global functions
function hideCustomAlert() {
    const alert = document.getElementById('customAlert');
    if (alert) alert.classList.add('hidden');
}

function hideErrorAlert() {
    const alert = document.getElementById('errorAlert');
    if (alert) alert.classList.add('hidden');
}

function hideLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    if (modal) modal.classList.add('hidden');
}
</script>
<!-- Send Review -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll("#starRating .star");
    const ratingInput = document.getElementById("ratingInput");

    stars.forEach((star, index) => {
        star.addEventListener("click", () => {
            let rating = index + 1;
            ratingInput.value = rating;

            // ubah warna bintang
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove("text-gray-300");
                    s.classList.add("text-yellow-400");
                } else {
                    s.classList.remove("text-yellow-400");
                    s.classList.add("text-gray-300");
                }
            });
        });
    });
});
</script>
<!-- Get Review -->
<script>
    const slider = document.getElementById('reviewSlider');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    const scrollAmount = 320; // sesuaikan lebar card + margin

    prevBtn.addEventListener('click', () => {
        slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
        slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
</script>
  
</body>
</html>