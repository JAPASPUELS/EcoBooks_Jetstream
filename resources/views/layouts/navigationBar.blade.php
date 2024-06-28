<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <!-- ==================CSS======================== -->
    <link rel="stylesheet" href="{{ asset('css/nav_bar.css') }}">
    <!-- =====Boxicons CSS===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!-- =====FontAwesome CSS===== -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>@yield('title', 'EcoBooks Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @include('components.dashboard-navigation')

    <section class="home">
        @yield('content')
    </section>

    <script src="{{ asset('js/bar.js') }}"></script>
    @livewireScripts
    @stack('modals')
    @stack('scripts')
</body>

</html>