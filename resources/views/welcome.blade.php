@component('layouts.app')

@slot('pageTitle')
Rankings for
{{$selectedclass->name}} --
@if($selectedclass->location == 'global')
Global
@endif
@foreach ($countries as $key => $country)
@if($key == $selectedclass->location)
<span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
{{$country}}
@endif
@endforeach
@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('pageTitle2')
<div id="rankings-title2">
    Showing pilots from
    {{$selectedCountry == 'all' ? 'All countries' : ''}}
    @foreach ($countries as $key => $country)
    @if($key == $selectedCountry)
    {{$country}}
    @endif
    @endforeach
    in this class.
</div>
@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')
<input id="search_ranking" type="text" class="form-control" aria-label="Search" placeholder="You can search rankings by 'Position', 'Pilot's name or Nickname in the selected class and country">
@endslot
<div class="row">
    <div class="form-group col-6">
        <label class="control-label" for="classId">Filter by class</label>
        <select name="classId" id="classId" class="form-control" data-toggle="select2" data-placeholder="" data-allow-clear="false">
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
    </div>
    <div class="form-group col-6">
        <label class="control-label" for="country">Filter pilots by country in selected class</label>
        <select name="country" id="country" class="form-control" data-toggle="select2" data-placeholder="" data-allow-clear="false">
            <option value="all" @if(isset($selectedCountry)) @if($selectedCountry=='all' ) selected @endif @endif>All countries</option>
            @foreach ($countries as $key => $country)
            <option value="{{$key}}" @if(isset($selectedCountry)) @if($key==$selectedCountry) selected @endif @endif>{{$country}}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="rankingtable">
    @include('_rankingtable')
</div>
@endcomponent
