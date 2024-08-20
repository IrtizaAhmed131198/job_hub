<style>
  .navbar-dark .navbar-nav .nav-link {
      color: #fff !important;
  }

  .navbar-dark .navbar-nav .nav-link:hover {
      color: rgb(255 255 255 / 75%) !important;
  }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #1F2E80">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/home')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        {{-- <a href="{{ url('admin/logout') }}" class="nav-link" data-toggle="dropdown" title="Logout">
          <i class="fas fa-sign-out-alt"></i>
        </a> --}}
        <a href="{{ url('admin/logout') }}" class="nav-link">Logout</a>
        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 122px !important;">
          <a href="#" class="dropdown-item" style="color: #1F2E80;">
            <i class="fas fa-users mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('admin/logout') }}" class="dropdown-item" style="color: #1F2E80;">
            <i class="fas fa-sign-out-alt mr-2"></i> Log Out
          </a>
        </div> --}}
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->