@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
event_index
@endslot
@slot('bigtitle')
Events
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endslot
@slot('addButtonName')

@endslot
@slot('rankingnav')

@endslot
@slot('searchBar')

@endslot
@slot('rankingbar')
@include('event_public._searchform')
@endslot
<div id="events-content">
    @include('event_public._eventtable')
</div>
<div class="links-table">
    {{$events->onEachSide(1)->links()}}
</div>
@endcomponent


@endsection