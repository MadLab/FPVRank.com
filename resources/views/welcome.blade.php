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

@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')
<div class="top-bar-search">
    <div class="input-group input-group-search">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <span class="oi oi-magnifying-glass"></span>
            </span>
        </div>
        <input id="search_public" type="text" class="form-control" aria-label="Search"
            placeholder="Search pilots by name or username">
    </div>
</div>
@endslot
<div class="card card-fluid">
    <div class="card-header">
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
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="input-group input-group-alt">
                <div class="search-group input-group-prepend col-sm-12 col-lg-2">
                    <select name="classId" id="classId" class="form-control" data-toggle="select2" data-placeholder=""
                        data-allow-clear="false">
                        @foreach ($classes as $class)
                        <option value="{{$class->classId}}" @if(isset($classId)) @if($class->classId == $classId)
                            selected @endif @endif>{{$class->name}}
                            --
                            @if($class->location == 'global')
                            Global
                            @endif
                            @foreach ($countries as $key => $country)
                            @if($key == $class->location)
                            <span class="label label-default"><span
                                    class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                            {{$country}}
                            @endif
                            @endforeach
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-group input-group-prepend col-sm-12 col-lg-2">
                    <select name="country" id="country" class="form-control" data-toggle="select2" data-placeholder=""
                        data-allow-clear="false">
                        <option value="all" @if(isset($selectedCountry)) @if($selectedCountry=='all' ) selected @endif
                            @endif>All countries</option>
                        @foreach ($countries as $key => $country)
                        <option value="{{$key}}" @if(isset($selectedCountry)) @if($key==$selectedCountry) selected
                            @endif @endif>{{$country}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="searchDesktop input-group col-sm-12 col-lg-8">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                    </div>
                    <input id="search_ranking" type="text" class="form-control" aria-label="Search"
                        placeholder="You can search rankings by 'Position', 'Pilot's name or Nickname in the selected class and country">
                </div>
                <!-- Mobile view -->
                <div class="searchMobile col-sm-12 col-lg-8">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                        <input id="search_ranking_mobile" type="text" class="form-control" aria-label="Search"
                            placeholder="You can search rankings by 'Position', 'Pilot's name or Nickname in the selected class and country">
                    </div>
                </div>
                <!-- End Mobile view -->
            </div>
        </div>
        <div id="rankingtable">
            @include('_rankingtable')
        </div>
    </div>
</div>
@endcomponent