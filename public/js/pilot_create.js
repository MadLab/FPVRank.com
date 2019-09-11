/*global $*/
$(function() {
    $('.select2').select2();
    var data = [{
        "pilotId": "pilot id",
        "name": "pilot name",
        "username": "pilot username",
        "country": "pilot country",
        "imagePath": "pilot image",
    }, ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);
});