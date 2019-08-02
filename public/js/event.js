/*global $*/
$(function() {

    $('#event').on('hidden.bs.modal', function(e) {
        $('#search_event').val('');
        $('#search_event').focus();
    });
    $('#search_event').change(function() {
        var text = $('#search_event').val();
        $.ajax('/events/show/' + text, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#modaltitle').html('Search events');
                $('#modalcontent').html(response);
                $("#event").modal('toggle');
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
    });

});