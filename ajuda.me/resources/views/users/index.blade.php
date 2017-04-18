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
                    @if (count($users) != 0)
                        <table>
                            <th width="20%">Name</th>
                            <th width="40%">Email</th>
                            <th width="20%">Role</th>
                            <th width="20%" colspan="2">Actions</th>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        <a href="/users/{{$user->id}}/edit" class="btn btn-warning">Update</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <!-- Nothing to do -->
                    @endif

                </div>

                <div class="panel-body">
                  <a href="/users/create">Create new user</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
