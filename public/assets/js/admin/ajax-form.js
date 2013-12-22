(function($){
    $.ajaxFormRequests = [];

    $.widget( "luknei.ajaxForm", {

        options: {
            successMsg: true,
            showErrors:true,
            reset: true,

            ////callbacks
            beforeSendCallback: function(){},
            onSuccessCallback: function(response){},
            onErrorCallback: function(response){},
            progressCallback: function(e){}
        },

        // _setOptions is called with a hash of all options that are changing
        // always refresh when changing options
        _setOptions: function() {
            console.log("setOptions called");

            $.extend(this.options, {
                form: $(this.element),
                formUrl: $(this.element).attr('action')
            });

            // _super and _superApply handle keeping the right this-context
            this._superApply( arguments );
            //this._refresh();
        },
        // called when created, and later when changing options
        _refresh: function() {
            console.log("refresh called");
        },

        _create: function(){
            console.log("create called");

        },
        _init: function(){
            console.log("init called");
            this._setOptions();

            this.bindSubmit();

        },


        bindSubmit: function(){
            console.log("bindSubmit initiated");
            var obj = this;
            console.log(this.options.formData);
            this.options.form.unbind();
            this._on(true, this.options.form, {
                submit: function(e){
                    e.preventDefault();

                    $.extend(this.options, {
                        formData: new FormData($(this.element)[0])
                    });

                    for(var i = 0; i < $.ajaxFormRequests.length; i++)
                        $.ajaxFormRequests[i].abort();
                    $.ajaxFormRequests.push(
                        $.ajax({
                            url: obj.options.formUrl,  //Server script to process data
                            type: 'POST',
                            xhr: function() {  // Custom XMLHttpRequest
                                var myXhr = $.ajaxSettings.xhr();
                                if(myXhr.upload){ // Check if upload property exists
                                    myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
                                }
                                return myXhr;
                            },
                            //Ajax events
                            beforeSend: beforeSendHandler(),
                            success: completeHandler,
                            error: errorHandler,
                            // Form data
                            data: obj.options.formData,
                            //Options to tell jQuery not to process data or worry about content-type.
                            cache: false,
                            contentType: false,
                            processData: false
                        })
                    );
                    function beforeSendHandler(){
                        console.log("beforeSendHandler called")
                        obj.options.beforeSendCallback();
                    }
                    function completeHandler(response){
                        console.log("completeHandler called")
                        obj.options.onSuccessCallback(response);
                        obj.showGritter(response);
                        obj.removeErrors();
                        obj.resetFields();

                    }
                    function errorHandler(response){
                        console.log("errorHandler called");
                        obj.options.onErrorCallback(response);
                        if(obj.options.showErrors === true){
                            obj.showErrors(response);
                        }
                    }
                    function progressHandlingFunction(e){
                        obj.options.progressCallback(e);
                        if(e.lengthComputable){
                            console.log(e.loaded, e.total);
                        }
                    }
                }
            })
        },
        showErrors: function(response){
            var errors = JSON.parse(response.responseText);
            this.removeErrors();
            $.each(errors, function(key, value){

                $('#' + key).addClass('has-error')
                    .append('<div class="help-block">' + value + '</div>');

                console.log(key)
            })
        },
        removeErrors: function(){
            form = this.options.form;
            $(form).find('.help-block').remove();
            $(form).find('.form-group').removeClass('has-error');
        },
        resetFields: function(){
            form = this.options.form;
            $(form).each(function(){
                try{
                    this.reset();
                    $(form).find(".chosen-select").val('').trigger("chosen:updated");
                    $(form).find("input[type=file]").ace_file_input('reset_input');
                } catch (e) {}
            });
        },
        showGritter: function(response){
            if(this.options.successMsg === true){
                $.gritter.add({
                    title: response.title,
                    text: response.message,
                    sticky: false,
                    class_name: 'gritter-light gritter-success'
                })
            }
        }
    });

    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

})(jQuery);
