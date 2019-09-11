<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Description</th>
                <th scope="col">Created date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <th scope="row">{{$class->classId }}</th>
                <td><a data-toggle="tooltip" data-placement="right" title="Edit this class" href="{{route('class.edit', ['id' => $class->classId])}}">{{$class->name }}</a></td>
                <td>
                    @if ($class->location == "global")
                    Global
                    @endif
                    @foreach ($countries as $key => $country)
                    @if($key == $class->location)
                    <span class="label label-default"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span>
                    {{$country}}
                    @endif
                    @endforeach
                </td>
                <td>{{$class->description}}</td>
                <td>{{$class->created_at }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
