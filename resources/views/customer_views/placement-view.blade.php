@extends('layouts.base')

@section('title','Placement View')

@section('main')
<div class="form widget widget-extra-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Queue Placements</h2>
    </div>
    <div class="placement-container">
        @foreach($queues as $queue)
            <div class="placement @if((strtotime("now") - strtotime($queue->created_at)) <= 30) new-placament @endif">
                <div class="placement-details">
                    <section class="store-name">
                        Store name:&nbsp;<span>{{ $queue->store->name }}[{{ $queue->store_id }}]</span>
                    </section>
                    <section class="reservation-time">
                        Reservation Time:&nbsp;<span>{{ date('H:i', strtotime($queue->start_time)) }} - {{ date('H:i', strtotime($queue->end_time)) }}</span>
                    </section>
                    <section class="ETA">
{{--                        try: {{date('H:i', 3600)}}--}}
{{--                        now: {{strtotime("now")}}--}}
{{--                        app now: {{strtotime($queue->start_time)}}--}}
{{--                        diff: {{(strtotime($queue->start_time) - strtotime("now"))}}--}}

                        ETA:&nbsp;<span>{{ date('H:i',(strtotime($queue->start_time) - strtotime("now")-3600)) }}</span>
                    </section>
                </div>
                <div class="placement-actions">
                    <button href="" class="btn medium"><span>View</span></button>
{{--                    <form method="GET" action="{{route('removeFromQueue', $reservation->appointment_id)}}">--}}
{{--                        @csrf--}}
{{--                        @method('PATCH')--}}
                        <a href="/removeFromQueue/{{$queue->appointment_id}}" type="button" class="btn medium" ><span>Delete</span></a>
{{--                    </form>--}}
                </div>
            </div>
            <div class="divider"></div>
        @endforeach
    </div>
</div>

<div class="form widget widget-extra-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Reservations</h2>
    </div>
    <div class="placement-container">
        @foreach($reservations as $reservation)
            <div class="placement @if((strtotime("now") - strtotime($reservation->created_at)) <= 30) new-placament @endif">
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
                    <button href="" class="btn medium"><span>View</span></button>
                    <form method="post" action="{{route('appointment.removeReservation', $reservation->appointment_id)}}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn medium" ><span>Delete</span></button>
                    </form>
                </div>
            </div>
            <div class="divider"></div>
        @endforeach
    </div>
</div>
@endsection
