@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Study Group

                </div>
                	


            	<div class="panel-body">
                    <table>
                    	<tr>
	                    	<th width="30%">Creator's email:</th> 
	                        <th width="28%">Content Approached</th> 
	                        <th width="20%">Start Time</th>
	                        <th width="17%">Duration</th>
	                        <th width="20%">Location</th>
                        </tr>
                        @foreach($study_groups as $study_group)
							<tr>
								<td>{{$study_group->email_user_creator}}</td>
								<td>{{$study_group->contentApproached}}</td>
								<td>{{$study_group->startTime}}</td>
								<td>{{$study_group->duration}}</td>
								<td> 
                                    {{$buildings[$study_group->id_location]}}
                                    {{$rooms[$study_group->id_location]}}
                                    
                                </td>
							</tr>
						@endforeach
                    </table>
            	</div>

            	
                <div class="panel-body" >
                    <a href="/study_group/create" class="btn btn-success" >
                        Create study group
                    </a>
                </div>           
            </div>
        </div>
    </div>
</div>

@endsection