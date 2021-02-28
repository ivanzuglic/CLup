<!-- Markup for the application's page for printing tickets -->

@extends('layouts.base')

@section('title', 'Print Ticket')

@section('main')
    <div class="widget widget-large">
        <div class="widget-header title-only">
            <h2 class="widget-title">Print Ticket</h2>
        </div>
        <div>
            <form class="print-form" method="post" action="{{route('appointment.addQueueProxy')}}">
                @csrf
                <input type="hidden" name="store_id" value="{{$store->store_id}}" />
                <div class="store-interactions-div">
                    <label for="planned-stay-time" class="">Planned stay time (mins.):</label>
                    <div class="label-divider">
                        <input id="planned-stay-time" type="text" class="" name="planned_stay_time" placeholder="Stay Time" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn medium" @if($is_open == false) disabled="disabled" style="background-color: #a0a0a0; cursor:default" @endif>
                    <span>Print Ticket</span>
                </button>
            </form>
        </div>
    </div>
@endsection
