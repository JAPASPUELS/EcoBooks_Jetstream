<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <!-- ==================CSS======================== -->
    <link rel="stylesheet" href="{{ asset('css/nav_bar.css') }}">
    <!-- =====Boxicons CSS===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <!-- =====FontAwesome CSS===== -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <title>@yield('title', 'EcoBooks Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
    </div>
    
    @include('components.dashboard-navigation')

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Eco-Limpieza "Económicos y Ecológicos"</span>
        </div>
        @yield('content')
    </section>

    <script src="{{ asset('js/bar.js') }}"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @stack('modals')
    @stack('scripts')
</body>

</html>