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
    <div class="col-5">
        <div>
            @include('event_public._searchform')
        </div>
        <div class="navsbar-event" id="navsbar-event">

            @include('event_public._navbarcontent')

        </div>
    </div>
    <div class="col-7">
        <div class="tab-content" id="v-pills-tabContent">
            @foreach($events as $event)
            <div class="tab-pane fade show {{(($events->first())->eventId == $event->eventId) ? 'active' : ' '}}" id="v-pills-home{{$event->eventId}}" role="tabpanel" aria-labelledby="v-pills-home-tab{{$event->eventId}}">
                @include('event_public._navscontent', ['event' => $event, 'results' => $results])
            </div>
            @endforeach
        </div>
    </div>
</div>
@endcomponent

@endsection