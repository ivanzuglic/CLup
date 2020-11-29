@extends('layouts.base')

@section('title','Add Manager')

@section('main')
<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Adding Manager Form</h2>
    </div>
    <form method="POST">
        @csrf

        <div>
            <label for="Name" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Name') }}:</label><br />
            <input id="Name" type="text" class="form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" name="Name"
                value="{{ old('Name') }}" placeholder="Name" required autofocus>
            @if ($errors->has('Name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Name') }}</strong>
            </span>
            @endif
        </div>

        <div>
            <label for="Email" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Email') }}:</label><br />
            <input id="Email" type="email" class="form-control{{ $errors->has('Email') ? ' is-invalid' : '' }}"
                name="Email" value="{{ old('Email') }}" placeholder="Email" required autofocus>
            @if ($errors->has('Email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Email') }}</strong>
            </span>
            @endif
        </div>

        <div>
            <label for="password" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Password') }}:</label><br />
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                name="password" placeholder="Password" required>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div>
            <label for="Store ID" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store ID') }}:</label><br />
            <div class="md-form mt-0">
                <input class="form-control" type="text" placeholder="Store ID" aria-label="Search">

            </div>
        </div>

        <br>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>{{ __('Register') }}<span>
            </button>

        </div>

    </form>
</div>

@endsection