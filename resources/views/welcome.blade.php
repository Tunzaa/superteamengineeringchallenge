<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Tunzaa Mauzo</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }

            .welcome-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #1c1c1c;
                color: white;
            }

            .welcome-content {
                text-align: center;
                background: rgba(0, 0, 0, 0.6);
                padding: 30px;
                border-radius: 10px;
            }

            .welcome-content h1 {
                font-size: 3rem;
                font-weight: 500;
                margin-bottom: 20px;
            }

            .welcome-content p {
                font-size: 1.25rem;
                margin-bottom: 30px;
            }

            .btn-custom {
                background-color: #00c853;
                color: white;
                padding: 12px 30px;
                font-size: 1rem;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .btn-custom:hover {
                background-color: #1b5e20;
            }

            .footer {
                position: absolute;
                bottom: 10px;
                width: 100%;
                text-align: center;
                font-size: 0.875rem;
                color: #cccccc;
            }

        </style>
    </head>
    <body>

        <div class="welcome-container">
            <div class="welcome-content">
                <h1>Welcome to Tunzaa Mauzo</h1>
                <p>Your trusted platform for efficient sales tracking.</p>
                <a href="{{ route('login') }}" class="btn-custom">Login to Continue</a>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2025 Tunzaa Mauzo. All Rights Reserved.</p>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    </body>
</html>
