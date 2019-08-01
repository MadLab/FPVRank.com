@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
user
@endslot
@slot('bigtitle')
Users
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endslot
@slot('addButtonName')
<a href="{{route('user.create')}}" class="add-button btn btn-success">Add user</a>
@endslot
@slot('searchBar')
<div class="search-bar">
    <input id="search_user" class="form-control" type="text" placeholder="Please type the name you want to search">
</div>
@endslot
<div>
    @include('user._usertable')
</div>
<div class="links-table">
    {{$users->onEachSide(1)->links()}}
</div>
@endcomponent

@endsection