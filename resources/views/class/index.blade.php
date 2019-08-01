@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
classes
@endslot
@slot('bigtitle')
Classes
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endslot
@slot('addButtonName')
<a href="{{route('class.create')}}" class="add-button btn btn-success">Add classes</a>
@endslot
@slot('searchBar')
<div class="search-bar">
    <input id="search_class" class="form-control" type="text" placeholder="Please type the name you want to search">
</div>
@endslot
<div>
    @include('class._classtable')
</div>
<div class="links-table">
    {{$classes->onEachSide(1)->links()}}
</div>
@endcomponent

@endsection