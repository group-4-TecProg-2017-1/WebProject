@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Criar um grupo de estudos</div>
                <div class="panel-body">
                    <form class="" action="/groups" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputName">Descricao:</label>
                            <input type="text" name="description" class="form-control" id="inputDescription" placeholder="Enter name">
                        </div>
                         <div class="form-group">
                            <label for="inputName">Lugar:</label>
                            <input type="text" name="place" class="form-control" id="inputPlace" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Conteudos:</label>
                            <input type="text" name="subjects" class="form-control" id="inputSubjects" placeholder="Enter name">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
