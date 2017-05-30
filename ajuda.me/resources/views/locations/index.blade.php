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
                <div class="panel-heading">Locations</div>

                <div class="panel-body">
                    @if (count($locations) != 0)
                        <table>
                            <th width="20%">Room</th>
                            <th width="40%">Building</th>
                            <th width="20%">Description</th>
                            <th width="20%" colspan="2">Actions</th>
                            @foreach ($locations as $location)
                                <tr>
                                    <td>{{$location->room}}</td>
                                    <td>{{$location->building}}</td>
                                    <td>{{$location->description}}</td>
                                    <td>
                                        <a href="/locations/{{$location->id}}/edit" class="btn btn-warning" style="background-color:#00FF7F;color:white;">Update</a>
                                    </td>
                                    <td>
                                        <a href="/locations/{{$location->id}}/delete" onclick="return confirm('Are you sure you want to delete the location?')" class="btn btn-danger" style="background-color:#FF6347;color:white;">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <!-- Nothing to do -->
                    @endif

                </div>

                @if ($user = Auth::user())
                    @if(strcmp($user->role , 'student') != 0)

                        <div class="panel-body">
                          <a class="btn btn-success" href="/locations/create">Create new location</a>
                        </div>
                       
                    @else
                        <!-- nothing to show -->
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
