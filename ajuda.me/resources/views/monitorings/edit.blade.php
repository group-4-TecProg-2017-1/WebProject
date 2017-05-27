@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Monitoring</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="/monitorings/{{ $monitoring->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="inputContentApproached">Content Approached:</label>
                            <input type="text" name="contentApproached" class="form-control" id="inputName" placeholder="Enter the Monitoring's Content Approached">
                        </div>

                        <div class="form-group">
                            <label for="inputType">Type:</label>
                            <input type="text" name="type" class="form-control" id="inputName" placeholder="Enter the Monitoring's type">
                        </div>

                        <div class="form-group">
                            <label for="inputTime">Start Time</label>
                            <input type="datetime-local" name="startTime" class="form-control" id="inputName">
                        </div>

                        <div class="form-group">
                            <label for="inputDuration">Duration</label>
                            <input type="time" name="duration" class="form-control" id="inputName">
                        </div>

                        <div class="form-group">
                            <label for="inputDuration">Location</label>
                            <select class="form-control chosen-select" name="location_id">

                                @if ($locations->count())

                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" {{ $selectedLocation == $location->id ? 'selected="selected"' : '' }}>{{ $location->description }}</option>
                                    @endforeach

                                @endif

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputDuration">Courses</label>
                            <select class="form-control chosen-select" name="course_id">

                                @if ($courses->count())

                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" {{ $selectedCourse == $course->id ? 'selected="selected"' : '' }}>{{ $course->name }}</option>
                                    @endforeach

                                @endif

                            </select>
                        </div>

                        <div class="form-group">
                            <select multiple="multiple" name="monitors[]" id="monitor_id" class="form-control chosen-select">
                                @foreach($monitors as $monitor)
                                        <option value="{{ $monitor->id }}" {{ $selectedMonitors == $monitor->id ? 'selected="selected"' : '' }}>{{ $monitor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="/users" class="btn">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
