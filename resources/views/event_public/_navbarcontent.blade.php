<div class="nav flex-column nav-pills navbar-content" id="v-pills-tab" role="tablist" aria-orientation="vertical">
@foreach($events as $event)
<a class="nav-link" id="v-pills-home-tab{{$event->eventId}}" data-toggle="pill" href="#v-pills-home{{$event->eventId}}" role="tab" aria-controls="v-pills-home{{$event->eventId}}">
    {{$event->name}} - Class: {{$event->className}}</a>
@endforeach
</div>