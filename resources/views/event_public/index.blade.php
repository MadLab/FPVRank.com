@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
event_public
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
@slot('searchBar')

@endslot
@slot('rankingbar')

@endslot
<div class="row">
    <div class="col-6">
        @include('event_public._searchform')
        <div id="events-content">
            @include('event_public._eventtable')
        </div>
        <div class="links-table">
            {{$events->onEachSide(1)->links()}}
        </div>
    </div>
    <div class="col-6">
        @include('event_public._resultcontent')
    </div>
</div>
@endcomponent


@endsection