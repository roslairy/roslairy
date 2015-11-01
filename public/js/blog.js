/**
 * Created by Crimson on 2015/10/25.
 */
$(function(){
    $(".comment-reply").click(function(){
        $("#input-comment").val("@" + $(this).data("author"));
        $("html,body").animate({scrollTop: $(".docomment-block").offset().top}, 300, 'swing');
    });
    $(".like").click(function(){
        location.href = "/like?id=" + $(this).data("id");
    });
    $("#login-modal").on("shown.bs.modal", function(){
        $("#input-username").focus();
    });
    $("#login-modal-trigger").click(function(){
        $("#login-modal").modal();
        return false;
    });

    $("#picture-input").hover(function(){
        var preview = $(".picture-preview");
        var _t = $(this);
        preview.css("top", _t.position().top + _t.height());
        preview.stop(true, true);
        preview.css("display", "block");
        preview.animate({opacity : 1}, 500);
    }, function(){
        var preview = $(".picture-preview");
        preview.stop(true, true);
        preview.animate({opacity : 0}, 500, function(){
            $(".picture-preview").css("display", "none");
        });
    });

    $("#picture").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        if (objUrl) {
            $("#picture-preview-img").attr("src", objUrl) ;
        }
    });
});

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null ;
    if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
    } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
    } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
    }
    return url ;
}

function autoSave(url){
    var title = $("#title");
    if (title.val().length == 0 || window.um.getContent().length == 0) {
        return;
    }

    var id = $("#id");
    var category = $("#category");

    var data = {
        id : id.val(),
        title : title.val(),
        category : category.val(),
        content : window.um.getContent()
    };

    console.log(data);

    $.ajax({
        type: "post",
        url: url,
        data: data,
        success: function(data){
            $("#id").val(data.id);
        },
        error: function(data){
            console.error(data.responseText);
        }
    });
}