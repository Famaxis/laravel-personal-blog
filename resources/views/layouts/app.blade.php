<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/selectize.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">--}}
    <link href="https://unpkg.com/papercss@1.8.2/dist/paper.min.css" rel="stylesheet">
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/add.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div class="paper container container-lg" id="app">

    @auth
        <nav class="border row flex-edges">
            <!-- Left Side Of Navbar -->
            <div class="col">
                <div class="nav-brand">
                    <h4><a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></h4>
                </div>
                <div class="collapsible">
                    <input id="collapsible2" type="checkbox" name="collapsible2">
                    <label for="collapsible2">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </label>
                    <div class="collapsible-body">
                        <ul class="inline">
                            <li><a href="{{ route('post.create') }}">New post</a></li>
                            <li><a href="{{ route('posts') }}">Posts</a></li>
                            <li><a href="{{ route('comments') }}">Comments</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Right Side Of Navbar -->
            <div class="col">
                <img src="/avatar/{{ Auth::user()->avatar }}" style="max-width: 50px; margin-right: 1em;">
                <ul class="inline">
                    <li>{{ Auth::user()->name }}</li>
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </nav>
    @endauth

    <main class="py-4">
        @yield('content')
    </main>
</div>
@yield('scripts')
</body>
</html>
