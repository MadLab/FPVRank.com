<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>                
                <th scope="col">Name</th>
                <th scope="col">date</th>
                <th scope="col">Class</th>
                <th scope="col">Location</th>             
                
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>                                
                <td class="buttonstyle"><a href="{{route('welcome.getevent', ['eventId' => $event->eventId])}}">
                    {{$event->name}}</a></td>                
                <td>{{$event->date}}</td>
                <td>{{$event->className}}</td>
                <td>{{$event->location}}</td>                                             
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
