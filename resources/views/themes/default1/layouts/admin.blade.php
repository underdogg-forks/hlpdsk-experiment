<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Faveo HELPDESK - Admin Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Faveo HELPDESK')</title>
    
    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    @yield('HeadInclude')
</head>

<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="sidebar sidebar-width fixed left-0 top-0 h-full transition-sidebar z-40 flex-shrink-0">
        <!-- User Panel -->
        <div class="p-4 border-b border-white border-opacity-10">
            <div class="flex flex-col items-center text-center">
                @if(Auth::user())
                    @if(Auth::user()->profile_pic)
                        <img src="{{ asset('lb-faveo/dist/img/'.Auth::user()->profile_pic) }}" class="w-20 h-20 rounded-full mb-2" alt="User Image">
                    @else
                        <img src="{{ Gravatar::src(Auth::user()->email) }}" class="w-20 h-20 rounded-full mb-2" alt="User Image">
                    @endif
                    <div class="text-white font-semibold">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </div>
                    <div class="text-sm text-white text-opacity-60">
                        @if(Auth::user() && Auth::user()->active == 1)
                            <i class="fas fa-circle text-green-400 text-xs"></i> Online
                        @else
                            <i class="fas fa-circle text-gray-400 text-xs"></i> Offline
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Search Form -->
        <div class="p-3">
            <form action="#" method="get">
                <div class="relative">
                    <input type="text" name="q" class="w-full px-3 py-2 bg-white bg-opacity-10 border border-white border-opacity-20 rounded text-white placeholder-white placeholder-opacity-60 focus:outline-none focus:bg-opacity-20" placeholder="Search...">
                    <button type="submit" class="absolute right-2 top-2 text-white text-opacity-60 hover:text-opacity-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto">
            <div class="px-2 py-2">
                <div class="text-xs font-semibold text-white text-opacity-60 px-4 py-2 uppercase tracking-wider">TICKETS</div>
                
                <?php
                    $inbox = App\Model\helpdesk\Ticket\Tickets::get();
                    $myticket = App\Model\helpdesk\Ticket\Tickets::where('assigned_to', Auth::user()->id)->where('status','1')->get();
                    $unassigned = App\Model\helpdesk\Ticket\Tickets::where('assigned_to', '0')->where('status','1')->get();
                    $tickets = App\Model\helpdesk\Ticket\Tickets::where('status','1')->get();
                    $i = count($tickets);
                ?>
                
                <a href="{{ url('/ticket/open') }}" class="sidebar-link flex items-center px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    <i class="fas fa-envelope sidebar-icon w-6"></i>
                    <span class="flex-1 ml-2">Inbox</span>
                    <span class="badge badge-success">{{ $i }}</span>
                </a>
                
                <a href="{{ url('ticket/myticket') }}" class="sidebar-link flex items-center px-4 py-2 rounded hover:bg-blue-600 transition-colors @yield('myticket')">
                    <i class="fas fa-user sidebar-icon w-6"></i>
                    <span class="flex-1 ml-2">My Tickets</span>
                    <span class="badge badge-success">{{ count($myticket) }}</span>
                </a>
                
                <a href="{{ url('unassigned') }}" class="sidebar-link flex items-center px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    <i class="fas fa-th sidebar-icon w-6"></i>
                    <span class="flex-1 ml-2">Unassigned</span>
                    <span class="badge badge-success">{{ count($unassigned) }}</span>
                </a>
                
                <a href="{{ url('trash') }}" class="sidebar-link flex items-center px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    <i class="fas fa-trash sidebar-icon w-6"></i>
                    <span class="flex-1 ml-2">Trash</span>
                    <?php $deleted = App\Model\helpdesk\Ticket\Tickets::where('status', '5')->get(); ?>
                    <span class="badge badge-success">{{ count($deleted) }}</span>
                </a>

                @yield('sidebar-extra')
            </div>
        </nav>
        
        <!-- Minimize Button -->
        <button class="w-full p-3 border-t border-white border-opacity-10 hover:bg-white hover:bg-opacity-10 transition-colors" type="button" data-toggle="sidebar-minimize">
            <i class="fas fa-angle-left"></i>
        </button>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col sidebar-width ml-64">
        <!-- Header -->
        <header class="navbar navbar-height sticky top-0 z-30 flex items-center justify-between px-4 shadow-sm">
            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden text-gray-600 hover:text-gray-900" type="button" data-toggle="sidebar">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Logo -->
            <div class="hidden lg:block">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                    <span class="text-blue-600">Faveo</span> HELPDESK
                </a>
            </div>

            <!-- Top Navigation Tabs -->
            <nav class="hidden md:flex items-center space-x-1">
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded">Home</a>
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded @yield('Staffs')">Staffs</a>
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded @yield('Emails')">Emails</a>
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded @yield('Manage')">Manage</a>
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded @yield('Settings')">Settings</a>
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded @yield('Themes')">Themes</a>
            </nav>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('user') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Agent Panel</a>
                
                <!-- Dark Mode Toggle -->
                <button class="dark-mode-toggle" data-toggle="dark-mode" title="Toggle Dark Mode">
                    <i class="fas fa-sun icon-sun absolute text-yellow-500"></i>
                    <i class="fas fa-moon icon-moon absolute text-blue-400"></i>
                </button>
                
                <!-- User Dropdown -->
                <div class="relative">
                    <button class="flex items-center space-x-2 hover:bg-gray-100 rounded-full p-1 transition-colors" data-toggle="dropdown">
                        @if(Auth::user())
                            @if(Auth::user()->profile_pic)
                                <img src="{{ asset('lb-faveo/dist/img/'.Auth::user()->profile_pic) }}" class="w-8 h-8 rounded-full" alt="{{ Auth::user()->first_name }}">
                            @else
                                <img src="{{ Gravatar::src(Auth::user()->email) }}" class="w-8 h-8 rounded-full" alt="{{ Auth::user()->first_name }}">
                            @endif
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                        @endif
                    </button>
                    <div class="dropdown-menu hidden">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-semibold text-gray-900">Account</p>
                        </div>
                        <a href="{{ url('admin-profile') }}" class="dropdown-item">
                            <i class="fas fa-user w-4"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('auth/logout') }}" class="dropdown-item text-red-600">
                            <i class="fas fa-sign-out-alt w-4"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Breadcrumb -->
            @hasSection('breadcrumbs')
            <div class="bg-white border-b border-gray-200 px-4 py-3">
                <nav class="breadcrumb">
                    @yield('breadcrumbs')
                </nav>
            </div>
            @endif

            <!-- Sub Navigation -->
            @hasSection('sub-navigation')
            <div class="bg-white border-b border-gray-200 px-4">
                <div class="flex space-x-4">
                    @yield('sub-navigation')
                </div>
            </div>
            @endif

            <div class="container mx-auto px-4 py-6">
                <!-- Page Header -->
                @yield('PageHeader')
                
                <!-- Flash Messages -->
                @if(Session::has('success'))
                    <div class="alert alert-success flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span><strong>Success!</strong> {{ session('success') }}</span>
                        </div>
                        <button type="button" class="text-green-800 hover:text-green-900" data-dismiss="alert">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
                
                @if(Session::has('fails'))
                    <div class="alert alert-danger flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span><strong>Error!</strong> {{ session('fails') }}</span>
                        </div>
                        <button type="button" class="text-red-800 hover:text-red-900" data-dismiss="alert">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="app-footer mt-auto py-4 px-6 text-sm">
            <div class="flex items-center justify-between">
                <div>
                    <?php
                        $company = App\Model\helpdesk\Settings\Company::where('id', '=', '1')->first();
                    ?>
                    <strong>Copyright &copy; {{ date('Y') }} 
                        <a href="{{ $company->website ?? '#' }}" class="text-blue-600 hover:text-blue-800">{{ $company->company_name ?? 'Faveo' }}</a>.
                    </strong> All rights reserved. 
                    Powered by <a href="http://www.faveohelpdesk.com/" target="_blank" class="text-blue-600 hover:text-blue-800">Faveo</a>
                </div>
                <div>
                    <span class="font-semibold">Version</span> 0.1
                </div>
            </div>
        </footer>
    </div>

    @yield('FooterInclude')
</body>
</html>

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

        <!-- Top Navigation Tabs -->
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item px-3 @yield('Staffs')">
                <a class="nav-link" href="#">Staffs</a>
            </li>
            <li class="nav-item px-3 @yield('Emails')">
                <a class="nav-link" href="#">Emails</a>
            </li>
            <li class="nav-item px-3 @yield('Manage')">
                <a class="nav-link" href="#">Manage</a>
            </li>
            <li class="nav-item px-3 @yield('Settings')">
                <a class="nav-link" href="#">Settings</a>
            </li>
            <li class="nav-item px-3 @yield('Themes')">
                <a class="nav-link" href="#">Themes</a>
            </li>
        </ul>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item px-3">
                <a class="nav-link" href="{{ url('user') }}">Agent Panel</a>
            </li>
            
            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user())
                        @if(Auth::user()->profile_pic)
                            <img src="{{ asset('lb-faveo/dist/img/'.Auth::user()->profile_pic) }}" class="img-avatar" alt="{{ Auth::user()->first_name }}">
                        @else
                            <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-avatar" alt="{{ Auth::user()->first_name }}">
                        @endif
                        <span class="d-md-down-none">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="{{ url('admin-profile') }}">
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
                <!-- User Panel -->
                <div class="sidebar-header text-center py-3">
                    @if(Auth::user())
                        @if(Auth::user()->profile_pic)
                            <img src="{{ asset('lb-faveo/dist/img/'.Auth::user()->profile_pic) }}" class="img-avatar" alt="User Image" width="80">
                        @else
                            <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-avatar" alt="User Image" width="80">
                        @endif
                        <div class="mt-2">
                            <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                        </div>
                        <div class="text-muted">
                            @if(Auth::user() && Auth::user()->active == 1)
                                <i class="fa fa-circle text-success"></i> Online
                            @else
                                <i class="fa fa-circle text-muted"></i> Offline
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Search Form -->
                <div class="px-3 py-2">
                    <form action="#" method="get">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <ul class="nav">
                    <li class="nav-title">TICKETS</li>
                    
                    <?php
                        $inbox = App\Model\helpdesk\Ticket\Tickets::get();
                        $myticket = App\Model\helpdesk\Ticket\Tickets::where('assigned_to', Auth::user()->id)->where('status','1')->get();
                        $unassigned = App\Model\helpdesk\Ticket\Tickets::where('assigned_to', '0')->where('status','1')->get();
                        $tickets = App\Model\helpdesk\Ticket\Tickets::where('status','1')->get();
                        $i = count($tickets);
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ticket/open') }}">
                            <i class="nav-icon fa fa-envelope"></i> Inbox
                            <span class="badge badge-success">{{ $i }}</span>
                        </a>
                    </li>
                    
                    <li class="nav-item @yield('myticket')">
                        <a class="nav-link" href="{{ url('ticket/myticket') }}">
                            <i class="nav-icon fa fa-user"></i> My Tickets
                            <span class="badge badge-success">{{ count($myticket) }}</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('unassigned') }}">
                            <i class="nav-icon fa fa-th"></i> Unassigned
                            <span class="badge badge-success">{{ count($unassigned) }}</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('trash') }}">
                            <i class="nav-icon fa fa-trash"></i> Trash
                            <?php $deleted = App\Model\helpdesk\Ticket\Tickets::where('status', '5')->get(); ?>
                            <span class="badge badge-success">{{ count($deleted) }}</span>
                        </a>
                    </li>

                    @yield('sidebar-extra')
                </ul>
            </nav>
            
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Main Content -->
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                @yield('breadcrumbs')
            </ol>

            <!-- Sub Navigation -->
            @hasSection('sub-navigation')
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        @yield('sub-navigation')
                    </div>
                </div>
            </div>
            @endif

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
                $company = App\Model\helpdesk\Settings\Company::where('id', '=', '1')->first();
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
