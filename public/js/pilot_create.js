/*global $*/
$(function() {
    var data = [{
        "pilotId": "pilot id",
        "name": "pilot name",
        "username": "pilot username",

    }, ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);
});