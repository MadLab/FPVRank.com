<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Created date</th>                
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <th scope="row">{{$class->classId }}</th>
                <td>{{$class->name }}</td>
                <td>{{$class->description}}</td>
                <td>{{$class->created_at }}</td>                             
                <td><a href="{{route('class.edit', ['id' => $class->classId])}}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>