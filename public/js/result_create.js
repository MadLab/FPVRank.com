/*global $*/
$(function() {
    $('.select2').select2();
    $('#create-message').hide();
    getInput();
});

function getInput() {
    var count = $('#form-count').val();
    count++;
    $.ajax('/results/inputs/' + count, {
        method: 'GET',
        dataType: 'html',
        success: function(response, status, data) {
            $('#result-form-content').append(response);
            $('.select2').select2();
            $('#form-count').val(count);
            $('#position' + count).val(count);
            window.scrollTo(0, document.body.scrollHeight);
        },
        error: function(response, data) {},
        complete: function(status, data) {}
    });
}

function saveForm(count) {
    var form = $('#form' + count).serialize() + '&' + $('#form-select-event').serialize();
    $.ajax({
        type: 'post',
        url: '/results/store',
        data: form,
        success: function(response) {
            if (response.type == 'create') {
                showMessage('Result saved!', 'alert-success');
                getInput();
                $('#resultId' + count).val(response.result.resultId);
            } else {
                showMessage('Result updated!', 'alert-info');
            }
        },
        error: function(response) {
            showMessage('Error, please verify your data', 'alert-danger');
        }
    });

}

function showMessage(message, type) {
    $('#create-message').addClass(type);
    $('#create-message').html(message);
    $('#create-message').show(function() {
        setTimeout(function() {
            $('#create-message').hide();
            $('#create-message').removeClass(type);
        }, 3000);
    });
}