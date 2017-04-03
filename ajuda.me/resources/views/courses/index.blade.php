@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Courses</div>

                <div class="panel-body">
                    <table align="left">
                        @foreach ($courses as $course)
                            <tr>
                                <td width="10%">{{ $course->id }}</td>
                                <td width="50%"><a href="/showcourse/{{$course->id}}">{{ $course->name }}</a></td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
