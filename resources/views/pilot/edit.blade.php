@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit a pilot</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pilot.update', ['id' => $pilot->pilotId]) }}" enctype="multipart/form-data">
                        @csrf
                        @include('pilot._pilotform')
                        @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Current photo</label>
                            <div class="col-md-6">
                                <img src="{{$pilot->imagePath}}" alt="" class="img-rounded img-responsive col-sm-12 col-md-12" />
                            </div>
                        </div>
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
