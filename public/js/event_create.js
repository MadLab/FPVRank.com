/*global $*/
$(document).on('theme:init', () => {

    $("#fileupload-dropzone").change(function() {
        readURL(this);
    });
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
    });
}

function getInput() {
    var count = parseInt($('#form-count').val());
    $.ajax('/results/inputs/' + count, {
        method: 'GET',
        dataType: 'html',
        success: function(response, status, data) {
            $('#result-form-content').append(response);
            $('.selects').select2({

            });
        },
        error: function(response, data) {},
        complete: function(status, data) {}
    });
    count = count + 10;
    $('#form-count').val(count);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#selectedImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}