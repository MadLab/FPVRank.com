/*global $*/
$(function() {
    $('#result').on('hidden.bs.modal', function(e) {
        $('#search_result').val('');
        $('#search_result').focus();
    });
    $('#search_result').change(function() {
        var text = $('#search_result').val();
        $.ajax('/results/show/' + text, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#modaltitle').html('Search events');
                $('#modalcontent').html(response);
                $("#result").modal('toggle');
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
    });
});