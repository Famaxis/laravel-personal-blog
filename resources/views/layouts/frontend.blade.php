<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

@yield('meta')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ $settings->site_name }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/garlic.min.js') }}"></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

<!-- Styles -->
{{--    <link href="https://unpkg.com/papercss@1.8.2/dist/paper.min.css" rel="stylesheet">--}}
    <link href="{{ asset('css/paper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors/' . $settings->main_template . '.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>

<div class="main">
    @auth
        @include('components.navbar')
    @endauth

    <div class="paper shadow container container-lg" id="app">
        <header class="paper container border">
            <h1><a href="{{ route('front.posts') }}"
                   @if(route('front.posts') == Request::url())
                   class="active"
                        @endif
                >{{ $settings->site_name }}</a></h1>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</div>

@include('components.footer')
@yield('scripts')
</body>
</html>
