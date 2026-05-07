<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Icon Web -->
  <link rel="icon" href="{{asset('umum/images/logo-arumbromo.png') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }} "></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
  <style>
    .error-border {
      border-color: #f56565 !important;
    }
    .error-message {
      color: #f56565;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: none;
    }
  </style>
</head>
<body class="min-h-screen flex">
<div class="hidden md:flex md:w-11/12 relative">
    <img src="{{ asset('umum/images/icon-bromo2.jpg') }}"
         alt="Background"
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-10">
      <h1 class="text-4xl font-bold text-white mb-2">Welcome to Arum Bromo Villa</h1>
      <p class="text-white text-lg">Register to access your bookings, exclusive deals, and enjoy a faster checkout.</p>
    </div>
  </div>

  <!-- Bagian Kanan (Form Login) -->
  <div class="flex w-full md:w-1/2 justify-center items-center p-8">
    <div class="w-full max-w-sm text-center">
      <a href="{{ route('home.index') }}">
        <i class="fa fa-arrow-left text-m mr-96 text-gray-700 mb-4" aria-hidden="true"></i>
      </a>
      <h2 class="text-2xl font-bold mb-2">Ready to Plan Your Next Stay?</h2>
      <p class="text-gray-500 mb-6">
        Sign in to access your account and explore our latest offers.
      </p>
      
      <!-- Form -->
      <form id="registerForm" action="/register" method="post">
        @csrf
        
        <!-- Email -->
        <div class="mb-4">
          <label class="sr-only" for="email">Email</label>
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white">
            <!-- Icon Amplop -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 text-gray-400" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
              <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <input 
              type="email" 
              id="email" 
              name="email"
              placeholder="Insert your email"
              class="ml-2 w-full outline-none border-none text-gray-700 placeholder-gray-400"
              required
            >
          </div>
          <div id="email-error" class="error-message text-left ml-1"></div>
        </div>

        <!-- Nama -->
        <div class="mb-4">
          <label class="sr-only" for="name">Nama</label>
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white">
            <!-- Icon People (Orang) -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 text-gray-400" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
              <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <input 
              type="text" 
              id="name" 
              name="name"
              placeholder="Insert your name"
              class="ml-2 w-full outline-none border-none text-gray-700 placeholder-gray-400"
              required
            >
          </div>
          <div id="name-error" class="error-message text-left ml-1"></div>
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
          <label class="sr-only" for="password">Password</label>
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m6-6v-2a4 4 0 00-8 0v2m10 0a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2h12z" />
            </svg>
            <input 
              type="password" 
              id="password" 
              name="password" 
              placeholder="Insert password (min. 6 characters)"
              class="ml-2 w-full outline-none border-none text-gray-700 placeholder-gray-400"
              required
              minlength="6"
            >
            <button type="button" onclick="togglePass('password', 'eye-icon-1')" class="absolute right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
              <i id="eye-icon-1" class="fas fa-eye"></i>
            </button>
          </div>
          <div id="password-error" class="error-message text-left ml-1"></div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-6 relative">
          <label class="sr-only" for="confirm_password">Confirm Password</label>
          <div class="flex items-center border border-gray-300 rounded px-3 py-2 bg-white relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m6-6v-2a4 4 0 00-8 0v2m10 0a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2h12z" />
            </svg>
            <input 
              type="password" 
              id="confirm_password" 
              name="confirm_password" 
              placeholder="Insert confirm password"
              class="ml-2 w-full outline-none border-none text-gray-700 placeholder-gray-400"
              required
            >
            <button type="button" onclick="togglePass('confirm_password', 'eye-icon-2')" class="absolute right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
              <i id="eye-icon-2" class="fas fa-eye"></i>
            </button>
          </div>
          <div id="confirm_password-error" class="error-message text-left ml-1"></div>
        </div>

        <!-- Sign In Button -->
        <button type="submit" id="submitBtn"
                class="w-full bg-yellow-700 hover:bg-yellow-800 text-white py-2 rounded transition">
          Register
        </button>
      </form>

      <!-- Register Link -->
      <p class="text-center text-sm text-gray-500 mt-6">
        Do you have an account?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
      </p>
    </div>
  </div>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  
  <script>
    // Function to toggle password visibility
    function togglePass(inputId, iconId) {
      const passwordInput = document.getElementById(inputId);
      const eyeIcon = document.getElementById(iconId);

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }

    // Function to show error
    function showError(inputId, message) {
      const input = document.getElementById(inputId);
      const errorDiv = document.getElementById(`${inputId}-error`);
      
      // Add error border
      input.parentElement.classList.add('error-border');
      
      // Show error message
      errorDiv.textContent = message;
      errorDiv.style.display = 'block';
    }

    // Function to clear error
    function clearError(inputId) {
      const input = document.getElementById(inputId);
      const errorDiv = document.getElementById(`${inputId}-error`);
      
      // Remove error border
      input.parentElement.classList.remove('error-border');
      
      // Hide error message
      errorDiv.style.display = 'none';
    }

    // Real-time validation for password
    document.getElementById('password').addEventListener('input', function() {
      const password = this.value;
      
      if (password.length > 0 && password.length < 6) {
        showError('password', 'Password must be at least 6 characters');
      } else {
        clearError('password');
      }
      
      // Also check confirm password
      const confirmPassword = document.getElementById('confirm_password').value;
      if (confirmPassword && password !== confirmPassword) {
        showError('confirm_password', 'Passwords do not match');
      } else {
        clearError('confirm_password');
      }
    });

    // Real-time validation for confirm password
    document.getElementById('confirm_password').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;
      
      if (confirmPassword && password !== confirmPassword) {
        showError('confirm_password', 'Passwords do not match');
      } else {
        clearError('confirm_password');
      }
    });

    // Form submission validation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      let isValid = true;
      
      // Get form values
      const email = document.getElementById('email').value;
      const name = document.getElementById('name').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      
      // Clear all errors first
      clearError('email');
      clearError('name');
      clearError('password');
      clearError('confirm_password');
      
      // Validate email
      if (!email) {
        showError('email', 'Email is required');
        isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(email)) {
        showError('email', 'Please enter a valid email');
        isValid = false;
      }
      
      // Validate name
      if (!name) {
        showError('name', 'Name is required');
        isValid = false;
      }
      
      // Validate password
      if (!password) {
        showError('password', 'Password is required');
        isValid = false;
      } else if (password.length < 6) {
        showError('password', 'Password must be at least 6 characters');
        isValid = false;
      }
      
      // Validate confirm password
      if (!confirmPassword) {
        showError('confirm_password', 'Please confirm your password');
        isValid = false;
      } else if (password !== confirmPassword) {
        showError('confirm_password', 'Passwords do not match');
        isValid = false;
      }
      
      // If all validations pass, submit the form via AJAX
      if (isValid) {
        // Disable submit button
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        
        
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Register';
            
            if (xhr.status === 422) {
              // Validation errors from server
              const errors = xhr.responseJSON.errors;
              
              if (errors.email && errors.email[0].includes('taken')) {
                // Email already exists
                showError('email', 'Email already registered');
                Swal.fire({
                  title: 'Error!',
                  text: 'This email is already registered. Please use a different email.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                });
              } else {
                // Other validation errors
                for (const field in errors) {
                  showError(field, errors[field][0]);
                }
                
                Swal.fire({
                  title: 'Validation Error!',
                  text: 'Please check the form for errors.',
                  icon: 'warning',
                  confirmButtonText: 'OK'
                });
              }
            } else if (xhr.status === 500) {
              // Server error
              Swal.fire({
                title: 'Server Error!',
                text: 'Something went wrong. Please try again later.',
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          }
        });
      } else {
        // Show general validation error alert
        Swal.fire({
          title: 'Validation Error!',
          text: 'Please fill in all required fields correctly.',
          icon: 'warning',
          confirmButtonText: 'OK'
        });
      }
    });

    // Show validation messages on blur
    document.getElementById('email').addEventListener('blur', function() {
      const email = this.value;
      if (email && !/\S+@\S+\.\S+/.test(email)) {
        showError('email', 'Please enter a valid email');
      } else {
        clearError('email');
      }
    });

    document.getElementById('password').addEventListener('blur', function() {
      const password = this.value;
      if (password && password.length < 6) {
        showError('password', 'Password must be at least 6 characters');
      }
    });

    // Clear errors on focus
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
      input.addEventListener('focus', function() {
        clearError(this.id);
      });
    });

    // Show success/error messages from session
    @if(session('warning'))
      Swal.fire({
        title: 'Warning!',
        text: "{{ session('warning') }}",
        icon: 'warning',
        confirmButtonText: 'OK'
      });
    @endif

    @if(session('sukses'))
      Swal.fire({
        title: 'Success!',
        text: "{{ session('sukses') }}",
        icon: 'success',
        confirmButtonText: 'OK'
      });
    @endif

    // Check for email taken error from session
    @if(session('email_taken'))
      $(document).ready(function() {
        showError('email', 'Email already registered');
        Swal.fire({
          title: 'Email Already Registered!',
          text: "{{ session('email_taken') }}",
          icon: 'error',
          confirmButtonText: 'OK'
        });
      });
    @endif
  </script>
</body>
</html>