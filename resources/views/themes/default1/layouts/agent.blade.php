<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Faveo HELPDESK - Agent Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Faveo HELPDESK - Agent Panel')</title>
    
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

        <!-- Top Navigation Tabs -->
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3 @yield('Dashboard')">
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item px-3 @yield('Users')">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item px-3 @yield('Tickets')">
                <a class="nav-link" href="#">Tickets</a>
            </li>
        </ul>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item px-3">
                <a class="nav-link" href="{{ url('agents') }}">Admin Panel</a>
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
                <!-- User Panel -->
                <div class="sidebar-header text-center py-3">
                    @if(Auth::user())
                        @yield('profileimg')
                        @if(!trim($__env->yieldContent('profileimg')))
                            @if(Auth::user()->profile_pic)
                                <img src="{{ asset('lb-faveo/dist/img/'.Auth::user()->profile_pic) }}" class="img-avatar" alt="User Image" width="80">
                            @else
                                <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-avatar" alt="User Image" width="80">
                            @endif
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
                    @yield('sidebar')
                    
                    <li class="nav-title">TICKETS</li>
                    
                    <?php
                        $inbox = App\Model\helpdesk\Ticket\Tickets::all();
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

                    <li class="nav-title">DEPARTMENTS</li>
                    
                    <?php
                        $depts = App\Model\helpdesk\Agent\Department::all();
                        foreach ($depts as $dept) {
                            $open = App\Model\helpdesk\Ticket\Tickets::where('status','=','1')->where('dept_id','=',$dept->id)->get();
                            $open = count($open);
                            
                            $closed = App\Model\helpdesk\Ticket\Tickets::where('status','=','2')->where('dept_id','=',$dept->id)->get();
                            $closed = count($closed);
                            
                            $underprocess = 0;
                            foreach ($inbox as $ticket4) {
                                if ($ticket4->assigned_to != null) {
                                    $underprocess++;
                                }
                            }
                            
                            if (Auth::user()->role == 'admin') {
                    ?>
                                <li class="nav-item nav-dropdown">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="nav-icon fa fa-folder-open"></i> {{ $dept->name }}
                                    </a>
                                    <ul class="nav-dropdown-items">
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="nav-icon fa fa-circle"></i> Open
                                                <span class="badge badge-success">{{ $open }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="nav-icon fa fa-circle"></i> In Progress
                                                <span class="badge badge-success">{{ $underprocess }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="nav-icon fa fa-circle"></i> Closed
                                                <span class="badge badge-success">{{ $closed }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                    <?php
                            }
                            
                            if (Auth::user()->role == 'agent' && Auth::user()->primary_dpt == $dept->name) {
                    ?>
                                <li class="nav-item nav-dropdown">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <i class="nav-icon fa fa-folder-open"></i> {{ $dept->name }}
                                    </a>
                                    <ul class="nav-dropdown-items">
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="nav-icon fa fa-circle"></i> Open
                                                <span class="badge badge-success">{{ $open }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="nav-icon fa fa-circle"></i> In Progress
                                                <span class="badge badge-success">{{ $underprocess }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="nav-icon fa fa-circle"></i> Closed
                                                <span class="badge badge-success">{{ $closed }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </nav>
            
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Main Content -->
        <main class="main">
            <?php 
                $agent_group = Auth::user()->assign_group;
                $group = App\Model\helpdesk\Agent\Groups::where('name', '=', $agent_group)->where('group_status', '=', '1')->first();
            ?>
            
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                @yield('breadcrumbs')
            </ol>

            <!-- Sub Navigation -->
            @hasSection('sub-navigation')
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            @yield('sub-navigation')
                        </ul>
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
