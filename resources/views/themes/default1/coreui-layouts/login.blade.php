<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Support Center - Login">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Support Center - Login')</title>
    
    <!-- CoreUI CSS -->
    <link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    @yield('HeadInclude')
    
    <style>
        body {
            background-color: var(--body-bg);
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo h1 {
            font-size: 2.5rem;
            margin: 0;
            color: var(--body-color);
        }
        
        .breadcrumb {
            width: 80%;
            margin: 20px auto;
        }
        
        .form-helper {
            margin-bottom: 50px;
            display: inline-block;
        }
        
        .site-hero {
            padding: 35px 0;
            padding-top: 1px !important;
            background: var(--primary) !important;
        }
    </style>
</head>

<body>
    <div id="page" class="hfeed site">
        <header id="masthead" class="site-header site-hero" role="banner">
            <div class="container">
                <?php
                    $company = App\Model\helpdesk\Settings\Company::where('id', '=', '1')->first();
                    $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();
                ?>
                
                <div class="login-logo py-4">
                    @if($company && $company->use_logo == 1)
                        <img src="{{ asset('lb-faveo/dist/'.$company->logo) }}" alt="Logo" class="img-fluid" style="max-width: 200px;">
                    @else
                        <h1 class="text-white">
                            @if($system && $system->name)
                                {!! $system->name !!}
                            @else
                                <b>SUPPORT</b> CENTER
                            @endif
                        </h1>
                    @endif
                </div>
            </div>
        </header>
        
        <div class="login-container">
            <div class="login-card">
                <!-- Alert Messages -->
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
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-ban"></i> <strong>Alert!</strong> Please check your input.
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('body')
                @yield('content')
            </div>
        </div>
        
        <footer class="text-center py-3">
            <div class="container">
                <p class="text-muted">
                    Copyright &copy; {{ date('Y') }} 
                    <a href="{{ $company->website ?? '#' }}">{{ $company->company_name ?? 'Faveo' }}</a>. 
                    Powered by <a href="http://www.faveohelpdesk.com/" target="_blank">Faveo</a>
                </p>
            </div>
        </footer>
    </div>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('FooterInclude')
</body>
</html>
