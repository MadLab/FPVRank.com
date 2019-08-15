@extends('layouts.app')

@section('content')
@component('components.modal')
@slot('id')
jsonmodal
@endslot
@slot('title')
<div id="modaltitle">
    Create pilots with JSON
</div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">
    <form method="POST" action="{{ route('pilot.storejson') }}">
        @csrf
        @include('components._jsonform', ['rows' => 7])
    </form>
    <hr class="separator-line">
    <div>**If JSON contains same pilotId as in the database, data will be updated!</div>
</div>
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a pilot</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary col-12" data-toggle="modal" data-target="#jsonmodal">
                                Submit JSON
                            </button>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('pilot.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="classId" class="col-md-4 col-form-label text-md-right"><strong>Last ID</strong></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{isset($lastPilotId) ? $lastPilotId : ' '}}" readonly>
                            </div>
                        </div>
                        @include('pilot._pilotform')
                        @if (session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection