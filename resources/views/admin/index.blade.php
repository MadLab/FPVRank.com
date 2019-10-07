@component('layouts.app')

@slot('pageTitle')
Dashboard
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')
<input id="search_event" class="form-control" type="text" placeholder="You can search events by '#', Name or Class">
@endslot

<div class="section-block">

</div>
<div class="row">
    @component('components.dashboardtable')
    @slot('tableContent')
    @include('user._usertable')
    @endslot
    @slot('routeList')
    {{route('user.index')}}
    @endslot
    @slot('routeCreate')
    {{route('user.create')}}
    @endslot
    @slot('tableTitle')
    Users
    @endslot
    @endcomponent

    @component('components.dashboardtable')
    @slot('tableContent')
    @include('class._classtable')
    @endslot
    @slot('routeList')
    {{route('class.index')}}
    @endslot
    @slot('routeCreate')
    {{route('class.create')}}
    @endslot
    @slot('tableTitle')
    Classes
    @endslot
    @endcomponent

    @component('components.dashboardtable')
    @slot('tableContent')
    @include('pilot._pilottable')
    @endslot
    @slot('routeList')
    {{route('pilot.index')}}
    @endslot
    @slot('routeCreate')
    {{route('pilot.create')}}
    @endslot
    @slot('tableTitle')
    Pilots
    @endslot
    @endcomponent

    @component('components.dashboardtable')
    @slot('tableContent')
    @include('event._eventtable')
    @endslot
    @slot('routeList')
    {{route('event.index')}}
    @endslot
    @slot('routeCreate')
    {{route('event.create')}}
    @endslot
    @slot('tableTitle')
    Events
    @endslot
    @endcomponent
</div>




@endcomponent
