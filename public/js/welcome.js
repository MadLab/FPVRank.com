/*global $*/
$(document).on('theme:init', () => {
    $('#date1').change(function() {
        text = $('#search_event').val();
        date1 = $('#date1').val();
        date2 = $('#date2').val();
        searchByText(text, date1, date2);
    });
    $('#date2').change(function() {
        text = $('#search_event').val();
        date1 = $('#date1').val();
        date2 = $('#date2').val();
        searchByText(text, date1, date2);
    });
    $('#classId').change(function() {
        rankingNavigate();
    });
    $('#country').change(function() {
        rankingNavigate();
    });
    $('#search_ranking').change(function() {
        var text = $('#search_ranking').val();
        if (text == "") {
            text = null;
        }
        var classId = $('#classId').find(":selected").val();
        var country = $('#country').find(":selected").val();
        $.ajax('/search/' + text + '/' + classId + '/' + country, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#rankingtable').html(response);
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
    });
});

function rankingNavigate() {
    var text = $('#classId').find(":selected").val();
    var country = $('#country').find(":selected").val();
    var url = '/class/' + text + '/' + country;
    window.location = url;
}

//search event
function searchByText(text, date1, date2) {
    if (text == "") { text = null; }
    if (date1 == "") { date1 = null; }
    if (date2 == "") { date2 = null; }
    $.ajax('/events-info/' + text + '/' + date1 +
        '/' + date2, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#events-content').html(response);
            },
            error: function(response, data) {},
            complete: function(status, data) {}
        });
}