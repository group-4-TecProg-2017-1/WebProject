@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$course->name}}</div>
                        <div class="panel-body">
                            <table align="left">
                                <tr>
                                    <td width="50%">
                                        Subject:
                                    </td>
                                    <td width="40%">
                                        {{$monitoring->subject}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        Place:
                                    </td>
                                    <td width="40%">
                                        {{$monitoring->place}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        Starting time:
                                    </td>
                                    <td width="40%">
                                        {{$monitoring->starting_time}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        Duration:
                                    </td>
                                    <td width="40%">
                                        {{$monitoring->duration}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        @if (count($monitors)==1)
                                            Monitor:
                                        @else
                                            Monitors:
                                        @endif
                                    </td>
                                    <td width="40%">
                                            @foreach ($monitors as $monitor)
                                                {{ $monitor->name }}<br>
                                            @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection