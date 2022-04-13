<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investment Expert | Niveshaay | Surat</title>
    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
    @stack('css')
    @stack('headJs')
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
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

            <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" style="margin-left:10px;">
        <div id="google_translate_element"></div>
        {{-- <li class="nav-item dropdown">

            <a type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="icon-user"> <i class="fas fa-user"></i></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="{{ route('admin.showchangepassword')}}" class="dropdown-item">
                    <i class="fas fa-key nav-icon"></i> Change Password
                </a>
                <a href="" class="dropdown-item">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt nav-icon"></i> Logout</button>
                    </form>
                </a>
            </div>
        </li> --}}
        <li class="nav-item">
            <span>Welcome, {{Auth::user()->name}}</span>
        </li>
    </ul>
</nav>
        <!-- /.navbar -->
