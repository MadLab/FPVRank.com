<div class="form-group">
    <div class="input-group input-group-alt">
        <div class="search-group input-group-prepend col-sm-12 col-lg-2">
            <div class="input-group input-group-alt flatpickr" id="" data-toggle="flatpickr" data-wrap="true">
                <input name="date1" id="date1" type="text" class="form-control" data-input="" data-date-format="Y-m-d"
                    readonly placeholder="Search from this date...">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary" data-clear=""><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
        <div class="search-group input-group-prepend col-sm-12 col-lg-2">
            <div class="input-group input-group-alt flatpickr" id="" data-toggle="flatpickr" data-wrap="true">
                <input name="date2" id="date2" type="text" class="form-control" data-input="" data-date-format="Y-m-d"
                    readonly placeholder="...to this date">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary" data-clear=""><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
        <div class="searchDesktop input-group col-sm-12 col-lg-8">
            <div class="input-group-prepend">
                <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
            </div>
            <input onchange="searchByText($(this).val(),$('#date1').val(),$('#date2').val())" id="search_event"
                class="form-control" type="text" placeholder="You can search events by name or class name">
        </div>
        <!-- Mobile view -->
        <div class="searchMobile col-sm-12 col-lg-8">
            <div class="input-group-prepend">
                <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                <input onchange="searchByText($(this).val(),$('#date1').val(),$('#date2').val())"
                    id="search_event_mobile" class="form-control" type="text"
                    placeholder="You can search events by name or class name">
            </div>
        </div>
        <!-- End Mobile view -->
    </div>
</div>