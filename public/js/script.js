$(function () {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

$(document).on('submit', '#fedbackForm', function(e){
    e.preventDefault();
    var form = $(this);
    form.find("button").attr("disabled", true);

    $.post("/send.json", $(this).serialize(), function(data){
        if (data.fieldErrors)
            for(error in data.fieldErrors) {
                var input = form.find("[name="+error+"]");
                input.parent().tooltip({trigger:"click", title:data.fieldErrors[error], placement:bfloat}).tooltip("show").closest(".form-group").addClass("has-error");
            }
        else
        if(data.successMessage) {
            form.find(".form-group").hide();
            form.find(".modal-footer").hide();
            form.append("<div class='success'><b>Thank you! Your application is accepted.</b><br />" +
                "</div>")
            form.find("input").attr("disabled", true);
        }
    }, "json");
});


    $(document).on('submit', '#catalogueFeedbackForm', function(e){
        e.preventDefault();
        var form = $(this);
        form.find("button").attr("disabled", true);
        $.post("/send.json", $(this).serialize(), function(data){
            if (data.fieldErrors)
                for(error in data.fieldErrors) {
                    var input = form.find("[name="+error+"]");
                    input.parent().tooltip({trigger:"click", title:data.fieldErrors[error], placement:bfloat}).tooltip("show").closest(".form-group").addClass("has-error");
                }
            else
            if(data.successMessage) {
                form.find(".form-group").hide();
                form.find(".modal-footer").hide();
                form.append("<div class='success'><b>Thank you! Your application is accepted.</b><br />" +
                    "</div>")
                form.find("input").attr("disabled", true);
            }
        }, "json");
    });


} );

$("img.lazy").lazyload({
    event : "sporty"
});
$(window).bind("load", function() {
    var timeout = setTimeout(function() {$("img.lazy").trigger("sporty")}, 5000);
});
$("img.lazyall").lazyload({
    effect : "fadeIn"
});