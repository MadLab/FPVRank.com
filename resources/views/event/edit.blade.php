@extends('layouts.app')

@section('content')
@component('components.modal')
@slot('id')
confirmRank
@endslot
@slot('title')
<div id="modaltitle">Ranking event</div>
@endslot
@slot('button')
<div id="modalbutton">
    @if ($event->dateRanked == null)
    <a href="{{ route('event.rank', ['eventId' => $event->eventId, 'classId' => $event->classId]) }}" class="btn btn-info text-white">
        Rank event
    </a>
    @endif
</div>
@endslot
<div id="modalcontent">
    @if ($event->dateRanked == null)
    This event hasn't been ranked yet
    @else
    This event is already ranked, date ranked: {{$event->dateRanked}}
    @endif
</div>
@endcomponent

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit an event
                    @if (session('statusDanger'))
                    <div class="alert alert-danger">
                        {{ session('statusDanger') }}
                    </div>
                    @endif
                    @if (session('statusSuccess'))
                    <div class="alert alert-success">
                        {{ session('statusSuccess') }}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('event.update', ['id' => $event->eventId]) }}">
                        @method('PUT')
                        @csrf
                        @include('event._eventform')
                        <div class="row">

                        </div>
                        <div class="inputs-title row">
                            <div class="col-sm-12 col-md-3">
                                Pilot
                            </div>
                            <div class="col-sm-12 col-md-3">
                                Position
                            </div>
                            <div class="col-sm-12 col-md-3">
                                Notes
                            </div>
                            <div class="col-sm-12 col-md-3">

                            </div>
                        </div>
                        <input type="hidden" value="{{!isset($formCount) ? 0 : $formCount}}" id="form-count">
                        <div name="results" id="result-form-content">
                            @foreach($results as $result)
                            @include('event._inputs')
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirmRank">
                                    Rank event
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a onclick="getInput()" class="btn btn-primary text-white">
                                    Add 10 rows
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="fixed-bottom">
                    <button data-toggle="tooltip" data-placement="top" title="Go to Top" onclick="$('html, body').animate({ scrollTop: 0 }, 500)" type="button" id="button_up" class="rounded-circle btn btn-primary float-right navpage-button"><i class="material-icons">
                            arrow_upward
                        </i></button>
                    <button data-toggle="tooltip" data-placement="top" title="Go to Bottom" onclick="$('html, body').animate({ scrollTop: $(document).height() }, 500)" type="button" class="rounded-circle btn btn-primary float-right navpage-button"><i class="material-icons">
                            arrow_downward
                        </i></button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection