$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateInputID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';
    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateInputID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '50%'
    });
});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    if(requestingField == "en_slidexBox" || requestingField == "fr_slidexBox" || requestingField == "de_slidexBox"){

        var blockSlide = $('.' + requestingField).parents("div.sliderBlock");
        var description = $(blockSlide).find('.descriptionSlide').val();

        $('.' + requestingField).append(
            "<div class='col-md-6 imgBlock'>"+
            "<div class='deleteImageSlider'>&times;</div>"+
            "<div style='text-align: center;'>"+description+"</div>"+
            "<img src='/"+ filePath.replace("\\", "/") +"' alt='"+description+"' style='width: 150px; height: 150px;'/>"+
            "</div>"
        );
        $(blockSlide).find('.descriptionSlide').val('');
        var blockImages = $('.' + requestingField + ' img');
        var jsonInput = [];
        blockImages.each(function(){
            var ob = {src:$(this).attr('src'),alt:$(this).attr('alt')};
            jsonInput.push(ob);
        });
        $(blockSlide).find('.slide_input').val(encodeURIComponent(JSON.stringify(jsonInput)));

    }else {
        $('#' + requestingField).val("/" + filePath.replace("\\", "/")).trigger('change');
        $('.' + requestingField).attr("src", "/" + filePath.replace("\\", "/")).trigger('change');
    }
}