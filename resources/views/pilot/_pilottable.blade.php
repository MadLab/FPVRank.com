<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Created date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pilots as $pilot)
            <tr>
                <th scope="row">{{$pilot->pilotId }}</th>
                <td>{{$pilot->name }} -- {{$pilot->username}}</td>
                <td>
                    @foreach ($countries as $key => $country)
                    @if($key == $pilot->country)
                    <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                    {{$country}}
                    @endif
                    @endforeach
                </td>
                <td>{{$pilot->created_at }}</td>
                <td class="align-middle">
                    <a data-toggle="tooltip" data-placement="top" title="Edit this pilot" href="{{route('pilot.edit', ['id' => $pilot->pilotId])}}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
