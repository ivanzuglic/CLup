<!-- Markup for the application's warning messages -->

@extends('layouts.base')

@section('title', 'Warning')

@section('main')
    <div class="widget widget-medium information-widget">
        <div class="widget-header title-only">
            <h2 class="widget-title warning-title">WARNING!</h2>
        </div>
        <div class="widget-content">
            <div class="information-img">
                <img src="/images/exclamation-triangle-solid.svg" placeholder="Warning!">
            </div>
            <div class="information-msg">
                {{ $message }}
            </div>
        </div>
    </div>
@endsection
