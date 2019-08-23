@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <p>
                            <h1>
                                {{$pilot->name}}
                            </h1>
                        </p>

                        <p>
                            <div>
                                <div>Current ranking:</div>
                            </div>
                            @foreach($info as $val)
                            <div>
                                <h2>
                                    Class: {{$val['className']}} -- Current position: #{{$val['position']}}
                                </h2>
                            </div>
                            @endforeach
                        </p>
                        <br>
                        <p>
                            <h3>                                                             
                                @foreach ($countries as $key => $country)
                                @if($key == $pilot->country)
                                <a href="{{route('welcome.searchclasscountry', ['classId' => $firstClassId, 'country' => $key])}}">{{$country}}</a>
                                <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                                @endif
                                @endforeach
                            </h3>
                        </p>
                        <p>
                            <i class="material-icons">account_circle</i>Username: {{$pilot->username}}
                        </p>
                        <p>
                            <i class="material-icons">flight_takeoff</i>Times competed: {{count($resultsPilot)}}
                        </p>
                        <p>

                            <div>
                                <i class="material-icons">assignment</i>

                                Events attended:
                            </div>
                            @foreach($resultsPilot as $result)

                            <div>
                                <h5>
                                    <a href="{{route('welcome.getevent', ['eventId' => $result->eventId])}}" class="btn btn-link">
                                        {{$result->eventName}} --- Position in this event: #{{$result->position}}
                                    </a>
                                </h5>
                            </div>

                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection