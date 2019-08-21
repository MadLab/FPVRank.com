<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Country</th>
                <th scope="col">Created date</th>                
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach($pilots as $pilot)
            <tr>
                <th scope="row">{{$pilot->pilotId }}</th>
                <td>{{$pilot->name }}</td>
                <td>{{$pilot->username}}</td>
                <td>
                @foreach ($countries as $key => $country)
                @if($key == $pilot->country)
                    {{$country}}
                    <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                @endif
                @endforeach
                </td>
                <td>{{$pilot->created_at }}</td>                             
                <td><a href="{{route('pilot.edit', ['id' => $pilot->pilotId])}}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>