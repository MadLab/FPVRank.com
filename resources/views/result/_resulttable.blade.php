<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event</th>
                <th scope="col">Pilot</th>
                <th scope="col">Position</th>
                <th scope="col">Notes</th>                        
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <th scope="row">{{$result->resultId}}</th>
                <td>{{$result->eventId}}</td>
                <td>{{$result->pilotId}}</td>
                <td>{{$result->position}}</td>
                <td>{{$result->notes}}</td>                
                <td><a href="{{route('result.edit', ['id' => $result->resultId])}}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>