@extends('layouts.base')

@section('title','User Edit')

@section('main')
    <div class="form widget widget-medium">
        <div class="widget-header title-only">
            <h2 class="widget-title">Change Your Credentials</h2>
        </div>
        <form method="post" action="{{route('profile.update', $user)}}">
            @csrf
            @method('PATCH')

            <div>
                <label for="Name" class="col-md-4 col-form-label text-md-right">
                    {{ __('Name') }}:</label><br />
                <input id="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                       value="{{$user->name}}" placeholder="{{$user->name}}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <label for="Email" class="col-md-4 col-form-label text-md-right">
                    {{ __('Email') }}:</label><br />
                <input id="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                       value="{{$user->email}}" placeholder="{{$user->email}}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number:</label><br/>
                <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number"
                       value="{{$user->phone_number}}" placeholder="{{$user->phone_number}}">
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>
            <br>

            <div class="form-control">
                <button type="submit" class="btn medium">
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>

    <div class="form widget widget-medium">
        <div class="widget-header title-only">
            <h2 class="widget-title">Change Your Password</h2>
        </div>
        <form method="post" action="{{route('profile.updatePassword', $user)}}">
            @csrf
            @method('PATCH')

            <div>
                <label for="password" class="col-md-4 col-form-label text-md-right">
                    {{ __('Password') }}:</label><br />
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                       placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <label for="password_confirm" class="col-md-4 col-form-label text-md-right">
                    {{ __('Confirm Password') }}:</label><br />
                <input id="password_confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation"
                       placeholder="Confirm Password" required>

            </div>

            <div class="form-single-checkbox">
                <input type="checkbox" onclick="showPasswords()">
                <span class="checkbox-label">Check Match</span>
            </div>
            <br>

            <div class="form-control">
                <button type="submit" class="btn medium">
                    <span>Update</span>
                </button>
            </div>
        </form>

    </div>

    <body>
        <script>function showPasswords() {
                var password = document.getElementById("password");
                var password_confirm = document.getElementById("password_confirm")
                if (password.type === "password") {
                    password.type = "text";
                    password_confirm.type = "text";
                } else {
                    password.type = "password";
                    password_confirm.type = "password";
                }
            }
        </script>
    </body>
@endsection
