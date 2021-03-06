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

@include('layouts.sidebar')

<section id="main-content">
    <header id="main-header">
        <div class="row">

            <nav class="main-nav medium-6 column">
                <ul class="menu">
                    @if(Auth::user())
                        <li><a href="/home">Home</a></li>
                    @endif
                    <li><a href="/discover">Discover</a></li>
                    @if(Auth::user())
                        <li><a href="{{url('logout')}}">Logout</a></li>
                    @else
                        <li><a href="{{url('login')}}">Login</a></li>
                        <li><a href="{{url('register')}}">Register</a></li>
                    @endif
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
        <div class="row">
            <div class="column small-12 medium-10 large-8">
                @if(session()->has('success'))
                    <div class="alert-box success">
                        <p>{{session()->get('success')}}</p>
                    </div>
                @endif
            </div>
        </div>

        @yield('content')
    </div>
</section>

    <!-- Scripts -->
    <script src="{{ asset('js/autocomplete.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
