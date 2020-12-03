@extends('layouts.base')

@section('title','Manager View')

@section('main')
<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Store Max. Occupancy and Resrevation Ratio</h2>
    </div>
    <form method="POST" action = "{{route('stores.update',$store->store_id)}}" class="form-inline" id="store-parameters">
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

        <div class="form-control">
            <button type="submit" class="btn medium">
            <span>Submit</span>
            </button>
        </div>
    </form>
</div>

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Store Workhours</h2>
    </div>
    <form method="POST" action = "{{route('working_hours.bulk_CUD',$store->store_id)}}" class="form-inline" id="store-workhours">
        @csrf
        {{--@method('PATCH')--}}
        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Monday" name="days_selected[]" value="0" {{ $checkbox[0] }}>
            <label class="form-check-label" for="Monday">Monday</label>

            <div class="time-input">
                <input type="time" id="mon-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[0] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="mon-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[0] }}">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Tuesday" name="days_selected[]" value="1" {{ $checkbox[1] }}>
            <label class="form-check-label" for="Tuesday">Tuesday</label>

            <div class="time-input">
                <input type="time" id="tue-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[1] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="tue-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[1] }}">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Wednesday" name="days_selected[]" value="2" {{ $checkbox[2] }}>
            <label class="form-check-label" for="Wednesday">Wednesday</label>

            <div class="time-input">
                <input type="time" id="wed-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[2] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="wed-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[2] }}">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Thursday" name="days_selected[]" value="3" {{ $checkbox[3] }}>
            <label class="form-check-label" for="Thursday">Thursday</label>

            <div class="time-input">
                <input type="time" id="thu-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[3] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="thu-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[3] }}">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Friday" name="days_selected[]" value="4" {{ $checkbox[4] }}>
            <label class="form-check-label" for="Friday">Friday</label>

            <div class="time-input">
                <input type="time" id="fri-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[4] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="fri-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[4] }}">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Saturday" name="days_selected[]" value="5" {{ $checkbox[5] }}>
            <label class="form-check-label" for="Saturday">Saturday</label>

            <div class="time-input">
                <input type="time" id="sat-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[5] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="sat-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[5] }}">
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Sunday" name="days_selected[]" value="6" {{ $checkbox[6] }}>
            <label class="form-check-label" for="Sunday">Sunday</label>

            <div class="time-input">
                <input type="time" id="sun-opening-picker" class="form-control" placeholder="Select time" name="opening_hours[]" value="{{ $opening_hours[6] }}">
                <h3>&nbsp;&nbsp;to&nbsp;&nbsp;</h3>
                <input type="time" id="sun-closing-picker" class="form-control" placeholder="Select time" name="closing_hours[]" value="{{ $closing_hours[6] }}">
            </div>
        </div>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>Submit</span>
            </button>
        </div>
    </form>
</div>



@endsection
