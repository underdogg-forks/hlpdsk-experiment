<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Faveo HELPDESK Installer">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Faveo HELPDESK - Installer')</title>
    
    <!-- CoreUI CSS -->
    <link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    @yield('HeadInclude')
    
    <style>
        body {
            background-color: var(--body-bg);
        }
        
        .installer-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .installer-card {
            width: 100%;
            max-width: 800px;
        }
        
        .installer-header {
            background: linear-gradient(135deg, var(--primary), var(--info));
            color: white;
            padding: 30px;
            border-radius: 0.25rem 0.25rem 0 0;
        }
        
        .installer-header h1 {
            margin: 0;
            font-size: 2rem;
        }
        
        .installer-step {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .installer-step:last-child {
            border-bottom: none;
        }
        
        .installer-step-number {
            width: 40px;
            height: 40px;
            background-color: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
        }
        
        .installer-step.active .installer-step-number {
            background-color: var(--success);
        }
        
        .installer-step.completed .installer-step-number {
            background-color: var(--success);
        }
        
        .installer-step.completed .installer-step-number::before {
            content: "\f00c";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }
    </style>
</head>

<body>
    <div class="installer-container">
        <div class="installer-card">
            <div class="installer-header">
                <h1><i class="fas fa-cogs"></i> Faveo HELPDESK Installer</h1>
                <p class="mb-0">Welcome to the installation wizard</p>
            </div>
            
            <div class="card">
                <div class="card-body p-4">
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
                            <i class="fa fa-ban"></i> <strong>Error!</strong> {{ session('fails') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-ban"></i> <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
            
            <div class="text-center mt-3">
                <p class="text-muted">
                    Copyright &copy; {{ date('Y') }} 
                    <a href="http://www.faveohelpdesk.com/" target="_blank">Faveo HELPDESK</a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('FooterInclude')
</body>
</html>
