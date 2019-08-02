<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">date</th>
                <th scope="col">Class</th>
                <th scope="col">Location</th>             
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <th scope="row">{{$event->eventId}}</th>
                <td>{{$event->name}}</td>
                <td>{{$event->date}}</td>
                <td>{{$event->classId}}</td>
                <td>{{$event->location}}</td>                             
                <td><a href="{{route('event.edit', ['id' => $event->eventId])}}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>