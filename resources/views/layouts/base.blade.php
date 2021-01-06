<!-- Base HTML template that is inherited by all other templates. -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <link title="base-styling" rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link title="timeline-styles" rel="stylesheet" href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">


    </head>

    <body>
        @section('header')
            <header>
                @if (Auth::check())
                    <button id="toggle-nav" class="toggle-nav-btn" type="button"></button>
                @endif
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
                                    <a id="find-store" href="\home">Find Store</a>
                            </li>
                            <li class="nav-option">
                                    <a id="placaments" href="\user\{{ Auth::id() }}\placements">My Placements</a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 3)
                            <li class="nav-option">
                                    <a id="store-parameters" href="\manager\dashboard\store_parameters\{{ Auth::user()->store_id }}">Store Parameters</a>
                            </li>
                            <li class="nav-option">
                                    <a id="print-tickets" href="\manager\dashboard\print_tickets\{{ Auth::user()->store_id }}">Print Tickets</a>
                            </li>
                            <li class="nav-option">
                                    <a id="store-statistics" href="">Store Statistics</a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 1)
                            <li class="nav-option">
                                    <a id="add-store" href="\admin\dashboard\add_store">Add Store</a>
                            </li>
                            <li class="nav-option">
                                    <a id="add-managers" href="\admin\dashboard\add_manager">Add Managers</a>
                            </li>
                        @endif
                        <li class="nav-option">
                                <a id="settings" href="\profile\edit">Settings</a>
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

        @if(Auth::check())
            <main>
        @else
            <main class="no-nav">
        @endif
            @yield('main')
        </main>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
    </body>
</html>
