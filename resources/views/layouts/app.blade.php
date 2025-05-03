
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tunzaa Mauzo</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 text-gray-900">
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