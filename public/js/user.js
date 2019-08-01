/*global $*/
$(function() {
    $('#user').on('hidden.bs.modal', function(e) {
        $('#search_user').val('');
        $('#search_user').focus();
    });
    $('#search_user').change(function() {
        var text = $('#search_user').val();
        $.ajax('/users/show/' + text, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#modaltitle').html('Search users');
                $('#modalcontent').html(response);
                $("#user").modal('toggle');
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
    });
});