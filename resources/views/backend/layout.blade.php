<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/png"/>
    <title> Dashboard | {{env('APP_NAME')}}</title>

    <link rel="stylesheet" href="{{asset('backend')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/sweetalert/sweetalert2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('css')
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <div class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </div>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a title="logout" class="nav-link" data-toggle="dropdown" href="{{route('logout')}}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off fa-2x"></i>
                </a>
                <form id="logout-form" style="display:none;" method="post" action="{{route('logout')}}">
                    @csrf
                </form>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-indigo elevation-2">
        <!-- Brand Logo -->
        <a href="{{route('home')}}" class="brand-link text-center">
            <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="Nudge Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light mr-3">{{env('APP_NAME')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel justify-content-center mt-3 pb-3 mb-3 mr-2 d-flex">
                <div class="image">
                    <img src="{{asset('backend')}}/dist/img/avatar5.png" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('profile')}}" class="d-block text-capitalize">{{auth()->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Menus
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('home')}}"
                                   class="nav-link {{request()->routeIs('home') ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Doc</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{--user managements--}}
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item has-treeview {{request()->routeIs('users') || request()->routeIs('admins') ? 'menu-open' : ''}}">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    User Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('users')}}"
                                       class="nav-link {{request()->routeIs('users') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admins')}}"
                                       class="nav-link {{request()->routeIs('admins') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admins</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
    @yield('content')
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Main Footer -->
<footer class="main-footer text-center">
    <strong>Copyright &copy; 2021-22 <a href="{{route('home')}}">{{env('APP_NAME')}}</a></strong> All rights reserved.
</footer>

<!-- REQUIRED SCRIPTS -->
<script src="{{asset('backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>--}}
<script type="text/javascript">
    toastr.options = {"closeButton": true, "progressBar": true,};
</script>
{!! Toastr::message() !!}
@foreach ($errors->all() as $error)
    <script>
        toastr["error"]("{{$error}}");
    </script>
@endforeach
@stack('js')
<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
