<nav class="shadow">
    <div class="nav-inner">
        <div class="">
            <!-- Left Side Of Navbar -->
            <div class="nav-brand">
                <h4><a href="{{ url('/') }}">{{ $settings->site_name }}</a></h4>
            </div>
            <ul class="">
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
                <li><a href="{{ route('pages')}}"
                       @if(route('pages') == Request::url())
                       class="active"
                            @endif
                    >Pages</a></li>
                <li><a href="{{ route('tags')}}"
                       @if(route('tags') == Request::url())
                       class="active"
                            @endif
                    >Tags</a></li>
                <li><a href="{{ route('templates')}}"
                       @if(route('templates') == Request::url())
                       class="active"
                            @endif
                    >Templates</a></li>
                <li><a href="{{ route('settings') }}"
                       @if(route('settings') == Request::url())
                       class="active"
                            @endif
                    >Settings</a></li>
            </ul>

        </div>
        <!-- Right Side Of Navbar -->
        <div class="">
            <img src="/avatar/{{ Auth::user()->avatar }}" class="profile-image">
            <ul>
                <li><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>


</nav>
