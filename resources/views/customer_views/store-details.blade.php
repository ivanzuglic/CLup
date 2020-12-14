<!-- Markup for the application's store details page -->

@extends('layouts.base')

@section('title', 'Find Store')

@section('main')
            <div class="widget widget-large store-details-widget">
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
                <div class="store-interactions">
                    <form class="row-form" method="post" action="{{route('addToQueue')}}">
                        @csrf
{{--                        <div class="store-interactions-div">--}}
{{--                            Queue Duration:<span>&nbsp;10min </span>--}}
{{--                        </div>--}}
{{--                        <div class="store-interactions-div">--}}
{{--                            People Currently in Queue:<span>&nbsp;7</span>--}}
{{--                        </div>--}}
                        <div class="queue-form-input">
                            <label for="travel-time" class="">Required Travel Time (mins.):</label>
                            <input type="hidden" name="store_id" value="{{$store->store_id}}" />
                            <input id="travel-time" type="text" class="" name="travel_time" placeholder="Travel Time" required autofocus>
                            <label for="planned-stay-time" class="">Planned stay time (mins.):</label>
                            <input id="planned-stay-time" type="text" class="" name="planned_stay_time" placeholder="Stay Time" required autofocus>
                            <button type="submit" class="btn medium" @if($store->working_hours->isEmpty()) disabled="disabled" style="background-color: #a0a0a0; cursor:default" @endif>
                                <span>Queue Up!</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="store-interactions">
                    <div class="reservation-display">
                        <!-- A display that shows what timeslots are available -->
                    </div>
                    <form class="row-form" method="post" action="{{route('appointment.addReservation')}}">
                        @csrf
                        <input type="hidden" name="store_id" value="{{$store->store_id}}" />
                        <div class="store-interactions-div">
                            <label for="reservation_date" class="">Select Date:&nbsp;</label>
                            <input type="date" id="reservation_date"  name="reservation_date" value="{{ date("Y-m-d") }}" min="{{ date("Y-m-d") }}" class="form-control{{ $errors->has('reservation_date') ? ' is-invalid' : '' }}">
                            @if ($errors->has('reservation_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('reservation_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="store-interactions-div">
                            <label for="reservation_start_time" class="">Select Timeframe:&nbsp;</label>
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
@endsection