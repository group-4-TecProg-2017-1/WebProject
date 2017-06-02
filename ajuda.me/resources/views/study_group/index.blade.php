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
	                        <th width="30%">Content Approached</th> 
	                        <th width="20%">Start Time</th>
	                        <th width="20%">Duration</th>
	                        <th width="20%">Location</th>
                        </tr>
                        @foreach($study_groups as $study_group)
							<tr>
								<td>study_group</td>
								<td>conteudo abordado</td>
								<td>hora de início</td>
								<td>duração</td>
								<td>location</td>
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