@extends('layouts.base')

@section('title','Store Add')

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
            <label for="StoreType" class="col-md-4 col-form-label text-md-right">
                <span class="required-fields">*</span>{{ __('Store Type') }}:</label><br />
            <div class="md-form mt-0">
                <input class="form-control" type="text" placeholder="Search Store Types" aria-label="Search">

            </div>
        </div>


        <div>
            <label for="AddressLine1" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Address Line 1') }}:</label><br />
            <input id="AddressLine1" type="text"
                class="form-control{{ $errors->has('AddressLine1') ? ' is-invalid' : '' }}" name="AddressLine1"
                value="{{ old('AddressLine1') }}" placeholder="Address Line 1" required autofocus>

        </div>

        <div>
            <label for="AddressLine2" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Address Line 2') }}:</label><br />
            <input id="AddressLine2" type="text"
                class="form-control{{ $errors->has('AddressLine2') ? ' is-invalid' : '' }}" name="AddressLine2"
                value="{{ old('AddressLine2') }}" placeholder="Address Line 2" required autofocus>

        </div>

        <div>
            <label for="StoreTown" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Town') }}:</label><br />
            <input id="StoreTown" type="text" class="form-control{{ $errors->has('StoreTown') ? ' is-invalid' : '' }}"
                name="StoreTown" value="{{ old('StoreTown') }}" placeholder="Town" required autofocus>

        </div>

        <div>
            <label for="StoreZip" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('ZIP Code') }}:</label><br />
            <input id="StoreZip" type="text" class="form-control{{ $errors->has('StoreZip') ? ' is-invalid' : '' }}"
                name="StoreZip" value="{{ old('StoreZip') }}" placeholder="ZIP Code" required autofocus>

        </div>

        <div>
            <label for="StoreCountry" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Country') }}:</label><br />
            <input id="StoreCountry" type="text"
                class="form-control{{ $errors->has('StoreCountry') ? ' is-invalid' : '' }}" name="StoreCountry"
                value="{{ old('StoreCountry') }}" placeholder="Country" required autofocus>

        </div>



        <div>
            <label for="StoreDescription" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store Description') }}:</label><br />
            <input id="StoreDescription" type="text"
                class="form-control{{ $errors->has('StoreDescription') ? ' is-invalid' : '' }}" name="StoreDescription"
                value="{{ old('StoreDescription') }}" placeholder="Store Description" required autofocus>

        </div>

        <div>
            <label for="StoreMaxOccupancy" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Max Occupancy') }}:</label><br />
            <input id="StoreMaxOccupancy" type="text"
                class="form-control{{ $errors->has('StoreMaxOccupancy') ? ' is-invalid' : '' }}"
                name="StoreMaxOccupancy" value="{{ old('StoreMaxOccupancy') }}" placeholder="Max Occupancy" required
                autofocus>

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