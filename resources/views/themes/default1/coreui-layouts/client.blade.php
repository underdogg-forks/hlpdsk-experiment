<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Support Center - Client Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Support Center - Client Panel')</title>
    
    <!-- CoreUI CSS -->
    <link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    @yield('HeadInclude')
    
    <style>
        /* Client-specific styling */
        .site-header {
            background-color: var(--navbar-bg);
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .site-logo {
            margin-bottom: 20px;
        }
        
        .site-navigation {
            background-color: transparent;
            border: none;
        }
        
        .navbar-menu > li > a {
            padding: 10px 15px;
            color: var(--body-color);
            transition: all var(--transition-speed);
        }
        
        .navbar-menu > li > a:hover {
            color: var(--primary);
            background-color: var(--light);
        }
        
        .site-footer {
            background-color: var(--footer-bg);
            color: var(--footer-color);
            padding: 40px 0 20px;
            margin-top: 60px;
            border-top: 1px solid var(--border-color);
        }
        
        .main-content-area {
            min-height: 500px;
            padding: 40px 0;
        }
    </style>
</head>

<body>
    <div id="page" class="hfeed site">
        <!-- Header -->
        <header id="masthead" class="site-header" role="banner">
            <div class="container">
                <div id="logo" class="site-logo text-center" style="font-size: 30px;">
                    <?php
                        $company = App\Model\helpdesk\Settings\Company::where('id', '=', '1')->first();
                        $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();
                    ?>
                    @if($system->url)
                        <a href="{{ $system->url }}" rel="home">
                    @else
                        <a href="{{ url('home') }}" rel="home">
                    @endif
                    
                    @if($company->use_logo == 1)
                        <img src="{{ asset('lb-faveo/dist/'.$company->logo) }}" alt="Logo" width="200px" height="200px"/>
                    @else
                        @if($system->name)
                            {!! $system->name !!}
                        @else
                            <b>SUPPORT</b> CENTER
                        @endif
                    @endif
                    </a>
                </div>
                
                <div id="navbar" class="navbar-wrapper text-center">
                    <nav class="navbar navbar-expand-lg navbar-light site-navigation" role="navigation">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav navbar-menu">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('home') }}">Home</a>
                                </li>
                                @if($system->first()->status == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL::route('form') }}">Submit A Ticket</a>
                                    </li>
                                @endif
                                
                                @if(Auth::user())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('mytickets') }}">My Tickets</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            My Profile
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                            <div class="dropdown-header text-center">
                                                @if(Auth::user()->profile_pic)
                                                    <img src="{{ asset('lb-faveo/dist/img/'.Auth::user()->profile_pic) }}" class="img-avatar" alt="User Image" width="60">
                                                @else
                                                    <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-avatar" alt="User Image" width="60">
                                                @endif
                                                <h6 class="mt-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ url('auth/logout') }}">
                                                <i class="fa fa-sign-out-alt"></i> Log out
                                            </a>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#login-form">
                                            Login <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
                
                @if(!Auth::user())
                <div id="login-form" class="login-form collapse">
                    <div class="card mt-3 mx-auto" style="max-width: 400px;">
                        <div class="card-body">
                            <form method="POST" action="{{ route('post.login') }}">
    @csrf
                            
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    {!! Form::text('email', null, ['placeholder'=>'Email', 'class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                </div>
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                            </div>
                            
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    {!! Form::password('password', ['placeholder'=>'Password', 'class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                </div>
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ url('password/email') }}">Forgot password?</a><br>
                                    <a href="#">Create Account</a>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Alert Messages -->
                <div id="header-search" class="site-search clearfix mt-3">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-check-circle"></i> <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session()->has('fails'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-ban"></i> <strong>Alert!</strong> {{ session('fails') }}
                        </div>
                    @endif
                    
                    @if($errors->first('email') || $errors->first('password'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-ban"></i> <strong>Alert!</strong> Please check your login credentials.
                        </div>
                    @endif
                </div>
            </div>
        </header>
        
        <!-- Breadcrumb -->
        @yield('breadcrumb')
        
        <!-- Main Content -->
        <div id="main" class="site-main clearfix main-content-area">
            <div class="container">
                <div class="content-area">
                    <div class="row">
                        @yield('content')
                        
                        <!-- Sidebar -->
                        <div id="sidebar" class="site-sidebar col-md-3">
                            <div class="widget-area">
                                <section id="section-banner" class="section">
                                    @yield('check')
                                </section>
                                <section id="section-categories" class="section">
                                    @yield('category')
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <?php
            $footer = App\Model\helpdesk\Theme\Footer::whereId('1')->first();
            $footer2 = App\Model\helpdesk\Theme\Footer2::whereId('1')->first();
            $footer3 = App\Model\helpdesk\Theme\Footer3::whereId('1')->first();
            $footer4 = App\Model\helpdesk\Theme\Footer4::whereId('1')->first();
        ?>
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="container">
                <div class="row">
                    @if($footer->title)
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-about" class="section">
                                <h2 class="h4">{!! $footer->title !!}</h2>
                                <div class="textwidget">
                                    <p>{!! $footer->footer !!}</p>
                                </div>
                            </section>
                        </div>
                    </div>
                    @endif
                    
                    @if($footer2->title)
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-latest-news" class="section">
                                <h2 class="h4">{!! $footer2->title !!}</h2>
                                <div class="textwidget">
                                    <p>{!! $footer2->footer !!}</p>
                                </div>
                            </section>
                        </div>
                    </div>
                    @endif
                    
                    @if($footer3->title)
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-newsletter" class="section">
                                <h2 class="h4">{!! $footer3->title !!}</h2>
                                <div class="textwidget">
                                    <p>{!! $footer3->footer !!}</p>
                                </div>
                            </section>
                        </div>
                    </div>
                    @endif
                    
                    @if($footer4->title)
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-newsletter" class="section">
                                <h2 class="h4">{{ $footer4->title }}</h2>
                                <div class="textwidget">
                                    <p>{!! $footer4->footer !!}</p>
                                </div>
                            </section>
                        </div>
                    </div>
                    @endif
                </div>
                
                <hr/>
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="text-muted">
                            Copyright &copy; {{ date('Y') }} 
                            <a href="{{ $company->website ?? '#' }}">{{ $company->company_name ?? 'Faveo' }}</a>. 
                            All rights reserved. Powered by <a href="http://www.faveohelpdesk.com/" target="_blank">Faveo</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('FooterInclude')
</body>
</html>
