/*global $*/
$(function() {
    var data = [{
        "multigpId": "multigp id", 
        "name": "pilot name",
        "username": "pilot username",
        "country": "US",
        "imagePath": "pilot image"
    } ];
    var textedJson = JSON.stringify(data, undefined, 4);
    //textedJson = textedJson + '\n **multigpId is nullable';
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
