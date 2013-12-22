<div id="apartment-form-modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="apartment-form" method="post" action="" enctype="multipart/form-data">

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

                            <div id="floor_id" class="form-group">
                                <label class="control-label bolder">Choose a floor</label>
                                <div>
                                    <select name="floor_id" class="chosen-select col-xs-4" data-placeholder="Choose a floor...">
                                        <option value=""></option>
                                        <option value="">&nbsp;</option>
                                        @foreach($floors as $floor)

                                        <option value="{{ $floor->id }}">{{{ $floor->title }}}</option>

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

                            <div id="status" class="form-group">
                                <label class="control-label bolder">Apartment status</label>
                                <div>
                                    <select name="status" class="chosen-select col-xs-4" data-placeholder="Apartment status...">
                                        <option value="0">Vacant</option>
                                        <option value="1">Reserved</option>
                                        <option value="2">Sold</option>
                                    </select>
                                </div>
                            </div>

                            <div id="apartment_no" class="form-group">
                                <label class="control-label bolder">Apartment number</label>
                                <div>
                                    <input name="apartment_no"  class="input-large" type="text" id="" placeholder="Apartment number"  />
                                </div>
                            </div>

                            <div id="no_rooms" class="form-group">
                                <label class="control-label bolder">Number of rooms</label>
                                <div>
                                    <input name="no_rooms"  class="input-large" type="text" id="" placeholder="Number of rooms"  />
                                </div>
                            </div>

                            <div id="title" class="form-group">
                                <label for="obj-title" class="control-label bolder">Layout information</label>
                                <div>
                                    <input name="title"  class="input-xxlarge" type="text" id="" placeholder="Title"  />
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