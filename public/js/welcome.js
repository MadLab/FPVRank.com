"use strict";
var pilotData = "";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
    }
}

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// Typeahead Demo
// =============================================================
var TypeaheadDemo =
    /*#__PURE__*/
    function() {
        function TypeaheadDemo() {
            _classCallCheck(this, TypeaheadDemo);

            this.init();
        }

        _createClass(TypeaheadDemo, [{
            key: "init",
            value: function init() {
                // event handlers
                //this.basic();
                this.prefetch();
            }
        }, {
            key: "prefetch",
            value: function prefetch() {
                var pilots = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    // url points to a json file that contains an array of country names, see
                    // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
                    prefetch: '/pilots-autocomplete'
                }); // passing in `null` for the `options` arguments will result in the default
                // options being used
                $('#search_public').typeahead(null, {
                    name: 'pilots',
                    source: pilots
                });
            }
        }, ]);

        return TypeaheadDemo;
    }();


/*global $*/
$(document).on('theme:init', () => {
    new TypeaheadDemo();
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
    $('#search_public').bind('typeahead:select', function(ev, suggestion) {
        var url = '/search-pilots/' + suggestion;
        window.location = url;
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
    if (text == "") { text = 'null'; }
    if (date1 == "") { date1 = 'null'; }
    if (date2 == "") { date2 = 'null'; }
    $.ajax('/events-info/' + text + '/' + date1 + '/' + date2, {
        method: 'GET',
        dataType: 'html',
        success: function(response, status, data) {
            $('#events-content').html(response);
        },
        error: function(response, data) {},
        complete: function(status, data) {}
    });
}
