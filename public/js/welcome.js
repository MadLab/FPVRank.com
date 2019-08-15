/*global $*/
$(function() {
    $('#date1').datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(ev) {
            text = $('#search_event').val();
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            searchByText(text, date1, date2);
        });
    $('#date2').datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(ev) {
            text = $('#search_event').val();
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            searchByText(text, date1, date2);
        });
    $('.form_datetime').datetimepicker({
        language: 'en',
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: true,

    });
    $('.select2').select2();
    $('#classId').change(function() {
        var text = $('#classId').find(":selected").val();
        var url = '/ranking/' + text;
        window.location = url;
    });
    $('#search_ranking').change(function() {
        var text = $('#search_ranking').val();
        if (text == "") {
            text = null;
        }
        var classId = $('#classId').find(":selected").val();
        $.ajax('/search/' + text + '/' + classId, {
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
//int id = resultId
function openModalPilotInfo(id, type) {
    $("#event_results_ranking").modal('hide');
    $("#event_public").modal('show');
    $.ajax('/pilot/info/' + id + '/' + type, {
        method: 'GET',
        dataType: 'html',
        success: function(response, status, data) {
            $('#modaltitle').html('Pilot Information');
            $('#modalcontent').html(response);
        },
        error: function(response, data) {},
        complete: function(status, data) {}
    });
}

function goToEvent(id) {
    searchByText('', '', '', function() {
        $('#search_event').val("");
        clearDate(1);
        clearDate(2);
        $('#v-pills-home-tab' + id).tab('show');
        $('#event_public').modal('hide');
    });
}

function goToEventFromRankings(id) {
    $.ajax('/getevent/' + id, {
        method: 'GET',
        dataType: 'html',
        success: function(response, status, data) {
            $('#modalcontent2').html(response);
        },
        error: function(response, data) {},
        complete: function(status, data) {}
    });
    $("#event_results_ranking").modal('toggle');

}

//search event
function searchByText(text, date1, date2, action) {
    if (typeof action == "undefined") {
        action = function() {};
    }
    if (text == "") { text = null; }
    if (date1 == "") { date1 = null; }
    if (date2 == "") { date2 = null; }
    $.ajax('/events-info/' + text + '/' + date1 +
        '/' + date2, {
            method: 'GET',
            dataType: 'html',
            success: function(response, status, data) {
                $('#navsbar-event').html(response);
            },
            error: function(response, data) {},
            complete: function(status, data) {
                action();
            }
        });
}

function clearDate(id) {
    $('#date' + id).val("");
}