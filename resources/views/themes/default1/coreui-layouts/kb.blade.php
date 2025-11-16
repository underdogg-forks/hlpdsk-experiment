<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Knowledge Base">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Faveo HELPDESK - Knowledge Base')</title>
    
    <!-- CoreUI CSS -->
    <link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    @yield('HeadInclude')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed">
    <!-- Header -->
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="navbar-brand-full">
                <b>Faveo </b>HELPDESK
            </span>
            <span class="navbar-brand-minimized">
                <b>F</b>H
            </span>
        </a>
        
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item px-3">
                <a class="nav-link" href="{{ url('agents') }}">Admin Panel</a>
            </li>
            
            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user())
                        @if(Auth::user()->profile_pic)
                            <img src="{{ asset('dist/img/'.Auth::user()->profile_pic) }}" class="img-avatar" alt="{{ Auth::user()->first_name }}">
                        @else
                            <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-avatar" alt="{{ Auth::user()->first_name }}">
                        @endif
                        <span class="d-md-down-none">{{ Auth::user()->first_name }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="{{ URL::route('profile') }}">
                        <i class="fa fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('auth/logout') }}">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">
        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="sidebar-nav">
                @yield('sidebar')
            </nav>
            
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Main Content -->
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                @yield('breadcrumbs')
            </ol>

            <div class="container-fluid">
                <!-- Page Header -->
                @yield('PageHeader')
                
                <!-- Flash Messages -->
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                
                @if(Session::has('fails'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Error!</strong> {{ session('fails') }}
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="app-footer">
        <div>
            <?php
                $company = App\Model\Settings\Company::where('id', '=', '1')->first();
            ?>
            <strong>Copyright &copy; {{ date('Y') }} 
                <a href="{{ $company->website ?? '#' }}">{{ $company->company_name ?? 'Faveo' }}</a>.
            </strong> All rights reserved. 
            Powered by <a href="http://www.faveohelpdesk.com/" target="_blank">Faveo</a>
        </div>
        <div class="ml-auto">
            <span><b>Version</b> 0.1</span>
        </div>
    </footer>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('FooterInclude')
</body>
</html>
