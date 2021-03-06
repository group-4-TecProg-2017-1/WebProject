@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Monitors</div>

                <div class="panel-body">
                    <table align="left">
                        @if (count($monitors) != 0)
                            <th>ID</th>
                        @else
                            <!-- Nothing to show -->
                        @endif
                        @foreach ($monitors as $monitor)
                            <tr>
                                <td width="10%">
                                    <a href="/monitors/{{$monitor->id}}">
                                      {{ $monitor->id }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
