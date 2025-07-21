<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CodeLearn')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f0f2f5;
    }
    .navbar-container {
        position: sticky;
        top: 1rem;
        z-index: 1030;
    }
    .navbar-custom {
        background-color: #317a75;
    }

    /* Mengatur font link navbar agar lebih tipis */
    .navbar-custom .nav-link {
        font-weight: 400; /* 400 untuk ketebalan normal */
        font-size: 0.95rem; /* Sedikit lebih kecil */
        color: rgba(255, 255, 255, 0.85); /* Sedikit redup agar tidak terlalu mencolok */
    }
    .navbar-custom .nav-link:hover {
        color: #ffffff;
    }

    /* Mengembalikan garis bawah sederhana untuk link aktif */
    .navbar-custom .nav-link.active {
        font-weight: 500; /* Sedikit lebih tebal saat aktif */
        color: #ffffff;
        text-decoration: underline;
        text-underline-offset: 4px;
    }

    /* Menyesuaikan gaya tombol agar sesuai contoh */
    .btn-sign-in {
        border: 1px solid rgba(255, 255, 255, 0.8) !important;
        color: rgba(255, 255, 255, 0.8) !important;
        font-weight: 500;
        padding: 0.4rem 1.2rem;
    }
    .btn-sign-in:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff !important;
        border-color: #ffffff !important;
    }

    .btn-sign-up {
        background-color: #ffffff !important;
        color: #317a75 !important;
        font-weight: 500;
        padding: 0.4rem 1.2rem;
    }
    .btn-sign-up:hover {
        opacity: 0.9;
    }
</style>
    @stack('styles')
</head>

<body class="bg-white">

    @include('partials.user-navigation')

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
