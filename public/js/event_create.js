/*global $*/
$(function() {
    $('#classId').select2();
    $('.form_datetime').datetimepicker({
        language: 'en',
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: true,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
});