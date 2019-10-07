<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Description</th>
                <th scope="col">Created date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <th scope="row">{{$class->classId }}</th>
                <td>{{$class->name }}</td>
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
                <td class="align-middle">
                    <a data-toggle="tooltip" data-placement="top" title="Edit this class" href="{{route('class.edit', ['id' => $class->classId])}}"
                        class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
