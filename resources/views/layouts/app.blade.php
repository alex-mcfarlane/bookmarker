<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/bower/foundation/css/foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<aside id="main-sidebar">
    <div id="nav-icon-wrapper">
        <div id="nav-icon">
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>

    <nav>
        <ul class="menu sidebar-navigation">
            <li class="expandable">
                <a href="#">
                    <div class="icon-container">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <span class="menu-text">Bookmarks</span>
                </a>

                <ul class="menu sub-menu">
                    <li><a href="/bookmarks/create">New</a></li>
                    <li><a href="/bookmarks?read=0">Unread</a></li>
                    <li><a href="/bookmarks?read=1">Archived</a></li>
                    <li><a href="/bookmarks">All</a></li>
                </ul>
            </li>
            <li class="expandable">
                <a href="#">
                    <div class="icon-container">
                        <i class="fa fa-tags"></i>
                    </div>

                    <span class="menu-text">Categories</span>
                </a>

                <ul class="menu sub-menu">
                    <li><a href="/categories/create">New</a></li>
                    <li><a href="">All</a></li>
                    <li><a href="">Unread</a></li>
                    <li><a href="">Archived</a></li>
                </ul>
            </li>
            <li class="expandable">
                <a href="#">
                    <div class="icon-container">
                        <i class="fa fa-binoculars"></i>
                    </div>

                    <span class="menu-text">Discover</span>
                </a>

                <ul class="menu sub-menu">
                    <li><a href="/bookmarks/create">New</a></li>
                    <li><a href="">All</a></li>
                    <li><a href="">Unread</a></li>
                    <li><a href="">Archived</a></li>
                </ul>
            </li>
            <li class="expandable">
                <a href="#">
                    <div class="icon-container">
                        <i class="fa fa-address-card-o"></i>
                    </div>

                    <span class="menu-text">Account</span>
                </a>

                <ul class="menu sub-menu">
                    <li><a href="/bookmarks/create">New</a></li>
                    <li><a href="">All</a></li>
                    <li><a href="">Unread</a></li>
                    <li><a href="">Archived</a></li>
                </ul>
            </li>

        </ul>
    </nav>

</aside>

<section id="main-content">
    <header id="main-header">
        <div class="row">

            <nav class="main-nav medium-6 column">
                <ul class="menu">
                    <li><a href="/home">Home</a></li>
                    <li><a href="/home">Discover</a></li>
                </ul>
            </nav>

            <nav class="search-bar medium-6 column">
                <form method="POST" action="{{url('search')}}">
                    <input type="text" name="search" placeholder="Search..."/>
                </form>
            </nav>

        </div>

    </header>

    <div class="content">
        @yield('content')
    </div>
</section>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
