@extends('layouts.base')

@section('title','Ticket View')

@section('main')

<div class="form widget widget-large ticket-widget">

    <div class="ticket-information">
        <div class="qr-code-container">
            <!-- QR Code SVG Goes Here, be sure that the svg has the "qr-code" class -->
            <img class="qr-code" src="https://www.kaspersky.com/content/en-global/images/repository/isc/2020/9910/a-guide-to-qr-codes-and-how-to-scan-qr-codes-2.png" placeholder="QR Code">
        </div>
        <section class="eta">ETA:&nbsp;ADD_STUFF_HERE</section>
    </div>

    <div class="store-home">
        <div class="store-image-area">
            <div class="store-image-container">
                <img src="{{asset('/storage/images/'.$store->image_reference)}}" class="store-image" alt="">
            </div>
            </div>
        <div class="store-details-text-area">
            <ul>
                <li>
                    Store name:&nbsp;<section>{{ $store->name }}</section>
                </li>
                <li>
                    Store type:&nbsp;<section>{{ $store->type->store_type }}</section>
                </li>
                <li>
                    @if($store->working_hours->isEmpty())
                        Work hours:&nbsp;<section>Closed Today</section>
                    @else
                        Work hours:&nbsp;<section>{{ date('H:i', strtotime($store->working_hours[0]->opening_hours)) }} - {{ date('H:i', strtotime($store->working_hours[0]->closing_hours)) }}</section>
                    @endif
                </li>
                <li>
                    Occupancy:&nbsp;<section>{{ $store->current_occupancy }}/{{$store->max_occupancy}} </section>
                </li>
                <li>
                    Address:&nbsp;<section>{{ $store->address_line_1 }},&nbsp;{{ $store->town }}</section>
                </li>
            </ul>
        </div>
    </div>

</div>


@endsection
