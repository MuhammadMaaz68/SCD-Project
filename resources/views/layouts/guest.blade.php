<!-- {{-- 
    Layout: Guest Layout
    Description: The layout wrapper for guest views (Login, Register).
    Includes:
    - Centered card design
    - Application logo highlighting
--}} -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Scripts -->
    <style>
        body {
            background: radial-gradient(circle at top left, #1a1a40, #0a0a1a) !important;
            color: #f5f5f5;
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
        }
        .card-custom {
            background: #ffffff;
            color: #333;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
    </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-5">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-light" style="width: 80px; height: 80px;" />
                </a>
            </div>

            <div class="w-100 px-4 py-4 card-custom" style="max-width: 450px;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
