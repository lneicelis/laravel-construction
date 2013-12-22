<div id="floor-form-modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="floor-form" method="post" action="" enctype="multipart/form-data">

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

                            <div id="house_id" class="form-group">
                                <label class="control-label bolder">Choose a house</label>
                                <div>
                                    <select name="house_id" class="chosen-select col-xs-4" data-placeholder="Choose a house...">
                                        <option value=""></option>
                                        <option value="">&nbsp;</option>
                                        @foreach($houses as $house)

                                        <option value="{{ $house->id }}">{{{ $house->title }}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="layout_id" class="form-group">
                                <label class="control-label bolder">Choose a layout</label>
                                <div>
                                    <select name="layout_id" class="chosen-select col-xs-4" data-placeholder="Choose a layout...">
                                        <option value=""></option>
                                        <option value="">&nbsp;</option>
                                        @foreach($layouts as $layout)

                                        <option value="{{ $layout->id }}">{{{ $layout->title }}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="floor_no" class="form-group">
                                <label class="control-label bolder">Floor</label>
                                <div>
                                    <input name="floor_no"  class="input-xxlarge" type="text" id="" placeholder="Floor"  />
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