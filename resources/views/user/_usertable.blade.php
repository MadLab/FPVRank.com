<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
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
                <th scope="row">{{$user->userId }}</th>
                <td>{{$user->name }}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at }}</td>
                <td class="align-middle">
                    <a data-toggle="tooltip" data-placement="top" title="Edit this user" href="{{route('user.edit', ['id' => $user->userId])}}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
