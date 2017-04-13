@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    @if (count($users) != 0)
                        <table>
                            <th width="20%">Name</th>
                            <th width="40%">Email</th>
                            <th width="20%">Role</th>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <!-- Nothing to do -->
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
