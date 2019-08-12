/*global $*/
$(function() {
    $('.select2').select2();
    $('#classId').change(function() {
        var text = $('#classId').find(":selected").val();
        var url = '/ranking/' + text;
        window.location = url;
    });
});