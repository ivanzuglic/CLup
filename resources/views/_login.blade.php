<!-- Markup for the application's login page -->

@extends('layouts.base')

@section('title', 'Login')

@section('main')
    <section class="form login widget">
        <form method="post">
            <label for="inputUsername">Username: </label>
            <input type="text" name="username" placeholder="Username" id="inputUsername" class="textbox" required autofocus>
            <label for="inputPassword">Password: </label>
            <input type="text" name="password" placeholder="Password" id="inputPassword" class="textbox" required autofocus>

            <button class="btn btn-medium" type="submit">
                Login
            </button>
            <div>
                or <a href="">Register an account</a>
            <div>
        </form>
    <section>
@endsection