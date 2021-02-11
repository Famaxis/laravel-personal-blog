<nav class="border row flex-edges">
    <!-- Left Side Of Navbar -->
    <div class="col">
        <div class="nav-brand">
            <h4><a href="{{ url('/') }}">{{ $settings->site_name }}</a></h4>
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
                    <li><a href="{{ route('posts.create')}}"
                           @if(route('posts.create') == Request::url())
                           class="active"
                                @endif
                        >New post</a></li>
                    <li><a href="{{ route('posts') }}"
                           @if(route('posts') == Request::url())
                           class="active"
                                @endif
                        >Posts</a></li>
                    <li><a href="{{ route('comments') }}"
                           @if(route('comments') == Request::url())
                           class="active"
                                @endif
                        >Comments</a></li>
                    <li><a href="{{ route('settings') }}"
                           @if(route('settings') == Request::url())
                           class="active"
                                @endif
                        >Settings</a></li>
                    <li><a href="{{ route('pages.create')}}"
                           @if(route('pages.create') == Request::url())
                           class="active"
                                @endif
                        >Pages</a></li>
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
