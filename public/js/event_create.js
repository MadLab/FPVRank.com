/*global $*/
$(function() {
    $('.form_datetime').datetimepicker({
        language: 'en',
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: true,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.select2').select2();
    $('#create-message').hide();
    $('[data-toggle="tooltip"]').tooltip();
    getInput();
    //orderList();

});

function changeOrder(val, oldVal) {
    oldVal.attr('id', val);
    //orderList();
}

function orderList() {
    $("#result-form-content .row").sort(function(a, b) {
        return parseInt(a.id) - parseInt(b.id);
    }).each(function() {
        var elem = $(this);
        elem.remove();
        $(elem).appendTo("#result-form-content");
        $('.select2').select2();
    });
}

function getInput() {
    var count = parseInt($('#form-count').val());
    $.ajax('/results/inputs/' + count, {
        method: 'GET',
        dataType: 'html',
        success: function(response, status, data) {
            $('#result-form-content').append(response);
            $('.select2').select2();
        },
        error: function(response, data) {},
        complete: function(status, data) {}
    });
    count = count + 10;
    $('#form-count').val(count);
}