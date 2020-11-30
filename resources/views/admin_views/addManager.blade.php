@extends('layouts.base')

@section('title','Add Manager')

@section('main')
<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Adding Manager Form</h2>
    </div>
    <form method="POST" action="{{route('manager.create')}}">
        @csrf

        <div>
            <label for="Name" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Name') }}:</label><br />
            <input id="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                value="{{ old('name') }}" placeholder="Name" required autofocus>
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div>
            <label for="Email" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Email') }}:</label><br />
            <input id="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" value="{{ old('email') }}" placeholder="Email" required>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
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
            <label for="password_confirm" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Confirm Password') }}:</label><br />
            <input id="password_confirm" type="password" class="form-control{{ $errors->has('password_confirm') ? ' is-invalid' : '' }}"
                   name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <div>
            <label for="Store ID" class="col-md-4 col-form-label text-md-right">
                <span class="required-fields">*</span>{{ __('Store ID') }}:</label><br />
            <div class="md-form mt-0">
                <select name="store_id" class="form-control" >
                    @foreach($stores as $store)
                        <option class="form-control" value="{{$store->store_id}}">{{$store->name}} (id: {{$store->store_id}})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <br/>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>Add</span>
            </button>

        </div>
    </form>
</div>

@endsection
