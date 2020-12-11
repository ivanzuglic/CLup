@extends('layouts.base')

@section('title','Placement View')

@section('main')
<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Queue View</h2>
    </div>
    <form method="POST">
        @csrf

        <div>
            <label for="Queue 1" class="col-md-4 col-form-label text-md-right" style="padding-right: 30px;">Queue
                1</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>

        <div>
            <label for="Queue 2" class="col-md-4 col-form-label text-md-right" style="padding-right: 30px;">Queue
                2</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>

        <div>
            <label for="Queue 3" class="col-md-4 col-form-label text-md-right" style="padding-right: 30px;">Queue
                3</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>

        <div>
            <label for="Queue 4" class="col-md-4 col-form-label text-md-right" style="padding-right: 30px;">Queue
                4</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>


    </form>
</div>

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Booking View</h2>
    </div>
    <form method="POST">
        @csrf

        <div>
            <label for="Booking 1" class="col-md-4 col-form-label text-md-right" style="padding-right: 14px;">Booking
                1</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>

        <div>
            <label for="Booking 2" class="col-md-4 col-form-label text-md-right" style="padding-right: 14px;">Booking
                2</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>

        <div>
            <label for="Booking 3" class="col-md-4 col-form-label text-md-right" style="padding-right: 14px;">Booking
                3</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>

        <div>
            <label for="Booking 4" class="col-md-4 col-form-label text-md-right" style="padding-right: 14px;">Booking
                4</label>
            <button type="submit" class="btn medium">
                <span>View</span>
            </button>
            <button type="button" class="btn medium">
                <span>Delete</span>
            </button>
        </div>


    </form>
</div>
@endsection