/*global $*/
$(function() {
    $('.select2').select2();
    var data = [{
        "classId": "class id",
        "name": "class name",
        "description": "class description",
        "location": "US",
    }, ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);
});
