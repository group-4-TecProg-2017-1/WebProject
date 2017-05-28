@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tags</div>

                <div class="panel-body">
                    <table align="left">
                        @if (count($subjects) != 0)
                            <th>Subject</th>
                        @else
                            <!-- Nothing to show -->
                        @endif
                        @foreach ($subjects as $subject)
                            <tr>
                                <td width="100%">
                                    <a>
                                        {{ $subject->name}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="panel-body">
                    <a href="/tags/create">
                        Criar nova tag.
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection