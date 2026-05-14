<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Register</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Theme style (AdminLTE) -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  
  <style>
    .error-border { border-color: #f56565 !important; }
    .error-message { color: #f56565; font-size: 0.875rem; margin-top: 0.25rem; display: none; }
    .input-group-custom { transition: all 0.3s; }
    .input-group-custom.error-border { border: 1px solid #f56565; }
  </style>
</head>

<body class="min-h-screen flex bg-gray-50">
  <!-- Bagian Kiri (Background) -->
  <div class="hidden md:flex md:w-11/12 relative">
    <img src="{{ asset('umum/images/bg-depan.png') }}" alt="Background" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-10">
      <h1 class="text-4xl font-bold text-white mb-2">Welcome to Alkesmart Marketing Team</h1>
      <p class="text-white text-lg">Register to access your working report</p>
    </div>
  </div>

  <!-- Bagian Kanan (Form) -->
  <div class="flex w-full md:w-1/2 justify-center items-center p-8">
    <div class="w-full max-w-sm">
      <div class="mb-4">
        <a href="{{ route('home.index') }}" class="text-gray-600 hover:text-black">
          <i class="fa fa-arrow-left text-xl"></i>
        </a>
      </div>
      <h2 class="text-2xl font-bold mb-2 text-center">Register</h2>
      <p class="text-gray-500 mb-6 text-center">Register to get your account.</p>
      
      <form id="registerForm" action="{{ url('register') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <!-- Email -->
        <div class="mb-4">
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white input-group-custom">
            <i class="fas fa-envelope text-gray-400"></i>
            <input type="email" id="email" name="email" placeholder="Insert your email" class="ml-2 w-full outline-none border-none text-gray-700" required>
          </div>
          <div id="email-error" class="error-message ml-1"></div>
        </div>

        <!-- Nama -->
        <div class="mb-4">
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white input-group-custom">
            <i class="fas fa-user text-gray-400"></i>
            <input type="text" id="name" name="name" placeholder="Insert your name" class="ml-2 w-full outline-none border-none text-gray-700" required>
          </div>
          <div id="name-error" class="error-message ml-1"></div>
        </div>

        <!-- Foto Profil -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white input-group-custom">
            <i class="fas fa-camera text-gray-400"></i>
            <input type="file" id="gambar" name="gambar" accept="image/*" class="ml-2 w-full outline-none text-gray-700" required>
          </div>
          <div id="gambar-error" class="error-message ml-1"></div>
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white input-group-custom relative">
            <i class="fas fa-lock text-gray-400"></i>
            <input type="password" id="password" name="password" placeholder="Password (min. 6 characters)" class="ml-2 w-full outline-none border-none text-gray-700" required minlength="6">
            <button type="button" onclick="togglePass('password', 'eye-icon-1')" class="absolute right-3 focus:outline-none">
              <i id="eye-icon-1" class="fas fa-eye text-gray-400"></i>
            </button>
          </div>
          <div id="password-error" class="error-message ml-1"></div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-6 relative">
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white input-group-custom relative">
            <i class="fas fa-check-circle text-gray-400"></i>
            <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm password" class="ml-2 w-full outline-none border-none text-gray-700" required>
            <button type="button" onclick="togglePass('confirm_password', 'eye-icon-2')" class="absolute right-3 focus:outline-none">
              <i id="eye-icon-2" class="fas fa-eye text-gray-400"></i>
            </button>
          </div>
          <div id="confirm_password-error" class="error-message ml-1"></div>
        </div>

        <button type="submit" id="submitBtn" class="w-full bg-yellow-700 hover:bg-yellow-800 text-white py-2 rounded transition font-semibold">
          Register
        </button>
      </form>

      <p class="text-center text-sm text-gray-500 mt-6">
        Do you have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
      </p>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <script>
    // 1. Toggle Password Visibility
    function togglePass(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }

    // 2. Helper Functions for UI Errors
    function showError(inputId, message) {
      const input = document.getElementById(inputId);
      const container = input.closest('.input-group-custom');
      const errorDiv = document.getElementById(`${inputId}-error`);
      if(container) container.classList.add('error-border');
      if(errorDiv) {
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
      }
    }

    function clearErrors() {
      $('.input-group-custom').removeClass('error-border');
      $('.error-message').hide().text('');
    }

    // 3. Form Submission with AJAX
    $('#registerForm').on('submit', function(e) {
      e.preventDefault();
      clearErrors();

      const submitBtn = $('#submitBtn');
      const formData = new FormData(this);

      submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

      $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          Swal.fire({
            title: 'Berhasil!',
            text: 'Registrasi berhasil, mengalihkan...',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
          }).then(() => {
            window.location.href = "{{ route('login') }}"; // Ganti ke dashboard jika perlu
          });
        },
        error: function(xhr) {
          submitBtn.prop('disabled', false).text('Register');
          
          if (xhr.status === 422) {
            // Error Validasi Laravel
            const errors = xhr.responseJSON.errors;
            let errorMessage = "";
            for (let key in errors) {
              showError(key, errors[key][0]);
              errorMessage += `${errors[key][0]}<br>`;
            }
            Swal.fire({
              title: 'Gagal!',
              html: errorMessage,
              icon: 'error'
            });
          } else {
            // Error Server / Lainnya
            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan sistem. Silakan coba lagi nanti.',
              icon: 'error'
            });
          }
        }
      });
    });
  </script>
</body>
</html>