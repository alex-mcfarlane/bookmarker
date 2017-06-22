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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<aside id="main-sidebar">
    <a href="#">
        <div id="nav-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </a>
</aside>

<section id="main-content">
    <header id="main-header">
        <nav class="column">
            <ul class="navigation">
                <li><a href="/">Home</a></li>
                <li><a href="/">Bookmarks</a></li>
                <li><a href="/">Categories</a></li>
                <li><a href="/">Discover</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        @yield('content')
    </div>
</section>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
