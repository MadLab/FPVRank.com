@component('layouts.app')

@slot('pageTitle')

@endslot

@slot('imageCover')
<header class="page-cover">
    <img class="cover-img" src="{{$event->imagePath}}" alt="Event Image" onerror="this.src='{{asset('/events.jpg')}}';">
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
<div class="top-bar-search">
    <div class="input-group input-group-search">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <span class="oi oi-magnifying-glass"></span>
            </span>
        </div>
        <input id="search_public" type="text" class="form-control" aria-label="Search" placeholder="Search pilots by name or username">
    </div>
</div>

@endslot
<div class="section-block">

</div>
<div class="card">
    <div class="card-body">
        @include('event_public._resulttable', ['results' => $results->where('eventId','=',$event->eventId)->sortBy('position')])
    </div>
</div>


@endcomponent
