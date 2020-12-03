@extends('layouts.base')

@section('title','Manager View')

@section('main')
<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Store Max. Occupancy and Reservation Ratio</h2>
    </div>
    <form method="POST" action = "{{route('stores.update',$store->store_id)}}" enctype="multipart/form-data" class="form-inline" id="store-parameters">
        @csrf
        @method('PATCH')
        <div>
            <label for="MaxOccupancy" class="col-md-4 col-form-label text-md-right">
                {{ __('Max Occupancy') }}:
            </label>
            <br/>
            <input id="MaxOccupancy" type="text"
                   class="form-control{{ $errors->has('MaxOccupancy') ? ' is-invalid' : '' }}" name="max_occupancy"
                   value="{{ $store->max_occupancy }}" required>
            @if ($errors->has('max_occupancy'))
                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('max_occupancy') }}</strong>
        </span>
            @endif
        </div>

        <div>
            <label for="ReservationRatio" class="col-md-4 col-form-label text-md-right">
                {{ __('Reservation Ratio') }}:
            </label>
            <br/>
            <input id="ReservationRatio" type="text"
                   class="form-control{{ $errors->has('ReservationRatio') ? ' is-invalid' : '' }}" name="max_reservation_ratio"
                   value="{{ $store->max_reservation_ratio }}" required>
            @if ($errors->has('max_reservation_ratio'))
                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('max_reservation_ratio') }}</strong>
        </span>
            @endif
        </div>

        <div>
            <label for="Image" class="col-md-4 col-form-label text-md-right">
                {{ __('Upload Image') }}:
            </label>
            <br/>
            <input id="Image" type="file"
                   class="form-control{{ $errors->has('Image') ? ' is-invalid' : '' }}" name="image_reference">
            @if ($errors->has('image_reference'))
                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('image_reference') }}</strong>
        </span>
            @endif
        </div>

        <div class="form-control">
            <button type="submit" class="btn medium">
            <span>Submit<span>
            </button>
        </div>
    </form>
</div>

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Store Workhours</h2>
    </div>
    <form method="POST" class="form-inline" id="store-workhours">
        @csrf
        @method('PATCH')
        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Monday">
            <label class="form-check-label" for="Monday">Monday</label>

            <div class="time-input">
                <input type="time" id="mon-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="mon-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Tuesday">
            <label class="form-check-label" for="Tuesday">Tuesday</label>

            <div class="time-input">
                <input type="time" id="tue-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="tue-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Wednesday">
            <label class="form-check-label" for="Wednesday">Wednesday</label>

            <div class="time-input">
                <input type="time" id="wed-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="wed-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Thursday">
            <label class="form-check-label" for="Thursday">Thursday</label>

            <div class="time-input">
                <input type="time" id="thu-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="thu-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Friday">
            <label class="form-check-label" for="Friday">Friday</label>

            <div class="time-input">
                <input type="time" id="fri-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="fri-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Saturday">
            <label class="form-check-label" for="Saturday">Saturday</label>

            <div class="time-input">
                <input type="time" id="sat-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="sat-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Sunday">
            <label class="form-check-label" for="Sunday">Sunday</label>

            <div class="time-input">
                <input type="time" id="sun-opening-picker" class="form-control" placeholder="Select time">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="sun-closing-picker" class="form-control" placeholder="Select time">
            </div>
        </div>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>Submit<span>
            </button>
        </div>
    </form>
</div>



@endsection
