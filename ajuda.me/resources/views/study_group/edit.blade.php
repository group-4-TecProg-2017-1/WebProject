@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Study Group</div>


                <div class="panel-body">
                    <form class="" action="/study_group/store" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputContentApproached">Content Approached:</label>
                            <input type="text" name="fieldOfContentAproached" class="form-control" id="inputName" placeholder="Enter the Monitoring's Content Approached" value={{$study_group->contentApproached}}>
                        </div>


                        <div class="form-group">
                            <label for="inputTime">Start Time</label>
                            <input type="datetime-local" name="fieldOfStartTime" class="form-control" id="inputName" value="{{$start_time}}">
                        </div>  
                        
                        <div class="form-group">
                            <label for="inputDuration">Duration</label>
                            <input type="time" name="fieldOfDuration" class="form-control" id="inputName" value="{{$study_group->duration}}">
                        </div>

                            
                        <div class="form-group">
                            <label for="inputDuration">Location</label>
                            <select class="form-control chosen-select" name="location_id">
                                
                                 @if ($locations->count())

                                    @foreach ($locations as $location)

                                       
                                            <option 
                                                @<?php if ($selected_location->id == $location->id): ?>
                                                    selected="true"
                                                <?php endif ?>
                                                value="{{ $location->id }}">{{ $location->room}} , {{$location->building }}
                                            </option>
                                        
                                    @endforeach  
                                @endif  

                            </select>
                            
                        </div>
                          
                        <button type="submit" class="btn btn-primary">Save study group</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection