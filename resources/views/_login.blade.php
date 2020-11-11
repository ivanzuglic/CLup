<!-- Markup for the application's login page -->

@extends('layouts.base')

@section('title', 'Login')

@section('main')
    <div class="form widget widget-medium">
        <form method="POST">
            @csrf

            <div>
                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}:</label><br/>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}:</label><br/>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="login-control">
                <button type="submit" class="btn medium">
                    <span>{{ __('Login') }}</span>
                </button>
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>

            <div>
                or <a href="">Register an account</a>
            <div>
        </form>
    </div>
@endsection