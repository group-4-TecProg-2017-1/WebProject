@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $course->name }}</div>
                        <div class="panel-body">
                            <table align="left">
                                <tr>
                                    <td width="50%">Content:</td>
                                    <td width="50%"></td>
                                </tr>
                                <tr>
                                    <td width="50%">Place:</td>
                                    <td width="50%"></td>
                                </tr>
                                <tr>
                                    <td width="50%">Starting time:</td>
                                    <td width="50%"></td>
                                </tr>
                                <tr>
                                    <td width="50%">Duration:</td>
                                    <td width="50%"></td>
                                </tr>
                                <tr>
                                    <td width="50%">Monitor:</td>
                                    <td width="50%"></td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop
