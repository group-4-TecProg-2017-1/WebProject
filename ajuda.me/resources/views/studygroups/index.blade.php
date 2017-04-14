@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Grupos de estudo</div>

                <div class="panel-body">
                    <table align="left">
                        @if (count($studygroups) != 0)
                            <th>Description</th>
                            <th>Subject</th>
                        @else
                            <!-- Nothing to show -->
                        @endif
                        @foreach ($studygroups as $studygroup)
                            <tr>
                                <td width="20%">
                                    <a>
                                        {{ $studygroup->description }}
                                    </a>
                                </td>
                                <td width="50%">
                                    <a>
                                        {{ $studygroup->subjects }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="panel-body">
                    <a href="/groups/create">
                        Criar novo grupo de estudo.
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
