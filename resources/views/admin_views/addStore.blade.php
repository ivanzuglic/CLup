@extends('layouts.base')

@section('title','Store Add')

@section('main')

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Adding Store Form</h2>
    </div>
    <form method="POST" action="{{route('stores.store')}}">
        @csrf

        <div>
            <label for="StoreName" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Store Name') }}:</label><br />
            <input id="StoreName" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                name="name" value="{{ old('name') }}" placeholder="Store Name" required autofocus>
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>



        <div>
            <label for="StoreType" class="col-md-4 col-form-label text-md-right">
                <span class="required-fields">*</span>{{ __('Store Type') }}:</label><br />
            <div class="md-form mt-0">
                <select name="store_type" class="form-control" >
                @foreach($store_types as $type)
                        <option class="form-control" value="{{$type->type_id}}">{{$type->store_type}}</option>
                @endforeach
                </select>
            </div>
        </div>


        <div>
            <label for="AddressLine1" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Address Line 1') }}:</label><br />
            <input id="AddressLine1" type="text"
                class="form-control{{ $errors->has('address_line_1') ? ' is-invalid' : '' }}" name="address_line_1"
                value="{{ old('address_line_1') }}" placeholder="Address Line 1" required autofocus>

        </div>

        <div>
            <label for="AddressLine2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}:</label><br />
            <input id="AddressLine2" type="text"
                class="form-control{{ $errors->has('address_line_2') ? ' is-invalid' : '' }}" name="address_line_2"
                value="{{ old('address_line_2') }}" placeholder="Address Line 2" autofocus>

        </div>

        <div>
            <label for="StoreTown" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Town') }}:</label><br />
            <input id="StoreTown" type="text" class="form-control{{ $errors->has('town') ? ' is-invalid' : '' }}"
                name="town" value="{{ old('town') }}" placeholder="Town" required autofocus>

        </div>

        <div>
            <label for="StoreZip" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('ZIP Code') }}:</label><br />
            <input id="StoreZip" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                name="zip_code" value="{{ old('zip_code') }}" placeholder="ZIP Code" required autofocus>

        </div>

        <div>
            <label for="StoreCountry" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Country') }}:</label><br />
            <input id="StoreCountry" type="text"
                class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country"
                value="{{ old('country') }}" placeholder="Country" required autofocus>

        </div>



        <div>
            <label for="StoreDescription" class="col-md-4 col-form-label text-md-right">{{ __('Store Description') }}:</label><br />
            <textarea id="StoreDescription" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
            name="description" placeholder="Store Description"  autofocus>{{ old('description') }}</textarea>
{{--            <input id="StoreDescription" type="text"--}}
{{--                class="form-control{{ $errors->has('StoreDescription') ? ' is-invalid' : '' }}" name="StoreDescription"--}}
{{--                value="{{ old('StoreDescription') }}" placeholder="Store Description" required autofocus>--}}

        </div>

        <div>
            <label for="StoreMaxOccupancy" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Max Occupancy') }}:</label><br />
            <input id="StoreMaxOccupancy" type="text"
                class="form-control{{ $errors->has('max_occupancy') ? ' is-invalid' : '' }}"
                name="max_occupancy" value="{{ old('max_occupancy') }}" placeholder="Max Occupancy" required
                autofocus>

        </div>

        <input type="hidden" name="current_occupancy" value="0">

        <br>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>{{ __('Register') }}</span>
            </button>

        </div>
    </form>
</div>
@endsection
