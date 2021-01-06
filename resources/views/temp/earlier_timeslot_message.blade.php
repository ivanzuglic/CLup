@extends('layouts.base')

@section('title','Earlier Timeslot Response')

@section('main')
    <div class="widget widget-medium information-widget">
        @if($improvement == true)
            <div class="widget-header title-only">
                <h2 class="widget-title success-title">Earlier Timeslot Available!</h2>
            </div>
            <div class="widget-content">
                <div class="information-msg">
                    <span align="center"><br>There is an earlier timeslot available.</span>
                </div>
                <div class="information-msg">
                    <span align="center">
                        <strong>{{ date("H:i", strtotime($best_free_timeslot['start'])) }} - {{ date("H:i", strtotime($best_free_timeslot['end'])) }}</strong>
                    </span>
                </div>
                <div>
                    <form method="POST" action="{{ route('appointment.pushForwardQueue', $appointment->appointment_id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="new_start_time" value="{{ $best_free_timeslot['start'] }}" />
                        <input type="hidden" name="new_end_time" value="{{ $best_free_timeslot['end'] }}" />
                        <button type="submit" class="btn medium"><span>Accept</span></button>
                    </form>
                    <form method="GET" action="{{ route('placements', Auth::id()) }}">
                        <button type="submit" class="btn medium" style="background-color: #ff0f0f"><span>Decline</span></button>
                    </form>
                </div>
            </div>
        @else
            <div class="widget-header title-only">
                <h2 class="widget-title error-title">No Earlier Timeslots Available!</h2>
            </div>
            <div class="widget-content">
                <div class="information-msg">
                    <span align="center"><br>Unfortunately, there are currently no earlier timeslots available. Check again later.</span>
                </div>
                <div>
                    <form method="GET" action="{{ route('placements', Auth::id()) }}">
                        <button type="submit" class="btn medium"><span>OK</span></button>
                    </form>
                </div>
            </div>

        @endif
    </div>

@endsection
