<!-- Base HTML template that is inherited by all other templates. -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="icon" href="CLupFavicon.png" tyoe="image/gif" sizes="16x16">
    </head>

    <body>
        @section('header')
            <header>
                <button id="toggle-nav" class="toggle-nav-btn" type="button"><span></span></button>
                <div class="logo">
                    <img src="public/images/CLupLogoFinal.png" alt="CLup">
                </div>
                <div class="user-info">
                    <div class="user-image" data-first-two-letters="{{app.user.username|slice(0,2)|upper}}"></div>
                    <span class="user-name">
                    </span>
                </div>
            </header>
        @show

        @section('navbar')
            <ul class="nav-container">
                <li class="nav-option" id="find-store">
                    <a href="">Find store</a>
                </li>
            </ul>
        @show

        <main>
            @yield('main')
        </main>

        @yield('javascripts')
    </body>
</html>