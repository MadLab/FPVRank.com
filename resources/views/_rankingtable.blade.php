<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#-Position</th>
                <th scope="col">Pilot's rating</th>
                <th scope="col">Pilot's name</th>
                <th scope="col">Pilot's country</th>

            </tr>
        </thead>
        <tbody>
            @foreach($rankings as $ranking)
            <tr>
                <th scope="row">{{$ranking["position"]}}</th>
                <th scope="row">{{number_format($ranking["rating"],2)}}</th>
                <td class="buttonstyle"><a href="{{route('welcome.pilot', ['pilotId' => $ranking['pilotId']])}}">{{$ranking["name"]}}
                        -- {{$ranking["username"]}}</a></td>

                @foreach ($countries as $key => $country)
                @if($key == $ranking["country"])
                <td>
                    <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                    <a href="{{route('welcome.searchclasscountry', ['classId' => $firstClassId, 'country' => $key])}}">{{$country}}</a>
                </td>
                @endif
                @endforeach
                @if($ranking["country"] == 'null')
                <td>

                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="links-table">
    {{$rankings->onEachSide(1)->links()}}
</div>
