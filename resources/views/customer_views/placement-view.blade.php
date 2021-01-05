@extends('layouts.base')

@section('title','Placement View')

@section('main')
<div class="form widget widget-extra-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Queue Placements</h2>
    </div>
    <div class="placement-container">
        @foreach($queues as $queue)
            <div class="placement @if((strtotime("now") - strtotime($queue->updated_at)) <= 30) new-placament @endif">
                <div class="placement-details">
                    <section class="store-name">
                        Store: <span>{{ $queue->store->name }} [{{ $queue->store->address_line_1 }}, {{ $queue->store->town }}]</span>
                    </section>
                    <section class="reservation-time">
                        Time: <span>{{ date('H:i', strtotime($queue->start_time)) }} - {{ date('H:i', strtotime($queue->end_time)) }}</span>
                    </section>
                    <section class="ETA">
                        ETA: <span>{{ date('H:i', (strtotime($queue->start_time) - strtotime('now') - 3600)) }}&nbspHours</span>
                    </section>
                </div>
                <div class="placement-actions">
                    <form method="GET" action="{{route('appointment.earlierTimeslot', $queue->appointment_id)}}">
                        <button type="submit" class="btn medium"><span>Earlier?</span></button>
                    </form>
                    <form method="POST" action="{{route('appointment.pushBackQueue', $queue->appointment_id)}}">
                        @csrf
                        <button type="submit" class="btn medium"><span>Push Back</span></button>
                    </form>
                    <form method="GET" action="{{route('appointment.show', $queue->appointment_id)}}">
                        <button type="submit" class="btn medium"><span>View</span></button>
                    </form>
                    <form method="POST" action="{{route('appointment.removeQueue', $queue->appointment_id)}}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn medium" style="background-color: #ff0f0f" ><span>Delete</span></button>
                    </form>
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
            <div class="placement @if((strtotime("now") - strtotime($reservation->updated_at)) <= 30) new-placament @endif">
                <div class="placement-details">
                    <section class="store-name">
                        Store: <span>{{ $reservation->store->name }} [{{ $reservation->store->address_line_1 }}, {{ $reservation->store->town }}]</span>
                    </section>
                    <section class="reservation-time">
                        Time: <span>{{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }}</span>
                    </section>
                    <section class="ETA">
                        Date: <span>{{ $reservation->date }}</span>
                    </section>
                    <section class = "ETA">
                        ETA:
                        <span>
                            @if(strtotime($reservation->start_time) >= strtotime('now'))
                                {{ (strtotime($reservation->date) - strtotime(date("Y-m-d")))/86400 }}&nbspDay(s),
                                {{ date('H:i', (strtotime($reservation->start_time) - strtotime('now') - 3600)) }}&nbspHours
                            @else
                                {{ ((strtotime($reservation->date) - strtotime(date("Y-m-d")))/86400) - 1 }}&nbspDay(s),
                                {{ date('H:i', (strtotime($reservation->start_time) - strtotime('now') - 3600)) }}&nbspHours
                            @endif
                        </span>
                    </section>
                </div>
                <div class="placement-actions">
                    <form method="GET" action="{{route('appointment.show', $reservation->appointment_id)}}">
                        <button type="submit" class="btn medium"><span>View</span></button>
                    </form>
                    <form method="post" action="{{route('appointment.removeReservation', $reservation->appointment_id)}}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn medium" style="background-color: #ff0f0f" ><span>Delete</span></button>
                    </form>
                </div>
            </div>
            <div class="divider"></div>
        @endforeach
    </div>
</div>
@endsection
