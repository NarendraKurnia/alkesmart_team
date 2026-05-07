<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('dasbor') }}" class="brand-link">
      <img src="{{asset('umum/images/logo-arumbromo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{asset('adminvillas/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ asset('adminteam/user') }}" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                User
                <span class="right badge badge-danger">Administrator</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ asset('adminteam/marketing') }}" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Akun Marketing
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('instansi.index') }}" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Daftar Instansi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kabupaten.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Daftar Kabupaten
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masuka.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Kegiatan Masuk Marketing
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('selesaia.index') }}" class="nav-link">
              <i class="nav-icon fa fa-fire"></i>
              <p>
                Data Kegiatan Selesai Marketing
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">