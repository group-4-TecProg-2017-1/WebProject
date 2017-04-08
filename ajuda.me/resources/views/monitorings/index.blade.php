@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Monitorings</div>

                <div class="panel-body">
                    <table align="left">
                        @if (count($monitorings) != 0)
                            <th>ID</th>
                            <th>Monitoring Place</th>
                            <th>Content approached</th>
                            <th>Start Time</th>
                            <th>Duration Time</th>
                        @else
                            <!-- Nothing to show -->
                        @endif
                        @foreach ($monitorings as $monitoring)
                            <tr>
                                <td width="10%">
                                    {{ $monitoring->id }}
                                </td>
                                <td width="50%">
                                    <a href="/monitorings/{{$monitoring->id}}">
                                        {{ $monitoring->Place }}
                                    </a>
                                </td>
                                <td width="50%">
                                    <a href="/monitorings/{{$monitoring->id}}">
                                        {{ $monitoring->contentApproached }}
                                    </a>
                                </td>
                                <td width="50%">
                                    <a href="/monitorings/{{$monitoring->id}}">
                                        {{ $monitoring->durationTime}}
                                    </a>
                                </td>
                                <td width="50%">
                                    <a href="/monitorings/{{$monitoring->id}}">
                                        {{ $monitoring->startTime }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="panel-body">
                    <a href="/monitorings/create">
                        Create new monitoring
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
