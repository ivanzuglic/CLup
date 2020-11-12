<!-- Markup for the application's register page -->

@extends('layouts.base')

@section('title', 'Register')

@section('main')
    <div class="form widget widget-medium">
        <div class="widget-header title-only">
            <h2 class="widget-title">Register Form</h2>
        </div>
        <form method="POST">
            @csrf

            <div>
                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="required-fields">*</span>{{ __('Name') }}:</label><br/>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <label for="email" class="col-md-4 col-form-label text-md-right"><span class="required-fields">*</span>{{ __('E-Mail Address') }}:</label><br/>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number:</label><br/>
                <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number">
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <label for="password" class="col-md-4 col-form-label text-md-right"><span class="required-fields">*</span>{{ __('Password') }}:</label><br/>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><span class="required-fields">*</span>{{ __('Confirm Password') }}:</label><br/>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <div class="form-control">
                <button type="submit" class="btn medium">
                    <span>{{ __('Register') }}<span>
                </button>
                <span class="required-fields">* Required fields</span>
            </div>

            <div>
                or <a href="{{ route('login') }}">Log into an existing account</a>
            </div>
        </form>
    </div>
@endsection