<div id="layout-form-modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="layout-form" method="post" action="{{ URL::action('LayoutsController@postAddLayout') }}" enctype="multipart/form-data">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Layout</h4>
                </div>

                <div class="modal-body overflow-visible">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">

                            <div class="space-4"></div>

                            {{ Form::token() }}

                            <input id="id" name="id" value="" type="hidden" />

                            <div id="type" class="form-group">
                                <label class="control-label bolder">Chose a layout type</label>

                                <div class="radio">
                                    <label>
                                        <input name="type" value="house" type="radio" class="ace">
                                        <span class="lbl"> House layout</span>
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input name="type" value="floor" type="radio" class="ace">
                                        <span class="lbl"> Floor layout</span>
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input name="type" value="apartment" type="radio" class="ace">
                                        <span class="lbl"> Flat layout</span>
                                    </label>
                                </div>
                            </div>

                            <div id="title" class="form-group">
                                <label for="obj-title" class="control-label bolder">Layout information</label>
                                <div>
                                    <input name="title"  class="input-xxlarge" type="text" id="" placeholder="Title"  />
                                </div>
                            </div>

                            <div id="svg" class="form-group">
                                <label for="svg" class="control-label bolder">SVG</label>
                                <div>
                                    <textarea name="svg" class="form-control limited" placeholder="SVG" ></textarea>
                                </div>
                            </div>

                            <div id="album_id" class="form-group">
                                <label for="album-id" class="control-label bolder">Choose an album</label>
                                <div>
                                    <select id="album-id" name="album_id" class="chosen-select col-xs-4" data-placeholder="Choose an album...">
                                        <option value=""></option>
                                        <option value="">&nbsp;</option>
                                        @foreach($albums as $album)

                                        <option value="{{ $album->id }}">{{{ $album->title }}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div id="file" class="form-group">
                                <label for="file" class="control-label bolder">Choose layout schema image</label>
                                <div>
                                     <input class="schema-upload" name="file" type="file" multiple="" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="icon-remove"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary">
                        <i class="icon-ok"></i>
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>