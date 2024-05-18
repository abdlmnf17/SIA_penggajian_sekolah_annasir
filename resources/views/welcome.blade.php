<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #201f1e;

        }

        .navbar {
            background-color: #3498db;
        }

        .navbar-brand {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .welcome-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;

        }

        .welcome-card {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(248, 200, 10, 0.968);
            background-color: #201f1e;
        }

        .welcome-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .welcome-links a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #ffffff;
            font-weight: bold;
        }
    </style>
</head>

<body>


    <div class="welcome-container">
        <div class="welcome-card">
            <div class="text-center">
                <img src="https://www.svgrepo.com/show/495136/card-send.svg" alt="Logo" class="welcome-logo">
                <p class="text-center text-white">{{ config('app.name', 'Laravel') }}<br />

            </div>

            <p class="text-center text-white">{{ config('app.nama_sekolah', 'Laravel') }}<br />

            </p>
            <div class="welcome-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-warning">Masuk Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning">Masuk</a>
                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                        @endif --}}
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
