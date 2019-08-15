<div>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <div>
                        Name: {{$pilot->name}}
                    </div>
                </h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <div>
                        Username: {{$pilot->username}}
                    </div>
                </h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <div>
                        Times competed: {{count($resultsPilot)}}
                    </div>
                </h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRankings" aria-expanded="false" aria-controls="collapseRankings">
                        Current ranking
                    </button>
                </h5>
            </div>
            <div id="collapseRankings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="accordion" id="accordionExample2">
                        @foreach($info as $val)
                        <div>
                            <h5>
                                Class: {{$val['className']}} ---- Current position: #{{$val['position']}}
                            </h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEvents" aria-expanded="false" aria-controls="collapseEvents">
                        Events attended
                    </button>
                </h5>
            </div>
            <div id="collapseEvents" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="accordion" id="accordionExample2">
                        @foreach($resultsPilot as $result)
                        <div class="card">
                            <div class="card-header" id="heading{{$result->resultId}}">
                                <h5 class="mb-0">
                                
                                    @if($type == 'welcome')                                
                                    <button onclick="goToEventFromRankings({{$result->eventId}})" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEvents{{$result->resultId}}" aria-expanded="false" aria-controls="collapseEvents{{$result->resultId}}">
                                        {{$result->eventName}} --- Position in this event: #{{$result->position}}
                                    </button>
                                    @else
                                    <button onclick="goToEvent({{$result->eventId}})" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEvents{{$result->resultId}}" aria-expanded="false" aria-controls="collapseEvents{{$result->resultId}}">
                                        {{$result->eventName}} --- Position in this event: #{{$result->position}}
                                    </button>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>