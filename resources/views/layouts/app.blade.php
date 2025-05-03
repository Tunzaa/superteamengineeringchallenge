<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config("app.name")}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background: #0d6efd;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-3">
        <h4 class="text-white mb-0">{{config('app.name', 'Tunzaa Mauzo')}}</h4>
        <small class="text-light"><i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}</small>
    
        <ul class="nav nav-pills flex-column my-4">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link text-white">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="nav-link text-white">
                    <i class="fas fa-box me-2"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('sales.index') }}" class="nav-link text-white">
                    <i class="fas fa-chart-line me-2"></i> Sales
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" class="nav-link text-white">
                    <i class="fas fa-tags me-2"></i> Categories
                </a>
            </li>
        </ul>
    
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    
        <hr class="border-light mt-4">
        <div class="text-white small">
            &copy; {{ date('Y') }} {{config('app.name', 'Tunzaa Mauzo')}}. All Rights Reserved.
        </div>
    </aside>
    

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
