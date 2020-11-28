@extends('layouts.base')

@section('title','addManager')

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
            <label for="Surname" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Surname') }}:</label><br />
            <input id="Surname" type="text" class="form-control{{ $errors->has('Surname') ? ' is-invalid' : '' }}"
                name="Surname" value="{{ old('Surname') }}" placeholder="Surname" required autofocus>
            @if ($errors->has('Surname'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Surname') }}</strong>
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
            <label for="Store" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store') }}:</label><br />
            <div class="md-form mt-0">
                <input class="form-control" type="text" placeholder="Search Available Stores" aria-label="Search">

            </div>
        </div>

        <br>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>{{ __('Register') }}<span>
            </button>
            <span class="required-fields">* Required fields</span>
        </div>

    </form>
</div>

@endsection