<style>
    /* [class*=sidebar-dark-] .sidebar a {
      color: #1F2E80;
  } */

    .nav-link {
        color: #1F2E80 !important;
    }

    .nav-link.active {
        background: #1F2E80 !important;
        color: #fff !important;
    }

    .brand-link {
        background-color: #DADADA !important;
    }

    .brand-text {
        color: #1F2E80 !important;
        font-weight: 600 !important;
    }

    .elevation-3 {
        box-shadow: unset !important;
    }

    .img-circle {
        border-radius: unset !important;
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #DADADA">
    <!-- Brand Logo -->
    <a href="{{ url('admin/home') }}" class="brand-link">
        <img src="{{ url('public/assets/logo/jobhub-logo.svg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('public/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
    <a href="#" class="d-block">Alexander Pierce</a>
  </div>
  </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ request()->routeIs('admin.*') ? 'menu-open' : '' }}">
                    <a href="{{ url('admin/home') }}"
                        class="nav-link {{ request()->routeIs('admin.home.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('users.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}"
                                class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('partners.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('partners.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Partners
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('partners.index') }}"
                                class="nav-link {{ request()->routeIs('partners.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('partners.create') }}"
                                class="nav-link {{ request()->routeIs('partners.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('categories.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}"
                                class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}"
                                class="nav-link {{ request()->routeIs('categories.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('blog.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Blogs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('blog.index') }}"
                                class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog.create') }}"
                                class="nav-link {{ request()->routeIs('blog.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('subscribe.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('subscribe.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Subscribe
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('subscribe.index') }}"
                                class="nav-link {{ request()->routeIs('subscribe.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('job.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('job.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Jobs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('job.index') }}"
                                class="nav-link {{ request()->routeIs('job.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('job.create') }}"
                                class="nav-link {{ request()->routeIs('job.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('jobapp.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('jobapp.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Job Application
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jobapp.index') }}"
                                class="nav-link {{ request()->routeIs('jobapp.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Job Application List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('settings.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.edit') }}"
                                class="nav-link {{ request()->routeIs('settings.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('pages.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('pages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            App Content
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pages.index') }}"
                                class="nav-link {{ request()->routeIs('pages.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages List</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
