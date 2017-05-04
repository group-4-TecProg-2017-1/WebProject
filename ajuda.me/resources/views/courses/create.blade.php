@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) != 0)
                <div class="alert alert-danger" role="alert">
                    Os seguintes erros impedem o cadastro de curso:
                    @foreach($errors as $error)
                        <br>
                        - {{$error}}
                    @endforeach

                </div>
            @else

            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Create course</div>
                <div class="panel-body">
                    <form class="" action="/courses" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputId">ID:</label>
                            <input type="text" name="id" maxlength="6" class="form-control" id="inputId" placeholder="Enter ID">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name:</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter name">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection