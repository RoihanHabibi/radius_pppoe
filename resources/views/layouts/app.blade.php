<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FreeRADIUS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ Route('radcheck.dashboard') }}" class="nav-link {{ Request::is('radcheck/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Menu untuk Create User -->
          <li class="nav-item">
            <a href="{{ Route('radcheck.create_user') }}" class="nav-link {{ Request::is('radcheck/tambah_user') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>Tambah Pengguna</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('radcheck') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('radcheck') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                PPoE
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('radcheck?status=enabled') }}" class="nav-link {{ Request::is('radcheck') && Request::query('status') == 'enabled' ? 'active' : '' }}">
                  <i class="fas fa-user-check nav-icon"></i>
                  <p>PPoE active</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('radcheck?status=disabled') }}" class="nav-link {{ Request::is('radcheck') && Request::query('status') == 'disabled' ? 'active' : '' }}">
                  <i class="fas fa-user-times nav-icon"></i>
                  <p>PPoE inactive</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <!-- Logout Button -->
      <div class="mt-4 pt-4 pb-4">
        <form method="POST" action="{{ route('radcheck.logout') }}" class="text-center">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>
      <!-- /.logout -->
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
            <h1>@yield('title')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>FreeRADIUS 2024</strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <!-- Success Message Script -->
  @if (session('success'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: "{{ session('success') }}",
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif

  <!-- Error Message Script -->
  @if (session('error'))
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: "{{ session('error') }}",
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif

@yield('scripts')
</body>
</html>