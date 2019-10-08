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
<div class="top-bar-search">
    <div class="input-group input-group-search">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <span class="oi oi-magnifying-glass"></span>
            </span>
        </div>
        <input id="search_public" type="text" class="form-control" aria-label="Search" placeholder="Search pilots by name or username">
    </div>
</div>
@endslot
<div class="card card-fluid">

    <div class="card-body">
        @include('event_public._searchform')
        <div id="events-content">
        @include('event_public._eventtable')
        </div>
        <div class="links-table">
            {{$events->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endcomponent
