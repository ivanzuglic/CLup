<!-- Markup for the application's store details page -->

@extends('layouts.base')

@section('title', 'Find Store')

@section('main')

    <div class="widget widget-extra-large store-details-widget">

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

        @if($stat_exists == true || $occ_exists == true)
            <div class="store-statistics">
                @if($stat_exists == true)
                    <div class="statistics-details">
                        <section class="section-title">
                            Store Statistics:
                        </section>
                        <div class="parameters-container">
                            <div class="single-parameter">
                                <section class="parameter-name">
                                    Visits Per Day (AVG):
                                </section>
                                <section class="parameter-value">
                                    {{ $statistical_data->avg_customers }}
                                </section>
                            </div><div class="single-parameter">
                                <section class="parameter-name">
                                    Visit Length (AVG):
                                </section>
                                <section class="parameter-value">
                                    {{ $statistical_data->avg_time_spent_min }}'
                                </section>
                            </div>
                        </div>
                    </div>
                @endif
                @if($occ_exists == true)
                    <div class="chart-cotainer">
                        <canvas id="myChart"></canvas>
                    </div>
                @endif
            </div>
        @endif

        <div class="store-interactions">
            <div class="interaction-title">
                Queue Up:
            </div>
            <form class="placament-form" method="post" action="{{route('appointment.addQueue')}}">
                @csrf
                <div class="store-interactions-div">
                    <label for="travel-time" class="">Required Travel Time (mins.):</label>
                    <div class="label-divider">
                        <input type="hidden" name="store_id" value="{{$store->store_id}}" />
                        <input id="travel-time" type="text" class="" name="travel_time" placeholder="Travel Time" required autofocus>
                    </div>
                </div>
                <div class="store-interactions-div">
                    <label for="planned-stay-time" class="">Planned stay time (mins.):</label>
                    <div class="label-divider">
                        <input id="planned-stay-time" type="text" class="" name="planned_stay_time" placeholder="Stay Time" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn medium" @if($store->working_hours->isEmpty()) disabled="disabled" style="background-color: #a0a0a0; cursor:default" @endif>
                    <span>Queue Up!</span>
                </button>
            </form>
        </div>

        <div class="store-interactions">
            <div class="interaction-title">
                Book a Timeslot:
            </div>
            <div class="availability-display">
                <div class="availability-timeline">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="time-part" id="time-label-{{$i}}">
                            0{{$i}}:00
                        </div>
                    @endfor
                    @for ($i = 10; $i < 25; $i++)
                        <div class="time-part" id="time-label-{{$i}}">
                            {{$i}}:00
                        </div>
                    @endfor
                </div>
                <div class="availability-slots">
                    @for ($i = 0; $i < 721; $i++)
                        <div class="time-slot-marker tooltip" id="time-slot-{{$i}}">
                            <span class="tooltip-text" id="time-slot-tooltip-{{$i}}">
                                &nbsp;{{str_pad(number_format((int)($i / 30),0, '.', ''), 2, '0', STR_PAD_LEFT)}}:{{str_pad(2 * ($i - (30 * (number_format((int)($i / 30),0, '.', '')))), 2, '0', STR_PAD_LEFT)}}&nbsp;
                            </span>
                        </div>
                    @endfor
                </div>
            </div>
            <form class="placament-form" method="post" action="{{route('appointment.addReservation')}}">
                @csrf
                <input type="hidden" name="store_id" value="{{$store->store_id}}" />
                <input type="hidden" name="store_id_ajax" value="{{$store->store_id}}" />
                <div class="store-interactions-div">
                    <label for="reservation_date" class="">Select Date:&nbsp;</label>
                    <div class="label-divider">
                        <input type="date" id="reservation_date"  name="reservation_date" value="{{ date("Y-m-d") }}" min="{{ date("Y-m-d") }}" class="form-control{{ $errors->has('reservation_date') ? ' is-invalid' : '' }}">
                        @if ($errors->has('reservation_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('reservation_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="store-interactions-div">
                    <label for="reservation_start_time" class="">Select Timeframe:&nbsp;</label>
                    <div class="label-divider">
                        <input type="time" id="reservation_start_time" name="reservation_start_time" value="{{ date("H") + 1 }}:00" class="form-control{{ $errors->has('reservation_start_time') ? ' is-invalid' : '' }}">
                        @if ($errors->has('reservation_start_time'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('reservation_start_time') }}</strong>
                            </span>
                        @endif
                        <h3>&nbsp;to&nbsp;</h3>
                        <input type="time" id="reservation_end_time" name="reservation_end_time" value="{{ date("H") + 1 }}:20" class="form-control{{ $errors->has('reservation_end_time') ? ' is-invalid' : '' }}">
                        @if ($errors->has('reservation_end_time'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('reservation_end_time') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="store-interactions-div">
                    <button type="submit" class="btn large">
                        <span>Book Timeslot!</span>
                    </button>
                </div>
                <br>
                @if($errors->any())
                    <span  class="invalid-feedback" style="color: red">{{$errors->first()}}</span>
                @endif
            </form>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        var chartOccupancyData = {{ json_encode($occupancy_array) }};
    </script>

    <script>
        $(document).ready(function (){
            console.log('JQUERY READY');
        })
        $('#reservation_date').change(function (e){
            e.preventDefault();
            console.log('DEFAULT PREVENTED');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: "{{url('/ajax/timeline')}}",
                method: 'POST',
                data: {
                    store_id: $("input[name=store_id]").val(),
                    date: $("input[name=reservation_date]").val()
                },
                success: function(data){
                    var timelineArray = data.timeline_array;
                    console.log($("input[name=store_id]").val());
                    console.log($("input[name=reservation_date]").val());
                    console.log(timelineArray);
                }
            })
        })
    </script>

@endsection
