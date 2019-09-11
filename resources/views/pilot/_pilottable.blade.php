<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Created date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pilots as $pilot)
            <tr>
                <th scope="row">{{$pilot->pilotId }}</th>
                <td><a data-toggle="tooltip" data-placement="right" title="Edit this pilot" href="{{route('pilot.edit', ['id' => $pilot->pilotId])}}">{{$pilot->name }} -- {{$pilot->username}}</a></td>

                <td>
                    @foreach ($countries as $key => $country)
                    @if($key == $pilot->country)
                    <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                    {{$country}}
                    @endif
                    @endforeach
                </td>
                <td>{{$pilot->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
