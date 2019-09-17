@extends('layouts.app')

@section('content')

@component('components.layout')
@slot('modalButton')

@endslot
@slot('idmodal')
event_public
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

@endslot
@slot('rankingnav')
<div class="form-group col-md-6">
    <label for="classId">Search by class and country</label>
    <select name="classId" class="select2 form-control @error('classId') is-invalid @enderror" id="classId">
        @foreach ($classes as $class)
        <option value="{{$class->classId}}" @if(isset($classId)) @if($class->classId == $classId) selected @endif @endif>{{$class->name}}
            --
            @if($class->location == 'global')
            Global
            @endif
            @foreach ($countries as $key => $country)
            @if($key == $class->location)
            <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
            {{$country}}
            @endif
            @endforeach
        </option>
        @endforeach
    </select>
    @error('classId')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group col-md-6">
    <label for="country">Countries</label>
    <select name="country" class="select2 form-control @error('country') is-invalid @enderror" id="country">
        <option value="all" @if(isset($selectedCountry)) @if($selectedCountry=='all' ) selected @endif @endif>All countries</option>
        @foreach ($countries as $key => $country)
        <option value="{{$key}}" @if(isset($selectedCountry)) @if($key==$selectedCountry) selected @endif @endif>{{$country}}</option>
        @endforeach
    </select>
    @error('country')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endslot
@slot('rankingbar')
<div>
    <h2 class="text-center justify-content-center">{{$selectedclass->name}} --
        @if($selectedclass->location == 'global')
        Global
        @endif
        @foreach ($countries as $key => $country)
        @if($key == $selectedclass->location)
        <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
        {{$country}}
        @endif
        @endforeach

    </h2>
    <h3 class="text-center justify-content-center">
        Showing pilots from
        {{$selectedCountry == 'all' ? 'All countries' : ''}}
        @foreach ($countries as $key => $country)
        @if($key == $selectedCountry)
        {{$country}}
        @endif
        @endforeach
        in this class.
    </h3>
</div>
<div class="search-bar">
    <input id="search_ranking" class="form-control" type="text" placeholder="You can search by 'Position', 'Pilot's name or Nickname in the current class">
</div>
@endslot
<div id="rankingtable">
    @include('_rankingtable')
</div>
@endcomponent


@endsection
