@extends('layouts.app')

@section('content')
@component('components.modal')
@slot('id')
jsonmodal
@endslot
@slot('title')
<div id="modaltitle">
    Create event with JSON
</div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">
    <form method="POST" action="{{ route('event.storejson') }}">
        @csrf        
        @include('components._jsonform', ['rows' => 7])
    </form>
    <hr class="separator-line">

</div>
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create an event
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
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary col-12" data-toggle="modal" data-target="#jsonmodal">
                                Submit JSON
                            </button>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('event._eventform')

                        <div class="inputs-title row">
                            <div class="col-sm-12 col-md-3">
                                Position
                            </div>
                            <div class="col-sm-12 col-md-3">
                                Pilot
                            </div>
                            <div class="col-sm-12 col-md-3">
                                Notes
                            </div>
                            <div class="col-sm-12 col-md-3">

                            </div>
                        </div>
                        <input type="hidden" value="0" id="form-count">
                        <div name="results" id="result-form-content">

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>

                            <div class="col-md-6">
                                <a onclick="getInput()" class="btn btn-primary text-white">
                                    Add 10 rows
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom">
    <button data-toggle="tooltip" data-placement="top" title="Go to Top" onclick="$('html, body').animate({ scrollTop: 0 }, 500)" type="button" id="button_up" class="rounded-circle btn btn-primary float-right navpage-button"><i class="material-icons">
            arrow_upward
        </i></button>
    <button data-toggle="tooltip" data-placement="top" title="Go to Bottom" onclick="$('html, body').animate({ scrollTop: $(document).height() }, 500)" type="button" class="rounded-circle btn btn-primary float-right navpage-button"><i class="material-icons">
            arrow_downward
        </i></button>
</div>
@endsection