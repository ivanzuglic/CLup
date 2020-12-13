@extends('layouts.base')

@section('title','Ticket View')

@section('main')

<div class="form widget widget-large">
    <form method="POST">
        @csrf
        <h1 class="widget-title" style="text-align: center">Ticket View</h1>

        <img src="https://www.kaspersky.com/content/en-global/images/repository/isc/2020/9910/a-guide-to-qr-codes-and-how-to-scan-qr-codes-2.png"
            style="width : 30%; margin-display: block; margin-left: auto;
            margin-right: auto;">
        <h1 class=" widget-title"
            style="text-align: center; border-bottom: 4px solid currentColor; padding-bottom: 15px">ETA: </h1>

        <img src="https://www.pngitem.com/pimgs/m/325-3256412_buy-shopping-cart-add-product-ecommerce-icon-png.png"
            class="image-ticket">

        <div class="image-names">
            <label for="Name">Store Name:</label>
        </div>

        <div class="image-names">
            <label for="Name">Store Type:</label>
        </div>

        <div class="image-names">
            <label for="Name">Work Hours:</label>
        </div>

        <div class="image-names">
            <label for="Name">Address:</label>
        </div>
    </form>

</div>


@endsection
