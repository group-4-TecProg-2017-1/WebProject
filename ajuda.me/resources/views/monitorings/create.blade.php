@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Monitoring</div>
                <div class="panel-body">
                    <form class="" action="/monitorings" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputContentApproached">Content Approached:</label>
                            <input type="text" name="contentApproached" class="form-control" id="inputName" placeholder="Enter the Monitoring's Content Approached">
                        </div>

                        <div class="form-group">
                            <label for="inputType">Type:</label>
                            <input type="text" name="type" class="form-control" id="inputName" placeholder="Enter the Monitoring's type">
                        </div>

                        <div class="form-group">
                            <label for="inputBuilding">Start Time</label>
                            <input type="datetime-local" name="startTime" class="form-control" id="inputName">
                        </div>

                        <div class="form-group">
                            <label for="inputBuilding">Duration</label>
                            <input type="time" name="duration" class="form-control" id="inputName">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
