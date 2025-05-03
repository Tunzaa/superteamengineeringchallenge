
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tunzaa Mauzo</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            /* Global styles */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f8f9fa;
                color: #333;
            }

            /* Container styles */
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 30px;
            }

            /* Heading styles */
            h1 {
                font-size: 2.5rem;
                font-weight: bold;
                margin-bottom: 20px;
                color: #007bff;
            }

            /* Button styles */
            .btn {
                display: inline-block;
                padding: 10px 20px;
                font-size: 1rem;
                text-align: center;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .btn-primary {
                background-color: #007bff;
                color: white;
                border: none;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .btn-sm {
                font-size: 0.875rem;
                padding: 6px 12px;
            }

            .btn-warning {
                background-color: #ffc107;
                color: white;
                border: none;
            }

            .btn-warning:hover {
                background-color: #e0a800;
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
                border: none;
            }

            .btn-danger:hover {
                background-color: #c82333;
            }

            /* Alert styles */
            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 5px;
            }

            .alert-success {
                background-color: #28a745;
                color: white;
            }

            /* Table styles */
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 30px;
                background-color: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .table thead {
                background-color: #f1f1f1;
            }

            .table th,
            .table td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .table th {
                font-weight: bold;
                color: #555;
            }

            .table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .table tbody tr:hover {
                background-color: #f1f1f1;
            }

            .table .btn-sm {
                padding: 4px 8px;
            }

            /* Navigation styles */
            nav ul {
                padding-left: 0;
                list-style: none;
                margin-bottom: 30px;
            }

            nav ul li {
                display: inline;
                margin-right: 15px;
            }

            nav ul li a {
                font-size: 1rem;
                text-decoration: none;
                color: #007bff;
                transition: color 0.3s ease;
            }

            nav ul li a:hover {
                color: #0056b3;
            }

        </style>      
    </head>
    <body class="bg-gray-100 text-gray-900">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
        @endif

        <div class="min-h-screen">
            <header class="bg-white shadow p-4">
                <div class="container mx-auto flex justify-between items-center">
                    <h1 class="text-lg font-bold">Tunzaa ERP</h1>
                    <div>
                        @auth
                        <span class="mr-4">Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline">Logout</button>
                        </form>
                        @endauth
                    </div>
                </div>
            </header>

            <main class="py-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>