@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
event
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
<a href="{{route('event.create')}}" class="add-button btn btn-success">Add events</a>
@endslot
@slot('searchBar')
<div class="search-bar">
    <input id="search_event" class="form-control" type="text" 
    placeholder="You can search by '#', Name or Class">
</div>
@endslot
<div>
    @include('event._eventtable')
</div>
<div class="links-table">
    {{$events->onEachSide(1)->links()}}
</div>
@endcomponent

@endsection