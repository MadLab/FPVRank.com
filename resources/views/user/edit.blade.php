@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit a user</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', ['id' => $user->userId]) }}">
                        @method('PUT')
                        @csrf
                        @include('user._userform')
                        <div class="dropdown-divider"></div>
                        <h3 class="text-center">Permissions</h3>
                        @include('user._permiform')
                        @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                        @endif
                        <br>
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
