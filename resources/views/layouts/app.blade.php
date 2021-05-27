<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> 
    @livewireStyles   
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('css/loading.css') }}"> 
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}"> 
    <!-- pickaday -->    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    <!-- JQVMap -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="{{ URL::asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ URL::asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>  
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">    
    @stack('styles')
</head>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-collapse" style="font-family: 'Open Sans Regular', sans-serif;">
    <!-- Navbar --> 
    <div class="container-fluid">
        <aside class="main-sidebar main-sidebar-sm sidebar-light-light elevation-2">
            <div class="sidebar os-host-scrollbar-horizontal-hidden os-host-transition">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://i.pinimg.com/originals/94/df/16/94df161620cbb9f0be919b53e5244d2f.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Luc Cui</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Nhân Viên <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item ">
                                    <a href="{{ route('dashboard.hoso') }}" class="nav-link">
                                        <i class="fab fa-slideshare nav-icon"></i><p>Hồ sơ người dùng</p>
                                    </a>
                                </li> 
                            </ul>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item ">
                                    <a href="{{ route('dashboard.nhanvien') }}" class="nav-link">
                                        <i class="fa-fw fas fa-user-friends nav-icon"></i><p>Thông tin nhân viên</p>
                                    </a>
                                </li> 
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-handshake"></i>
                                <p>Đối tác <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.khachhang') }}" class="nav-link">
                                        <i class="fas fa-user-cog nav-icon"></i><p>Khách hàng</p>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.khachhang') }}" class="nav-link">
                                        <i class="fas fa-industry nav-icon"></i><p>Nhà cung cáp</p>
                                    </a>
                                </li>
                            </ul>
                        </li>   
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>Hàng hóa<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.mathang') }}" class="nav-link"> 
                                    <i class="fas fa-cube nav-icon"></i><p>Thiết lập hàng hóa</p>
                                    </a>
                                </li>  
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>Giao dịch<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;"> 
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.phieunhapkho') }}" class="nav-link"> 
                                    <i class="fas fa-fw fas fa-dolly-flatbed nav-icon"></i><p>Nhập hàng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.phieuxuat.index') }}" class="nav-link"> 
                                    <i class="fa-fw fas fa-file-invoice-dollar nav-icon"></i><p>Xuất hàng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.phieuchi.index') }}" class="nav-link"> 
                                    <i class="fas fa-plus nav-icon"></i><p>Tạo phiếu chi</p>
                                    </a>
                                </li> 
                            </ul>
                        </li> 
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-chart-line"></i>
                                <p>Báo cáo<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.baocao') }}" class="nav-link">  
                                    <i class="fas fa-tasks nav-icon"></i><p>Tạo báo cáo</p>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="{{ route('bieudo') }}" class="nav-link"> 
                                    <i class="fas fa-chart-pie nav-icon"></i><p>Cuối ngày</p>
                                    </a>
                                </li>   
                            </ul>
                        </li>  
                        <li class="nav-item menu-open">
                            <a href="{{ route('auth.dangxuat') }}" class="nav-link"> 
                                <i class="fa fa-sign-in-alt nav-icon"></i>
                                <p> Đăng xuất<i class="right fas"></i></p>
                            </a>
                           
                        </li>   
                    </ul> 
                </nav>
            </div>
        </aside> 
        <div class="content-wrapper" style="min-height: 507.398px;">  
            @yield('content')
        </div>   
    </div> 
    @livewireScripts  
    @livewireChartsScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
    <script>  
        window.addEventListener('swal.modal', event => { 
            Swal.fire({
                title: event.detail.title,   
                content: event.detail.content ?? "",   
                icon: event.detail.type,   
            }) 
        }) 
    </script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> 
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> 

    @stack('scripts')
    
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ URL::asset('plugins/sparklines/sparkline.js') }}"></script> 
    <!-- daterangepicker -->
    <script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ URL::asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('dist/js/pages/dashboard.js') }}"></script>
</body>
</html>
