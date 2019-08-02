@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
result
@endslot
@slot('bigtitle')
Results
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endslot
@slot('addButtonName')
<a href="{{route('result.create')}}" class="add-button btn btn-success">Add results</a>
@endslot
@slot('searchBar')
<div class="search-bar">
    <input id="search_result" class="form-control" type="text" 
    placeholder="You can search by '#', Event's name or Pilot's name">
</div>
@endslot
<div>
    @include('result._resulttable')
</div>
<div class="links-table">
    {{$results->onEachSide(1)->links()}}
</div>
@endcomponent

@endsection