@extends('public.layouts.master')

@section('head-css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery.powertip.min.css') }}"/>
@stop

@section('content')
    <div class="floorMap" style="background-image: url({{ URL::asset("/public_construction/layouts/" . $house->layout->schema_image) }}); background-repeat: no-repeat">
        <svg height="650" version="1.1" width="630" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">

        @foreach($house->floors as $floor)
            <path class="floor-path" data-href="{{ URL::action('FloorsController@getPublicFloor', array('floor_id' => $floor->id)) }}" data-floor="{{ $floor->floor_no }}" data-apartments="{{ $floor->apartments->count() }}" data-vacant="{{ Apartment::vacant($floor->id)->count() }}" d="{{ $floor->svg }}"></path>
        @endforeach

        </svg>
    </div>

@stop

@section('bottom-js')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.powertip.min.js') }}"></script>

    <script>
        (function($){

            $.each($("path"), function(){
                var noVacant = $(this).attr("data-vacant");
                if(noVacant == 0){
                    $(this).attr("class", "floor-path floor-sold");
                    $(this).attr("data-href", "");
                }
            });

            $("path").click(function(){
                var hrefTo = $(this).attr("data-href");
                if(hrefTo.length !== 0){
                    window.location.href = hrefTo;
                }

            });

            $('path').on({
                powerTipPreRender: function() {
                    var tooltip = $("<table>");
                    tooltip.append("<tr><td>Aukštas:</td><td>" + $(this).attr("data-floor") + "</td></tr>");
                    tooltip.append("<tr><td>Viso butų:</td><td>" + $(this).attr("data-apartments") + "</td></tr>");
                    tooltip.append("<tr><td>Laisvų butų:</td><td>" + $(this).attr("data-vacant") + "</td></tr>");

                    // generate some dynamic content
                    $(this).data('powertip' , tooltip);
                }
            })
            $('path').powerTip({
                followMouse: true,
                //smartPlacement: true,
                placement: "n",
                fadeInTime: 100,
                fadeOutTime: 50,
                intentPollInterval: 0
            });

        })(jQuery)

    </script>

@stop