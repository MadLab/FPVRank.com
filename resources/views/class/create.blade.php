@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a class</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('class.store') }}">
                        @csrf
                        @include('class._classform')
                        @if (session('status'))
                        <div class="alert alert-danger">
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