<div class="login-box">
  <div class="login-logo">
    <a href="{{ asset('/') }}"><b>Login</b> Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masukkan username dan password.</p>

      @if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif
<form action="{{ asset(('adminteam/cek-login')) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="passwordInput">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <!-- Ikon mata -->
  <span id="togglePassword" style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #555; font-size: 14px;">
    <i class="fa fa-eye"></i>
  </span>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>

      <p class="mb-1 text-center">
        <a href="{{ route('adminteam.login') }}">Beranda </a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
 <script>
  document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    togglePassword.addEventListener('click', function () {
      // Ganti tipe input password/text
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.innerHTML = '<i class="fa fa-eye-slash"></i>';
      } else {
        passwordInput.type = 'password';
        this.innerHTML = '<i class="fa fa-eye"></i>';
      }
    });
  });
</script>