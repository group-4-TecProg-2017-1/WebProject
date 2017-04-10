@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create monitoring</div>
                <div class="panel-body">
                    <form class="" action="/monitorings" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="place">Monitoring Place:</label>
                            <input type="text" name="place" class="form-control" id="place" placeholder="Enter place">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter subject">
                        </div>
                        <div class="form-group">
                            <label for="starting_time">Starting time:</label>
                            <input type="text" name="starting_time" class="form-control" id="starting_time" placeholder="Enter starting time">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration time:</label>
                            <input type="text" name="duration" class="form-control" id="duration" placeholder="Enter duration">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
