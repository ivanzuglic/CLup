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
            <!-- Header markup goes here -->
        @show

        @section('navbar')
            <!-- Navbar markup goes here -->
        @show

        <main>
            @yield('main')
        </main>

        @yield('javascripts')
    </body>
</html>