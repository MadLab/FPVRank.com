/*global $*/
$(function() {
    $('#classes').on('hidden.bs.modal', function(e) {
        $('#search_class').val('');
        $('#search_class').focus();
    });
    $('#search_class').change(function() {
        var text = $('#search_class').val();
        $.ajax('/classes/show/' + text, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#modaltitle').html('Search classes');
                $('#modalcontent').html(response);
                $("#classes").modal('toggle');
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
    });
});