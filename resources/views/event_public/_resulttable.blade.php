<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Position</th>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Notes</th>                
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <th scope="row">{{$result->position }}</th>
                <td class="buttonstyle"><a href="{{route('welcome.pilot', ['pilotId' => $result->pilotId])}}">{{$result->name}}</a></td>    
                <td class="buttonstyle">
                @foreach ($countries as $key => $country)
                @if($key == $result->country)
                <a href="{{route('welcome.searchclasscountry', ['classId' => $firstClassId, 'country' => $key])}}">{{$country}}</a>                
                    <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                @endif
                @endforeach           
                </td> 
                <td>{{$result->notes}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>