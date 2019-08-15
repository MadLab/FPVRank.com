/*global $*/
$(function() {
    var data = [{
        "classId": "class id",
        "name": "class name",
        "description": "class description",

    }, ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);
});