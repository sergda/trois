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
    $('#' + requestingField).val("/"+filePath.replace("\\", "/") ).trigger('change');
    $('.' + requestingField).attr("src", "/"+filePath.replace("\\", "/")).trigger('change');
}