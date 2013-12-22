(function($){
    $.jsonToFormRequests = [];

    $.widget( "luknei.jsonToForm", {

        options: {
            prefix: "",
            data: {},

            //callbacks
            onSuccessCallback: function(){}
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

            this.getData();
        },

        getData: function(){
            console.log("bindSubmit initiated");
            var obj = this;

            for(var i = 0; i < $.jsonToFormRequests.length; i++)
                $.jsonToFormRequests[i].abort();

            $.jsonToFormRequests.push(
                $.ajax({
                    url: obj.options.url,
                    type: "post",
                    data: obj.options.data,
                    success: function(result,status,xhr){
                        console.log(result)
                        obj.setValues(result);

                        obj.options.onSuccessCallback();
                    },
                    error:function(xhr,status,error){
                        $.grit("error", "Error", "There was an error. The the request was denied. Please try again.");
                    }
                })
            );

        },
        setValues: function(response){
            var obj = this;
            var form = this.options.form;
            $.each(response, function(key, value){
                var inputName = "[name=" + obj.options.prefix + key + "]";
                var input = $(form).find(inputName);
                var inputType = input.attr("type");
                var inputTagName = input.prop("tagName");

                //set value for text and hidden input
                if(inputType == "text" || inputType == "hidden") {
                    input.val(value);
                }
                // select dropdown select
                if(inputTagName == "SELECT") {
                    input.val(value);
                }
                // set value of text area
                if(inputTagName == "TEXTAREA") {
                    input.val(value);
                }
                //select radio button
                $(form).find(inputName + "[value='" + value + "']").prop('checked',true);
            });
        },
        removeErrors: function(){
            var form = this.options.form;
            $(form).find('.help-block').remove();
            $(form).find('.form-group').removeClass('has-error');
        },
        resetFields: function(){
            var form = this.options.form;
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
