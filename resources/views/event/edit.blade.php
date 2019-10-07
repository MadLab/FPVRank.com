@component('layouts.app')

@slot('pageTitle')
Edit event
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')

<button id="bottom-button" class="btn btn-info btn-floated" type="button" onclick="$('html, body').animate({ scrollTop: $(document).height() }, 500)"><span data-toggle="tooltip" data-placement="top" title="Go to Bottom" class="fa fa-arrow-down"></span>
</button>

<button id="top-button" class="btn btn-info btn-floated" type="button" onclick="$('html, body').animate({ scrollTop: 0 }, 500)"><span data-toggle="tooltip" data-placement="top" title="Go to Top" class="fa fa-arrow-up"></span>
</button>

@endslot

@slot('searchBar')

@endslot
@component('components.modal')
@slot('id')
confirmRank
@endslot
@slot('title')
<div id="modaltitle">
    Ranking event
</div>
@endslot
@slot('button')
<div id="modalbutton">
    @if ($event->dateRanked == null)
    <a href="{{ route('event.rank', ['eventId' => $event->eventId, 'classId' => $event->classId]) }}" class="btn btn-info text-white">
        Rank event
    </a>
    @endif
</div>
@endslot
<div id="modalcontent">
    @if ($event->dateRanked == null)
    This event hasn't been ranked yet
    @else
    This event is already ranked, date ranked: {{$event->dateRanked}}
    @endif
</div>
@endcomponent
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('event.update', ['id' => $event->eventId]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <fieldset>
                <legend>Event info</legend>
                @include('event._eventform')
                <div class="row justify-content-md-center">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card card-figure">
                            <figure class="figure">
                                <img id="currentImage" class="img-fluid" src="{{$event->imagePath}}" alt="Current Image">
                                <figcaption class="figure-caption">
                                    <h6 class="figure-title text-center">Current photo</h6>
                                    <p class="text-muted mb-0"></p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card card-figure">
                            <figure class="figure">
                                <img id="selectedImage" class="img-fluid" src="#" alt="Selected Image">
                                <figcaption class="figure-caption">
                                    <h6 class="figure-title text-center">Selected photo</h6>
                                    <p class="text-muted mb-0"></p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </fieldset>
            <hr class="mb-4">
            <fieldset>
                <legend>Results info</legend>
                <div class="inputs-title row">
                    <div class="col-sm-12 col-md-3">
                        Position
                    </div>
                    <div class="col-sm-12 col-md-3">
                        Pilot
                    </div>
                    <div class="col-sm-12 col-md-3">
                        Laps - Time
                    </div>
                    <div class="col-sm-12 col-md-3">

                    </div>
                </div>
                <input type="hidden" value="{{!isset($formCount) ? 0 : $formCount}}" id="form-count">
                <div name="results" id="result-form-content">
                    @foreach($results as $result)
                    @include('event._inputs')
                    @endforeach
                </div>
            </fieldset>
            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="button" onclick="getInput()">Add 10 rows</button>

            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>

            <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#confirmRank">
                Rank event
            </button>

        </form>
    </div>
</div>
@endcomponent
