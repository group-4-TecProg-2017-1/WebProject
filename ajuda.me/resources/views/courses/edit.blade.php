@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) != 0)
                <div class="alert alert-danger" role="alert">
                    Os seguintes erros impedem a alteração do curso:
                    @foreach($errors as $error)
                        <br>
                        - {{$error}}
                    @endforeach

                </div>
            @else
                <!-- nothing to so -->
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Edit course</div>
                <div class="panel-body">
                    <form class="" action="/courses/edit" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputId">ID:</label>
                            <input type="text" name="id" maxlength="6" class="form-control" id="inputId" value="{{$course_id}}" >
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name:</label>
                            <input type="text" name="name" class="form-control" id="inputName" value="{{$name}}">
                        </div>
                        <input type="hidden" name="old_id" value="{{$course_id}}">
                        <input type="hidden" name="old_name" value="{{$name}}">

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection