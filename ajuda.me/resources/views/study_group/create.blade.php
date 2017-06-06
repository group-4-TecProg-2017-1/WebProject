@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Study Group</div>


                <div class="panel-body">
                    <form class="" action="/study_group/store" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputContentApproached">Content Approached:</label>
                            <input type="text" name="fieldOfContentAproached" class="form-control" id="inputName" placeholder="Enter the Monitoring's Content Approached">
                        </div>


                        <div class="form-group">
                            <label for="inputTime">Start Time</label>
                            <input type="datetime-local" name="fieldOfStartTime" class="form-control" id="inputName">
                        </div>

                        <div class="form-group">
                            <label for="inputDuration">Duration</label>
                            <input type="time" name="fieldOfDuration" class="form-control" id="inputName">
                        </div>

                        <div class="form-group">
                            <label for="inputDuration">Location</label>
                            <select class="form-control chosen-select" name="location_id">
                                 @if ($locations->count())

                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" {{ $selectedLocation == $location->id ? 'selected="selected"' : '' }}>{{ $location->room}} , {{$location->building }}</option>
                                    @endforeach    

                                @endif
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>


                

               
            </div>
        </div>
    </div>
</div>

@endsection