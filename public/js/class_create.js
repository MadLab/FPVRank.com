/*global $*/
$(document).on('theme:init', () => {
    var data = [{
        "classId": "class id",
        "name": "class name",
        "description": "class description",
        "location": "US",
    }, ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);
});
