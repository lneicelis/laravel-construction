@extends('admin.layouts.master')

@section('head-css')

    <link rel="stylesheet" href="{{ URL::asset('assets/css/chosen.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/colorbox.css') }}" />
    @parent
@endsection

@section('page-header')
    <div class="page-header">
        <h1>
            Houses
            <small>
                <i class="icon-double-angle-right"></i>

            </small>
        </h1>

    </div><!-- /.page-header -->
@stop

@section('content')
    <p>
        <a class="btn btn-primary show-house-form" href="{{ URL::Action('HousesController@postAddHouse') }}">
            <i class="icon-plus align-top bigger-125"></i>
            Create a new house
        </a>
    </p>

    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                ID
            </th>
            <th>Layout id</th>
            <th>Title</th>
            <th>
                <i class="icon-time bigger-110"></i>
                Created at
            </th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @unless(!$houses)
            @foreach($houses as $house)
                <tr>
                    <td class="center">
                        {{ $house->id }}
                    </td>

                    <td>
                        {{ $house->layout->title }}
                    </td>
                    <td>
                        {{ $house->title }}
                    </td>
                    <td>
                        {{ $house->created_at }}
                    </td>
                    <td>

                    </td>

                    <td class="td-actions">
                        <div class="hidden-phone visible-desktop action-buttons">

                            <a class="green house-edit" href="{{ URL::action('HousesController@postEditHouse') }}" data-id="{{ $house->id }}" >
                                <i class="icon-pencil bigger-130"></i>
                            </a>

                            <a class="red ajax" href="{{ URL::action('HousesController@postDeleteHouse') }}" data-id="{{ $house->id }}" data-after="reload">
                                <i class="icon-trash bigger-130"></i>
                            </a>

                        </div>
                    </td>

                </tr>
            @endforeach
        @endunless
        </tbody>
    </table>

    @include('admin.construction.modals.house-form', array('layouts' => $layouts))

@stop

@section('scripts')
    <script src="{{ URL::asset('assets/js/jquery-ui-1.10.3.full.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/admin/ajax-form.js') }}"></script>
    <script src="{{ URL::asset('assets/js/admin/jsonToForm-widget.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.colorbox-min.js') }}"></script>

    <script>
        (function($){
            $(".show-house-form").bind("click", function(e){
                e.preventDefault();
                var formAction = $(e.currentTarget).attr("href");
                $("#house-form-modal").find("form").attr("action", formAction);

                $(".chosen-select").chosen({width:"100%"});

                bindAjaxForm();

                $("#house-form-modal").modal("show");
            });

            $(".house-edit").bind("click", function(e){
                e.preventDefault();
                var formAction = $(e.currentTarget).attr("href");

                $("#house-form").attr("action", formAction)
                    .jsonToForm({
                        url: '{{ URL::action("HousesController@postGetHouse") }}',
                        data: {
                            id: $(this).attr("data-id")
                        },
                        onSuccessCallback: function(){
                            $(document).find(".chosen-select").trigger("chosen:updated");
                        }
                    });

                $(".chosen-select").chosen({width:"100%"});

                bindAjaxForm();

                $("#house-form-modal").modal("show");
            });

            $('.schema-upload').ace_file_input({
                no_file:'Choose schema image',
                btn_choose:'Choose',
                btn_change:'Change',
                droppable:false,
                thumbnail:true, //| true | large
                whitelist:'png|jpg|jpeg'
                //blacklist:'exe|php'
                //
            });

            function bindAjaxForm(modal){
                $("#house-form").ajaxForm({
                    beforeSendCallback: function(){
                        $(".loader-container").show();
                    },
                    onSuccessCallback: function(){
                        $(".loader-container").hide();
                        $("#house-form-modal").modal("hide");
                    },
                    onErrorCallback: function(response){
                        $(".loader-container").hide();
                    }
                });
            }

            var oTable1 = $('#sample-table-2').dataTable( {
                "aoColumns": [
                    null, null, null,null, null,
                    { "bSortable": false }
                ]
            });

            var colorbox_params = {
                reposition:true,
                scalePhotos:true,
                scrolling:false,
                previous:'<i class="icon-arrow-left"></i>',
                next:'<i class="icon-arrow-right"></i>',
                close:'&times;',
                current:'{current} of {total}',
                maxWidth:'100%',
                maxHeight:'100%',
                onOpen:function(){
                    document.body.style.overflow = 'hidden';
                },
                onClosed:function(){
                    document.body.style.overflow = 'auto';
                },
                onComplete:function(){
                    $.colorbox.resize();
                }
            };

            $('[data-rel="colorbox"]').colorbox(colorbox_params);
            /*
            var wrapper = $("<div>");
            $("<input>").attr({
                type: "text",
                name: "room_title[]",
                class: "col-xs-8",
                placeholder: "Room name"
            }).appendTo(wrapper);
            $("<input>").attr({
                type: "text",
                name: "room_size[]",
                class: "col-xs-4",
                placeholder: "Room size"
            }).appendTo(wrapper);
            $("#rooms").append(wrapper);
            */

            function jsonToForm(url)
            {
                $.ajax({
                    url: url,
                    type: "post",
                    data: data,
                    success: function(result,status,xhr){
                        $.grit(result.type, result.title, result.message);
                        actionAfter();
                    },
                    error:function(xhr,status,error){
                        $.grit("error", "Error", "There was an error. The the request was denied. Please try again.");
                    }
                });
            }
        })(jQuery);

    </script>
@stop