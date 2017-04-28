@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$monitor->id}}</div>
                        <div class="panel-body">
                            <table align="left">
                                <tr>
                                    <td width="50%">
                                        Monitor's ID:
                                    </td>
                                    <td width="40%">
                                        {{$monitor->id}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
