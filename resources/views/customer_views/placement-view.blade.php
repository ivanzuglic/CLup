@extends('layouts.base')

@section('title','Placement View')

@section('main')
<div class="form widget widget-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Queue Placements</h2>
    </div>
    <div class="placement-container">
{{--        @foreach--}}
{{--            <div class="placement">--}}
{{--                <div class="placement-details">--}}
{{--                    <section class="store-name">--}}
{{--                        Store name:&nbsp;<span>Placeholder</span>--}}
{{--                    </section>--}}
{{--                    <section class="ETA">--}}
{{--                        ETA:&nbsp;<span>Placeholder</span>--}}
{{--                    </section>--}}
{{--                    <section class="queue-length">--}}
{{--                        People in queue:&nbsp;<span>Placeholder</span>--}}
{{--                    </section>--}}
{{--                </div>--}}
{{--                <div class="placement-actions">--}}
{{--                    <a href="" class="btn medium"><span>View</span></a>--}}
{{--                    <a href="" class="btn medium"><span>Delete</span></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </div>
</div>

<div class="form widget widget-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Reservations</h2>
    </div>
    <div class="placement-container">
        @foreach($reservations as $reservation)
            <div class="placement">
                <div class="placement-details">
                    <section class="store-name">
                        Store name:&nbsp;<span>{{ $reservation->store->name }}[{{ $reservation->store_id }}]</span>
                    </section>
                    <section class="reservation-time">
                        Reservation Time:&nbsp;<span>{{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }}</span>
                    </section>
                    <section class="ETA">
                        Date:&nbsp;<span>{{ $reservation->date }}</span>
                    </section>
                </div>
                <div class="placement-actions">
                    <a href="" class="btn medium"><span>View</span></a>
                    <a href="/appointments/reservations/{{ $reservation->appointment_id }}" class="btn medium" ><span>Delete</span></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
