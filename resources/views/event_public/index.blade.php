@component('layouts.app')

@slot('pageTitle')
Events
@endslot

@slot('pageCover')

@endslot

@slot('imageCover')

@endslot

@slot('pageTitle2')

@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')
<input onchange="searchByText($(this).val(),$('#date1').val(),$('#date2').val())" id="search_event" class="form-control" type="text" placeholder="You can search events by name or class name">
@endslot
<div id="events-content">
    @include('event_public._eventtable')
</div>
<div class="links-table">
    {{$events->onEachSide(1)->links()}}
</div>
@endcomponent
