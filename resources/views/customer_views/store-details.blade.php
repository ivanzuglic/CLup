<!-- Markup for the application's store details page -->

@extends('layouts.base')

@section('title', 'Find Store')

@section('main')
            <div class="widget widget-large store-details-widget">
                <div class="store-home">
                    <div class="store-image-area">
                        <div class="store-image-container">
                            <img src="{{ $store->image_reference }}" class="store-image" alt="">
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
                                Work hours:&nbsp;<section>{{ $store->hours }}</section>
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
                        <div class="store-interactions-div">
                            Queue Duration:<span>&nbsp;10min </span>
                        </div>
                        <div class="store-interactions-div">
                            People Currently in Queue:<span>&nbsp;7</span>
                        </div>
                        <div class="queue-form-input">
                            <label for="travel-time" class="">Required Travel Time (mins.):</label>
                            <input type="hidden" name="store_id" value="{{$store->store_id}}" />
                            <input id="travel-time" type="text" class="" name="travel_time" placeholder="Travel Time" required autofocus>
                            <label for="planned-stay-time" class="">Planned stay time (mins.):</label>
                            <input id="planned-stay-time" type="text" class="" name="planned_stay_time" placeholder="Planned stay time" required autofocus>
                            <button type="submit" class="btn medium">
                                <span>Queue Up!</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="store-interactions">
                    <div class="reservation-display">
                        <!-- A display that shows what timeslots are available -->
                    </div>
                    <form class="row-form">
                        <div class="store-interactions-div">
                            <label for="reservation-date" class="">Select Date:&nbsp;</label>
                            <input type="date" id="reservation-date" name="reservation-date" class="form-control">
                        </div>
                        <div class="store-interactions-div">
                            <label for="reservation-start-time" class="">Select Timeframe:&nbsp;</label>
                            <input type="time" id="reservation-start-time" name="reservation-start-time" class="form-control">
                            <h3>&nbsp;to&nbsp;</h3>
                            <input type="time" id="reservation-end-time" name="reservation-end-time" class="form-control">
                        </div>
                        <div class="store-interactions-div">
                            <button type="submit" class="btn large">
                                <span>Book Timeslot!</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
