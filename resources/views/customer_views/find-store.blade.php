<!-- Markup for the application's find store page -->

@extends('layouts.base')

@section('title', 'Find Store')

@section('main')

    <form method="get" action="{{route('stores.search')}}">
        <div class="search-bar">
            <input class="search-input" type="text" placeholder="Search stores"  name="search_string">
            <div class="search-actions">
                <button class="btn medium" type="submit"><span>Search</span></button>
            </div>
        </div>
    </form>


    <div class="store-card-area">
        @foreach ($stores as $store)
            <div class="store-card">
                <div class="store-image-container">
                    @isset($store->image_reference)
                        <img  src="{{asset('/storage/images/'.$store->image_reference)}}" class="store-image">
                    @endisset
                </div>
                <div class="store-details">
                    <ul>
                        <li>
                            Store name:&nbsp;<span>{{ $store->name }}</span>
                        </li>
                        <li>
                            Store type:&nbsp;<span>{{ $store->type->store_type }}</span>
                        </li>
                        <li>
                            Work hours:&nbsp;<span>{{ $store->hours }}</span>
                        </li>
                        <li>
                            Occupancy:&nbsp;<span>{{ $store->current_occupancy }}/{{$store->max_occupancy}} </span>
                        </li>
                        <li>
                            Address:&nbsp;<span>{{ $store->address_line_1 }}</span>
                        </li>
                        <li>
                            <span>{{ $store->town }}</span>
                        </li>
                    </ul>
                </div>
                <div class="store-card-actions">
                    <a href="/stores/{{$store->store_id}}/details" class="btn long"><span>More details</span></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
