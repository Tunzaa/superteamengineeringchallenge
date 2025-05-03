<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Tunzaa Mauzo</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom background gradient */
        body {
            background: linear-gradient(135deg, #f7f7f7, #e3f2fd);
        }
        .hero {
            background: #007bff;
            color: white;
            border-radius: 15px;
            padding: 80px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-3 font-weight-bold">Welcome to Tunzaa Mauzo!</h1>
            <p class="lead">A simple solution for MSMEs to track sales, manage inventory, and grow your business with ease.</p>
            <a href="{{ route('login') }}" class="btn btn-danger btn-lg mt-4">Login to Your Account</a>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">What is Tunzaa Mauzo?</h5>
                            <p class="card-text text-muted text-center">
                                Tunzaa Mauzo is an easy-to-use sales tracking system designed specifically for MSMEs. It enables you to manage your inventory, track sales, and analyze business performance from anywhere.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row text-center mt-5">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Track Your Sales</h5>
                            <p class="card-text">Monitor sales performance and generate reports to help you make informed decisions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Manage Inventory</h5>
                            <p class="card-text">Easily manage stock levels, set reorder alerts, and avoid stockouts or overstocking.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Simple & Intuitive</h5>
                            <p class="card-text">Our user-friendly interface makes it easy for you to get started without any training.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h3 class="mb-4">About Tunzaa Mauzo</h3>
            <p class="lead text-muted">
                Tunzaa Mauzo is designed to help MSMEs track and manage their sales efficiently. The system is built with simplicity and accessibility in mind, giving you powerful tools without complexity.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 Tunzaa Mauzo. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
