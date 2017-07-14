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
        <ul class="sidebar-navigation">
            <li class="expandable menu-text"><a href="#">Bookmarks</a>
                <ul class="sub-menu">
                    <li><a href="/bookmarks/create">New</a></li>
                    <li><a href="">All</a></li>
                    <li><a href="">Unread</a></li>
                    <li><a href="">Archived</a></li>
                </ul>
            </li>
            <li class="menu-text"><a href="#">Categories</a></li>
            <li class="menu-text"><a href="#">Account</a></li>
            <li class="menu-text"><a href="#">Discover</a></li>
        </ul>
    </nav>

</aside>

<section id="main-content">
    <header id="main-header">
        <nav class="search-bar medium-6">
            <form method="POST" action="{{url('search')}}">
                <input type="text" name="search" placeholder="Search..."/>
            </form>
        </nav>
    </header>

    <div class="content">
        @yield('content')
    </div>
</section>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
