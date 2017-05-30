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
                <div class="panel-heading">Monitorings</div>

                <div class="panel-body">
                    @if (count($monitorings) != 0)
                        <table>
                            <th width="20%">Content Approached</th>
                            <th width="20%">Course</th>
                            <th width="40%">Start Time</th>
                            <th width="20%">Duration</th>
                            <th width="20%">Location</th>
                            <th width="20%"></th>
                            <th width="20%" colspan="2">Actions</th>
                            @foreach ($monitorings as $monitoring)
                                <tr>
                                    <td>{{$monitoring->contentApproached}}</td>
                                    @if ($courses->count())
                                        @foreach ($courses as $course)
                                            @if ($course->id == $monitoring->id_courses)
                                              <td>{{$course->name}}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                    <td>{{$monitoring->startTime}}</td>
                                    <td>{{$monitoring->duration}}</td>
                                    @if ($locations->count())
                                        @foreach ($locations as $location)
                                            @if ($location->id == $monitoring->id_location)
                                              <td>{{$location->description}}, {{$location->building}}, {{$location->room}}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                    <td>
                                        <a href="/monitorings/{{$monitoring->id}}/edit" class="btn btn-warning" style="background-color:#00FF7F;color:white;">Update</a>
                                    </td>
                                    <td>
                                        <a href="/monitorings/{{$monitoring->id}}/delete" onclick="return confirm('Are you sure you want to delete the monitoring?')" class="btn btn-danger" style="background-color:#FF6347;color:white;">Delete</a>
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
                          <a class="btn btn-success" href="/monitorings/create">Create new monitoring</a>
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
