<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookVerse')</title>

    {{-- Bootstrap 5 + Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom Theme --}}
    <style>
        body {
            background: radial-gradient(circle at top left, #1a1a40, #0a0a1a);
            color: #f5f5f5;
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(90deg, #3a0ca3, #7209b7);
            box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }
        .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #ffd60a !important;
        }
        .btn-glow {
            background: linear-gradient(90deg, #7209b7, #3a0ca3);
            border: none;
            color: white;
            transition: all 0.3s;
        }
        .btn-glow:hover {
            transform: scale(1.05);
            box-shadow: 0 0 12px #7209b7;
        }
        footer {
            background: #0a0a1a;
            color: #bbb;
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #222;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('profile.partials.header')

    {{-- Content --}}
    <main class="py-4 container">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} <strong>BookVerse</strong> | Your Gateway to Stories</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>