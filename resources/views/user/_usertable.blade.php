<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created date</th>                
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id }}</th>
                <td>{{$user->name }}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at }}</td>                             
                <td><a href="{{route('user.edit', ['id' => $user->id])}}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>