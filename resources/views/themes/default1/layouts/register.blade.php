<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Support Center - Register">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Support Center - Register')</title>
    
    <!-- CoreUI CSS -->
    <link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    @yield('HeadInclude')
    
    <style>
        body {
            background-color: var(--body-bg);
        }
        
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-card {
            width: 100%;
            max-width: 500px;
        }
        
        .register-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-logo h1 {
            font-size: 2.5rem;
            margin: 0;
            color: var(--body-color);
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="card">
                <div class="card-body p-4">
                    <?php
                        $company = App\Model\helpdesk\Settings\Company::where('id', '=', '1')->first();
                        $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();
                    ?>
                    
                    <div class="register-logo mb-4">
                        @if($company && $company->use_logo == 1)
                            <img src="{{ asset('lb-faveo/dist/'.$company->logo) }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
                        @else
                            <h1>
                                @if($system && $system->name)
                                    {!! $system->name !!}
                                @else
                                    <b>Faveo</b> HELP DESK
                                @endif
                            </h1>
                        @endif
                    </div>
                    
                    <!-- Alert Messages -->
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session()->has('fails'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Error!</strong> {{ session('fails') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Please fix the following errors:</strong>
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
            
            <div class="text-center mt-3">
                <p class="text-muted">
                    Already have an account? <a href="{{ url('auth/login') }}">Login here</a>
                </p>
            </div>
        </div>
    </div>
    
    <footer class="text-center py-3 position-fixed" style="bottom: 0; width: 100%;">
        <p class="text-muted mb-0">
            Copyright &copy; {{ date('Y') }} 
            <a href="{{ $company->website ?? '#' }}">{{ $company->company_name ?? 'Faveo' }}</a>.
        </p>
    </footer>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('FooterInclude')
</body>
</html>
