@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create monitoring</div>
                <div class="panel-body">
                    <form class="" action="/courses" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputId">ID:</label>
                            <input type="text" name="id" maxlength="6" class="form-control" id="inputId" placeholder="Enter ID">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Monitoring Place:</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Content Approached:</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Start Time:</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Duration Time:</label>
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
