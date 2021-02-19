<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ $settings->site_name }}</title>

<!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
    @yield('content')
    @yield('scripts')
</body>
</html>
