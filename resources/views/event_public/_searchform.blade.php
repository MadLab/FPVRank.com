<div class="form-group row">
    <div class="search-bar-event col-12">
        <input onchange="searchByText($(this).val(),$('#date1').val(),$('#date2').val())" id="search_event" class="form-control" type="text" placeholder="You can search event by name or class name">
    </div>
</div>
<div class="form-group row">
    <label for="date" class="col-md-2 col-form-label text-md-right">From</label>
    <div class="col-8">
        <div class="input-append date" id="dp2" data-date="" data-date-format="yyyy-dd-mm">
            <input name="date1" id="date1" class="form-control span2 datepicker" size="16" type="text" value="" readonly>
        </div>
    </div>
    <div class="col-2">
        <a onclick="clearDate(1)"><i class="material-icons">delete</i></a>

    </div>
</div>
<div class="form-group row">
    <label for="date2" class="col-md-2 col-form-label text-md-right">To</label>
    <div class="col-8">
        <div class="input-append date" id="dp2" data-date="" data-date-format="yyyy-dd-mm">
            <input name="date2" id="date2" class="form-control span2 datepicker" size="16" type="text" value="" readonly>
        </div>
    </div>
    <div class="col-2">
        <a onclick="clearDate(2)"><i class="material-icons">delete</i></a>

    </div>
</div>