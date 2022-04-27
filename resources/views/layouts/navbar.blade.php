   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
       <!-- Left navbar links -->
       <ul class="navbar-nav">
           <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
           </li>
           <li class="nav-item d-none d-sm-inline-block">
               <a href="{{ route('user.list') }}" class="nav-link">Trang chủ</a>
           </li>
       </ul>

       <!-- Right navbar links -->
       <ul class="navbar-nav ml-auto">
           <a href="{{ route('profile') }}" class="nav-link"> Xin chào: <strong> {{ Auth::user()->fullname }}</strong>,</a> <a
               href="{{ route('logout') }}" class="nav-link">Đăng xuất</a>
       </ul>
   </nav>
   <!-- /.navbar -->
