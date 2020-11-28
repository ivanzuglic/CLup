@extends('layouts.base')

@section('title','Add Store')

@section('main')

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Adding Store Form</h2>
    </div>
    <form method="POST">
        @csrf

        <div>
            <label for="StoreName" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store Name') }}:</label><br />
            <input id="StoreName" type="text" class="form-control{{ $errors->has('StoreName') ? ' is-invalid' : '' }}"
                name="StoreName" value="{{ old('StoreName') }}" placeholder="Store Name" required autofocus>
            @if ($errors->has('StoreName'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('StoreName') }}</strong>
            </span>
            @endif
        </div>



        <div>
            <label for="StoreType" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store Type') }}:</label><br />
            <div class="md-form mt-0">
                <input class="form-control" type="text" placeholder="Search Store Types" aria-label="Search">

            </div>
        </div>


        <div>
            <label for="StoreAdress" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store Adress') }}:</label><br />
            <input id="StoreAdress" type="text"
                class="form-control{{ $errors->has('StoreAdress') ? ' is-invalid' : '' }}" name="StoreAdress"
                value="{{ old('StoreAdress') }}" placeholder="Store Adress" required autofocus>

        </div>



        <div>
            <label for="StoreDescription" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store Description') }}:</label><br />
            <input id="StoreDescription" type="text"
                class="form-control{{ $errors->has('StoreDescription') ? ' is-invalid' : '' }}" name="StoreDescription"
                value="{{ old('StoreDescription') }}" placeholder="Store Description" required autofocus>

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
