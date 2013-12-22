@extends('public.layouts.master')

@section('head-css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery.powertip.min.css') }}"/>
@stop

@section('content')
    <div class="floorMap" style="background-image: url({{ URL::asset("/public_construction/layouts/" . $floor->layout->schema_image) }}); background-repeat: no-repeat">
        <svg height="650" version="1.1" width="630" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">

        @foreach($floor->apartments as $apartment)
            <path class="svg-path {{ $status_css[$apartment->status] }}" data-href="" data-number="{{ $apartment->apartment_no }}" data-floor="{{ $apartment->floor->floor_no }}" data-rooms="{{ $apartment->no_rooms }}" data-status="{{ $status_word[$apartment->status] }}" data-price="{{ $apartment->price }}Lt" d="{{ $apartment->layout->svg }}"></path>
        @endforeach

        </svg>
    </div>

@stop

@section('bottom-js')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.powertip.min.js') }}"></script>

    <script>
        (function($){

            $("path").hover(function(){
                console.log("hovered");
            });

            $('path').on({
                powerTipPreRender: function() {
                    console.log('powerTipRender', this);
                    var tooltip = $("<table>");
                    tooltip.append("<tr><td>Buto nr:</td><td>" + $(this).attr("data-number") + "</td></tr>");
                    tooltip.append("<tr><td>Aukštas:</td><td>" + $(this).attr("data-floor") + "</td></tr>");
                    tooltip.append("<tr><td>Kambarių sk.:</td><td>" + $(this).attr("data-rooms") + "</td></tr>");
                    tooltip.append("<tr><td>Statusas:</td><td>" + $(this).attr("data-status") + "</td></tr>");
                    tooltip.append("<tr><td>Kaina:</td><td>" + $(this).attr("data-price") + "</td></tr>");
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