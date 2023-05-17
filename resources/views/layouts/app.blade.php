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
    @yield('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="page-container">
        @include('layouts.app.menu')
        <div class="page-content">
            @include('layouts.app.header')
            {{ $slot }}
            @if (!route('login'))
                <div class="page-footer">
                    <a href="crypto.html" class="page-footer-item page-footer-item-right"></a>
                </div>
            @endif
        </div>
    </div>

    @include('layouts.app.activitiy')

    @include('layouts.app.search')

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('js')
</body>

</html>
