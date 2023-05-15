<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="page-container">
        @include('layouts.app.menu')
        <div class="page-content">
            @include('layouts.app.header')
            {{ $slot }}
            <div class="page-footer">
                <a href="crypto.html" class="page-footer-item page-footer-item-right"></a>
            </div>
        </div>
    </div>

    @include('layouts.app.activitiy')

    @include('layouts.app.search')

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</body>

</html>
