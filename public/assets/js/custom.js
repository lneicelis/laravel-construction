
(function ($){

    $("div.pagination").find("ul").addClass("pagination");

    $(".ajax").click(function(event)
    {
        console.log("ajax called");
        event.preventDefault();

        var obj = this;
        var url = $(this).attr("href");
        var id = $(this).attr("data-id");
        var before = $(this).attr("data-before");
        var after = $(this).attr("data-after");
        var sendAjax = true;

        var data = {
            _token: token, //global token, that has been set in the head of HTML
            id : id
        };

        sendAjax = actionBefore();

        if(sendAjax){
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

        function actionBefore()
        {
            if(before == "confirm"){
                if(confirm("Confirm")) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        function actionAfter()
        {
            if(after == "reload"){
                location.reload();
            }
            if(after == "delete-photo"){
                $(obj).parent().parent().fadeOut("slow").remove();
            }
            if(after == "change-visibility")
            {
                if($(obj).children().attr('class') == "icon-eye-open"){
                    $(obj).children().switchClass("icon-eye-open", "icon-eye-close").attr("title", "Make this photo invisible");
                    $(obj).parent().parent().find("img").css({opacity: "1"});
                }else{
                    $(obj).children().switchClass("icon-eye-close", "icon-eye-open");
                    $(obj).parent().parent().find("img").css({opacity: "0.6"}).attr("title", "Make this photo visible");;
                }
            }
            if(after == "rotate-right"){
                var rotate = parseInt($(obj).parent().parent().find("img").attr("data-rotate-current")) + 90;
                $(obj).parent().parent().find("img").attr("data-rotate-current", rotate).rotate(rotate);
            }
            if(after == "rotate-left"){
                var rotate = parseInt($(obj).parent().parent().find("img").attr("data-rotate-current")) - 90;
                $(obj).parent().parent().find("img").attr("data-rotate-current", rotate).rotate(rotate);
            }

        }
    });

    /*
     * making meniu active
     */
    var menuLinks = $(".nav-list > li > a");
    $.each(menuLinks, function(){
        var urlRegex = new RegExp($(this).attr("href") + ".*","i");
        if(document.URL.match(urlRegex) != null){
            $(this).parent().addClass("active");
        }
    });
    var subMenuLinks = $(".nav-list > li > ul > li > a");
    $.each(subMenuLinks, function(){
        var urlRegex = new RegExp($(this).attr("href") + ".*","i");
        if(document.URL.match(urlRegex) != null){
            $(this).parent().addClass("active");
            $(this).parent().parent().css({display: "block"});
            $(this).parent().parent().parent().addClass("active").addClass("open");
        }
    });
})(jQuery);
