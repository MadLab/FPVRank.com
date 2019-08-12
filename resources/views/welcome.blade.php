@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
rankings
@endslot
@slot('bigtitle')
Rankings
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endslot
@slot('addButtonName')

@endslot
@slot('searchBar')
<div class="form-group col-md-12">
    <label for="classId">Search by class</label>
    <select name="classId" class="select2 form-control @error('classId') is-invalid @enderror" id="classId">
        @foreach ($classes as $class)
        <option value="{{$class->classId}}" @if(isset($classId)) @if($class->classId == $classId) selected @endif @endif>{{$class->name}}</option>
        @endforeach
    </select>
    @error('classId')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endslot
<div id="rankingtable">
    @include('_rankingtable')
</div>
<div class="links-table">
    {{$rankings->onEachSide(1)->links()}}
</div>
@endcomponent

@endsection