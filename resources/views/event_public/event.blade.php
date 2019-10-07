@component('layouts.app')

@slot('pageTitle')

@endslot

@slot('imageCover')
<header class="page-cover">
    <img class="cover-img" src="{{$event->imagePath}}" alt="Event Image">
</header>
@endslot()

@slot('pageCover')
<header class="page-title-bar">
    <div class="row align-items-center">
        <div class="col-auto">

        </div>
        <div class="col">
            <h3 class="page-title"> {{$event->name}} </h3>
            <p class="text-muted">
                <i class="fas fa-map-marker-alt mr-1"></i> <span>Location: {{$event->location}}</span> <i class="fa fa-clock ml-3 mr-1"></i><span>Date: {{$event->date}}</span> <i class="fa fa-dot-circle ml-3 mr-1"></i><span>Class: {{$event->className}}</span>
            </p>
        </div>
        <div class="col-auto">

        </div>
    </div>
</header>
@endslot

@slot('pageTitle2')

@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')

@endslot
<div class="section-block">

</div>
<div class="card">
    <div class="card-body">
        @include('event_public._resulttable', ['results' => $results->where('eventId','=',$event->eventId)->sortBy('position')])
    </div>
</div>


@endcomponent
