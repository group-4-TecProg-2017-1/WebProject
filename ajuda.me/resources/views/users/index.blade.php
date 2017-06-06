@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    <!-- If there are users in database -->
                    @if (count($users) != 0)
                        <table>
                            <th width="20%">Name</th>
                            <th width="40%">Email</th>
                            <th width="20%">Role</th>
                            <th width="20%" colspan="2">Actions</th>
                            <!-- Retrieves information for each user in
                            database -->
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        <a href="/users/{{$user->id}}/edit" class="btn btn-warning" style="background-color:#00FF7F;color:white;">Update</a>
                                    </td>
                                    <td>
                                        <a href="/users/{{$user->id}}/delete" onclick="return confirm('Are you sure you want to delete the user {{ $user->name }}?')" class="btn btn-danger" style="background-color:#FF6347;color:white;">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <!-- Nothing will be showed if there isn't users in
                        database -->
                    @endif
                </div>

               
                <div class="panel-body">
                    <a class="btn btn-success" href="/users/create">Create new user</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
