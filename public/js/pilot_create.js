/*global $*/
$(function() {
    var data = [{
        "pilotId": "pilot id",
        "name": "pilot name",
        "username": "pilot username",
        "country": "pilot country",
        "imagePath": "pilot image",
    }, ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);
    $("#fileupload-dropzone").change(function() {
        readURL(this);
    });

});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#selectedImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
