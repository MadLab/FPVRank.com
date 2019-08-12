@extends('layouts.app')

@section('content')
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
                    <form method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('event._eventform')
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload JSON with results</label>
                            <input type="file" class="form-control-file @error('jsonfile') is-invalid @enderror" 
                            id="json-file" name="jsonfile">
                            @error('jsonfile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
@endsection