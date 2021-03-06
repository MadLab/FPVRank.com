<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Position</th>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Laps - Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <th scope="row">{{$result->position }}</th>
                <td class="buttonstyle"><a href="{{route('welcome.pilot', ['pilotId' => $result->pilotId])}}">{{$result->name}} -- {{$result->username}}</a></td>
                <td class="buttonstyle">
                @foreach ($countries as $key => $country)
                @if($key == $result->country)
                <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                <a href="{{route('welcome.searchclasscountry', ['classId' => $firstClassId, 'country' => $key])}}">{{$country}}</a>

                @endif
                @endforeach
                </td>
                <td>{{$result->notes}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
