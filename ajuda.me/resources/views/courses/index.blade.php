@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Courses</div>

                <div class="panel-body">
                    <table align="left">
                        @if (count($courses) != 0)
                            <th> </th>
                            <th>ID</th>
                            <th>Name</th>
                        @else
                            <!-- Nothing to show -->
                        @endif
                        @foreach ($courses as $course)
                            <tr>
                                <td width="10%" >
                                    <a href="/courses" class="btn btn-danger" onclick="">
                                        Delete
                                    </a>
                                </td>
                                <td width="10%">
                                    {{ $course->id }}
                                </td>
                                <td width="50%">
                                    <a href="/courses/{{$course->id}}">
                                        {{ $course->name }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="panel-body" >
                    <a href="/courses/create" class="btn btn-success" >
                        Create new course
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
