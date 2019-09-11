@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <img src="{{$pilot->imageLocal ? asset('storage/'.$pilot->imagePath) : $pilot->imagePath }}" alt="" class="img-rounded img-responsive col-sm-12 col-md-12" />
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <p class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h1>
                                        @foreach ($countries as $key => $country)
                                        @if($key == $pilot->country)
                                        <a href="{{route('welcome.searchclasscountry', ['classId' => $firstClassId, 'country' => $key])}}"><span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span> </a>
                                        @endif
                                        @endforeach
                                        {{$pilot->name}} -- {{$pilot->username}}
                                    </h1>
                                </div>
                            </div>
                        </p>
                        <p>

                            <h2>Times competed: {{count($resultsPilot)}}</h2>

                        </p>
                        <br>
                        <p class="container">
                            <div class="row">
                                <div class="col-4">
                                    <h1>Class</h1>
                                </div>
                                <div class="col-4">
                                    <h1>Position</h1>
                                </div>
                                <div class="col-4">
                                    <h1>Rating</h1>
                                </div>
                            </div>
                            @foreach($info as $val)
                            <div class="row">
                                <div class="col-4">
                                    <h1>{{$val['className']}}</h1>
                                </div>
                                <div class="col-4">
                                    <h1>#{{$val['position']}}</h1>
                                </div>
                                <div class="col-4">
                                    <h1>{{number_format($val['rating'], 2)}}</h1>
                                </div>
                            </div>
                            @endforeach
                        </p>
                        <br>


                        <p class="container">
                            <h2>
                                Events attended:
                            </h2>
                        </p>
                        <p class="container">
                            <div class="row">
                                <div class="col-9">
                                    <h1>Event</h1>
                                </div>
                                <div class="col-3">
                                    <h1>Position</h1>
                                </div>
                            </div>
                            @foreach($resultsPilot as $result)
                            <div class="row">
                                <div class="col-9">
                                    <h3>
                                        <a href="{{route('welcome.getevent', ['eventId' => $result->eventId])}}">
                                            {{$result->eventName}}
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-3">
                                    <h3>
                                        <a href="{{route('welcome.getevent', ['eventId' => $result->eventId])}}">
                                            #{{$result->position}}
                                        </a>
                                    </h3>
                                </div>
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
