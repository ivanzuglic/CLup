@extends('layouts.base')

@section('title','Placement View')

@section('main')
<div class="form widget widget-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Queue Placements</h2>
    </div>
    <div class="placement-container">
        @foreach
            <div class="placement">
                <div class="placement-details">
                    <section class="store-name">
                        Store name:&nbsp;<span>Placeholder</span>
                    </section>
                    <section class="ETA">
                        ETA:&nbsp;<span>Placeholder</span>
                    </section>
                    <section class="queue-length">
                        People in queue:&nbsp;<span>Placeholder</span>
                    </section>
                </div>
                <div class="placement-actions">
                    <a href="" class="btn medium"><span>View</span></a>
                    <a href="" class="btn medium"><span>Delete</span></a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="form widget widget-large">
    <div class="widget-header title-only">
        <h2 class="widget-title">Reservations</h2>
    </div>
    <div class="placement-container">
        @foreach
            <div class="placement">
                <div class="placement-details">
                    <section class="store-name">
                        Store name:&nbsp;<span>Placeholder</span>
                    </section>
                    <section class="ETA">
                        Reservation Time:&nbsp;<span>Placeholder</span>
                    </section>
                </div>
                <div class="placement-actions">
                    <a href="" class="btn medium"><span>View</span></a>
                    <a href="" class="btn medium"><span>Delete</span></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection