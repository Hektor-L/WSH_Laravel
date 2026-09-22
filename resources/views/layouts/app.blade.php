<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('WorkServiceHub-Logo-Icon.ico') }}" />
        <!-- Core theme CSS (includes Bootstrap)-->
        @vite(['resources/scss/custom.scss', 'resources/js/scripts.js'])
    </head>
    <body data-bs-theme="dark">
        @include('layouts.navigation')
        @yield('nav')
        @yield('content')
    </body>
    <script>
        sessionStorage.getItem('theme') === 'light' ? document.body.setAttribute('data-bs-theme', 'light') : document.body.setAttribute('data-bs-theme', 'dark');
    </script>
</html>