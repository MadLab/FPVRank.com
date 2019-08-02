@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
pilot
@endslot
@slot('bigtitle')
Pilots
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endslot
@slot('addButtonName')
<a href="{{route('pilot.create')}}" class="add-button btn btn-success">Add pilots</a>
@endslot
@slot('searchBar')
<div class="search-bar">
    <input id="search_pilot" class="form-control" type="text" placeholder="You can search by '#', Name or Username">
</div>
@endslot
<div>
    @include('pilot._pilottable')
</div>
<div class="links-table">
    {{$pilots->onEachSide(1)->links()}}
</div>
@endcomponent

@endsection