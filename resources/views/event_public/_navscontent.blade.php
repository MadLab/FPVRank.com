<div class="card border-secondary mb-3" >
  <div class="card-header bg-transparent border-secondary"><h3>{{$event->name}}</h3></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Location: {{$event->location}}</h5>
    <h5 class="card-title">Date: {{$event->date}}</h5>
    <h5 class="card-title">Class: {{$event->className}}</h5>    
    <div class="content-results">
            @include('event_public._resulttable', ['results' => $results->where('eventId','=',$event->eventId)->sortBy('position'), 'event' => $event])
    </div>
  </div>  
</div>