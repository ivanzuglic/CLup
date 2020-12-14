<!-- Markup for the application's error messages -->

@extends('layouts.base')

@section('title', 'Error')

@section('main')
    <div class="widget widget-medium information-widget">
        <div class="widget-header title-only">
            <h2 class="widget-title error-title">ERROR!</h2>
        </div>
        <div class="widget-content">
            <div class="information-img">
                <img src="/images/times-circle-solid.svg" placeholder="Error!">
            </div>
            <div class="information-msg">
                {{ $message }}
            </div>
        </div>
    </div>
@endsection
