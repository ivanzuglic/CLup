<!-- Markup for the application's success messages -->

@extends('layouts.base')

@section('title', 'Success')

@section('main')
    <div class="widget widget-medium information-widget">
        <div class="widget-header title-only">
            <h2 class="widget-title success-title">SUCCESS!</h2>
        </div>
        <div class="widget-content">
            <div class="information-img">
                <img src="/images/thumbs-up-solid.svg" placeholder="Thumbs Up!">
            </div>
            <div class="information-msg">
                {{ $message }}
            </div>
        </div>
    </div>
@endsection
