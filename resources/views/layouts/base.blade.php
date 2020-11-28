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
                            {{Auth::user()->name}}
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
                                    <a id="find-store" href="\home">Find store</a>
                            </li>
                            <li class="nav-option">
                                    <a id="placaments" href="">My placements</a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 3)
                            <li class="nav-option">
                                    <a id="store-parameters" href="\manager\dashboard">Store parameters</a>
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
                                    <a id="add-store" href="\admin\dashboard\add_store">Add store</a>
                            </li>
                            <li class="nav-option">
                                    <a id="add-managers" href="\admin\dashboard\add_manager">Add managers</a>
                            </li>
                        @endif
                        <li class="nav-option">
                                <a id="settings" href="\user_profile\edit">Settings</a>
                        </li>
                        <li class="nav-option">
                            <a id="logout" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

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
