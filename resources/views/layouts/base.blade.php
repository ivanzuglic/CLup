<!-- Base HTML template that is inherited by all other templates. -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/CLupFavicon.png') }}" tyoe="image/gif" sizes="16x16">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        @section('header')
            <header>
                <button id="toggle-nav" class="toggle-nav-btn" type="button"></button>
                <div class="logo">
                    <img src="{{ asset('images/CLupLogoFinal.png') }}" alt="CLup">
                </div>
                @if (Auth::check())
                    <div class="user-info">
                        <div class="user-image"></div>
                        <h2 class="user-name">
                            Username
                        </h2>
                    </div>
                @endif
            </header>
        @show

        @section('navbar')
            @if (Auth::check())
                <nav id="nav">
                    <ul class="nav-container">
                        @if (Auth::user()->role_id == 2)
                            <li class="nav-option">
                                    <a id="find-store" href="">Find store</a>
                            </li>
                            <li class="nav-option">
                                    <a id="placaments" href="">My placaments</a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 3)
                            <li class="nav-option">
                                    <a id="store-parameters" href="">Store parameters</a>
                            </li>
                            <li class="nav-option">
                                    <a id="print-tickets" href="">Print tickets</a>
                            </li>
                            <li class="nav-option">
                                    <a id="store-statistics" href="">Store statistics</a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 1)
                            <li class="nav-option">
                                    <a id="add-store" href="">Add store</a>
                            </li>
                            <li class="nav-option">
                                    <a id="add-managers" href="">Add managers</a>
                            </li>
                        @endif
                        <li class="nav-option">
                                <a id="settings" href="">Settings</a>
                        </li>
                        <li class="nav-option">
                                <a id="logout" href="">Logout</a>
                        </li>
                    </ul>
                </nav>
            @endif
        @show

        <main>
            @yield('main')
        </main>

        @yield('javascripts')
    </body>
</html>