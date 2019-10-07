@component('layouts.app')

@slot('pageTitle')
Events
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')
<a href="{{route('event.create')}}">
    <button type="button" class="btn btn-success btn-floated" data-toggle="tooltip" data-placement="top" title="Add new event"><span class="fa fa-plus"></span>
    </button>
</a>
@endslot

@slot('searchBar')
<input id="search_event" class="form-control" type="text" placeholder="You can search events by '#', Name or Class">
@endslot
@component('components.modal')
@slot('id')
event
@endslot
@slot('title')
<div id="modaltitle"></div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">

</div>
@endcomponent
<div class="card">
    <div class="card-body">
        @include('event._eventtable')
        <div class="links-table">
            {{$events->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endcomponent
