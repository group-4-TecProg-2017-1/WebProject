@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Criar uma nova tag</div>
                <div class="panel-body">
                    <form class="" action="/tags" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputName">Nome:</label>
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
