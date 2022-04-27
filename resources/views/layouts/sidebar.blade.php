<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link text-center">
        @if (Auth::user()->is_admin)
            <span class="brand-text font-weight-light">Admin</span>
            <br>
        @endif
        @if (Auth::user()->role_id == config('const.ROLE.MANAGE') && !Auth::user()->is_admin)
            {{ Auth::user()->depart->name }}
        @endif
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/UserAvatar/' . Auth::user()->avatar) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->fullname }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item {{request()->is('department*','user*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.list') }}"
                                class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nhân viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('department.list') }}"
                                class="nav-link {{ request()->is('department*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phòng ban</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prmanage.list') }}"
                                class="nav-link {{ request()->is('prmanage*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý dự án</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
