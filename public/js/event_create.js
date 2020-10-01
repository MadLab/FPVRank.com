/*global $*/
$(document).on('theme:init', () => {

    var data = [ {
        "raceName": "World Cup 1 - Track 3",        
        "startDate": "2018-08-11 18:00:00",
        "multigpId": "00111",                
        "pilots": [
          {                        
            "multigpId": "14744",   
            "pilotId": "2525",                     
            "pilotUserName": "FAZED",
            "pilotFirstName": "Matt",
            "pilotLastName": "Loven",
            "pilotCountry": "US",            
            "pilotProfilePictureUrl": "https:\/\/s3.amazonaws.com\/\/profileImage-16.jpg",            
          }
        ]}
    ];
    var textedJson = JSON.stringify(data, undefined, 4);
    $('#myTextarea').text(textedJson);

    $("#fileupload-dropzone").change(function() {
        readURL(this);
    });
    getInput();
    $('#date').mask('0000-00-00 00:00');    
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