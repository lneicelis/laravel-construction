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
            Apartments
            <small>
                <i class="icon-double-angle-right"></i>

            </small>
        </h1>

    </div><!-- /.page-header -->
@stop

@section('content')
    <p>
        <a class="btn btn-primary show-apartment-form" href="{{ URL::Action('ApartmentsController@postAddApartment') }}">
            <i class="icon-plus align-top bigger-125"></i>
            Create a new apartment
        </a>
    </p>

    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                ID
            </th>
            <th>House</th>
            <th>Floor</th>
            <th>Layout</th>
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
        @foreach($apartments as $apartment)
            <tr>
                <td class="center">
                    {{ $apartment->id }}
                </td>

                <td>
                    {{ $apartment->floor->house->title }}
                </td>

                <td>
                    {{ $apartment->floor->title }}
                </td>

                <td>
                    {{ $apartment->layout->title }}
                </td>
                <td>
                    {{ $apartment->title }}
                </td>
                <td>
                    {{ $apartment->created_at }}
                </td>
                <td>

                </td>

                <td class="td-actions">
                    <div class="hidden-phone visible-desktop action-buttons">

                        <a class="green apartment-edit" href="{{ URL::action('ApartmentsController@postEditApartment') }}" data-id="{{ $apartment->id }}" >
                            <i class="icon-pencil bigger-130"></i>
                        </a>

                        <a class="red ajax" href="{{ URL::action('ApartmentsController@postDeleteApartment') }}" data-id="{{ $apartment->id }}" data-before="confirm" data-after="reload">
                            <i class="icon-trash bigger-130"></i>
                        </a>

                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.construction.modals.apartment-form', array('layouts' => $layouts))

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
            $(".show-apartment-form").bind("click", function(e){
                e.preventDefault();
                var formAction = $(e.currentTarget).attr("href");
                $("#apartment-form-modal").find("form").attr("action", formAction);

                $(".chosen-select").chosen({width:"100%"});

                bindAjaxForm();

                $("#apartment-form-modal").modal("show");
            });

            $(".apartment-edit").bind("click", function(e){
                e.preventDefault();
                var formAction = $(e.currentTarget).attr("href");

                $("#apartment-form").attr("action", formAction)
                    .jsonToForm({
                        url: '{{ URL::action("ApartmentsController@postGetApartment") }}',
                        data: {
                            id: $(this).attr("data-id")
                        },
                        onSuccessCallback: function(){
                            $(document).find(".chosen-select").trigger("chosen:updated");
                        }
                    });

                $(".chosen-select").chosen({width:"100%"});

                bindAjaxForm();

                $("#apartment-form-modal").modal("show");
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
                $("#apartment-form").ajaxForm({
                    beforeSendCallback: function(){
                        $(".loader-container").show();
                    },
                    onSuccessCallback: function(){
                        $(".loader-container").hide();
                        $("#apartment-form-modal").modal("hide");
                    },
                    onErrorCallback: function(response){
                        $(".loader-container").hide();
                    }
                });
            }

            var oTable1 = $('#sample-table-2').dataTable( {
                "aoColumns": [
                    null, null, null, null, null, null, null,
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