<!-- Markup for the application's find store page -->

@extends('layouts.base')

@section('title', 'Find Store')

@section('main')

    <form method="get" action="{{route('home.search')}}">
        <div class="search-bar">
            <div class="search-bar-main">
                <input class="search-input" type="text" placeholder="Enter store name / city / zip code"
                    id="search_string" name="search_string">
                <div class="search-actions">
                    <button class="btn medium" type="submit"><span>Search</span></button>
                    <div class="btn small" id="filter-toggle"><span>Filters</span></div>
                </div>
            </div>
            <div id="search-bar-filters">
                <label>Store type:</label>
                <select id="store_type" name="store_type" style="width: 25%">
                    <option selected disabled
                        {{--                        value=""--}}
                    >--- select store type ---</option>
                    @foreach($store_types as $type)
                        <option value="{{$type->type_id}}">{{$type->store_type}}</option>
                    @endforeach
                </select>

                <label>Country:</label>
                <select id="country" name="country" style="width: 25%">
                    <option selected disabled
                        {{--                        value=""--}}
                    >--- select country ---</option>
                    @foreach($countries as $country)
                        <option value="{{$country->country}}">{{$country->country}}</option>
                    @endforeach
                </select>

                <label>City:</label>
                <select id="city" name="city" style="width: 25%">
                    <option selected disabled
                        {{--                        value=""--}}
                    >--- select city ---</option>
                    @foreach($cities as $city)
                        <option value="{{$city->city}}">{{$city->city}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>


    <div class="store-card-area">
        @foreach ($stores as $store)
            <div class="store-card">
                <div class="store-image-container">
                    @isset($store->image_reference)
                        <img src="{{asset('/storage/images/'.$store->image_reference)}}" class="store-image">
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
                            @if($store->working_hours->isEmpty())
                                Work hours:&nbsp;<span>Closed Today</span>
                            @else
                                Work hours:&nbsp;<span>{{ date('H:i', strtotime($store->working_hours[0]->opening_hours)) }} - {{ date('H:i', strtotime($store->working_hours[0]->closing_hours)) }}</span>
                            @endif
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
                    <a href="/store/{{$store->store_id}}/details" class="btn long"><span>More details</span></a>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };

        $(document).ready(function () {

            var store_type = getUrlParameter('store_type');
            var city = getUrlParameter('city');
            var country = getUrlParameter('country');
            var search_string = getUrlParameter('search_string');

            $('#store_type option').each(function(){
                if($(this).val() == store_type){
                    $(this).attr("selected","selected");
                }
            });

            $('#city option').each(function(){
                if($(this).val() == city){
                    $(this).attr("selected","selected");
                }
            });

            $('#country option').each(function(){
                if($(this).val() == country){
                    $(this).attr("selected","selected");
                    refreshCities();
                }
            });

            $('#search_string').val(search_string);

            function refreshCities() {
                var country = document.getElementById('country').value;

                $.ajax({
                    cache: false,
                    type: "GET",
                    url: "{{route('getCities')}}",
                    data: {country: country},
                    contentType: "application/json; charset=ytf-8",
                    success: function (result) {
                        $('#city')
                            .find('option')
                            .remove()
                            .end();
                        $('#city').append($('<option>', {
                            // value : '',
                            text: '--- select city ---',
                            disabled: true,
                            selected: true
                        }));
                        $.each(result, function (i, val) {
                            $('#city').append($('<option>', {
                                value: val.city,
                                text: val.city
                            }));
                        });
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert(textStatus + ':' + errorThrown);
                    }
                });
            }

            $('#country').change(refreshCities);
        });
    </script>
@endsection
