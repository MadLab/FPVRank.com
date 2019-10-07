/*global $*/
$(document).on('theme:init', () => {
    $('#pilot').on('hidden.bs.modal', function(e) {
        $('#search_pilot').val('');
        $('#search_pilot').focus();
    });
    $('#search_pilot').change(function() {
        var text = $('#search_pilot').val();
        $.ajax('/pilots/show/' + text, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#modaltitle').html('Search pilots');
                $('#modalcontent').html(response);
                $("#pilot").modal('toggle');
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
    });
});
