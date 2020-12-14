@extends('layouts.base')

@section('title','Ticket View')

@section('main')

<div class="form widget widget-large ticket-widget">

    <div class="ticket-information" id="message"></div>

    <div class="ticket-information">
        <div class="qr-code-container">
            <!-- QR Code SVG Goes Here, be sure that the svg has the "qr-code" class -->
            <div class="qr-code">{{ $qr }}</div>
        </div>
        <section class="eta">ETA:&nbsp;{{ date('H:i', (strtotime($appointment->start_time) - strtotime('now') - 3600)) }}</section>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">

    var $message = $('#message');

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        encrypted: true,
        cluster: 'eu',
    });

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('qr');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\CustomerEntersStore', function(data) {
        var message = message.html();
        var newMessage = data.message;
        message.html(newMessage);
        message.show();
    });
</script>
@endsection
