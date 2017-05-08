@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update user</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="/locations/{{ $location->id }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $location->description }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="room" class="col-md-4 control-label">Room</label>

                            <div class="col-md-6">
                                <input id="room" type="text" class="form-control" name="room" value="{{ $location->room }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="building" class="col-md-4 control-label">Building</label>

                            <div class="col-md-6">
                                <input id="building" type="text" class="form-control" name="building" value="{{ $location->building }}" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="/users" class="btn">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
