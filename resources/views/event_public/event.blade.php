@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
event_selected
@endslot
@slot('bigtitle')
{{$event->name}}
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
@include('event_public._resultcontent')
@endcomponent


@endsection