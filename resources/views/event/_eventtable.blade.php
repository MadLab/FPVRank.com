<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
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
                <td class="align-middle">
                    <a data-toggle="tooltip" data-placement="top" title="Edit this event" href="{{route('event.edit', ['id' => $event->eventId])}}" class="btn btn-sm btn-icon btn-secondary">
                        <i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
