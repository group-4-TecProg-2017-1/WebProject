@extends('layouts.calendar')

<!-- Styles -->
<link href="{{ asset('css/calendar-main.css') }}" rel="stylesheet">
<link href="{{ asset('css/calendar-page.css') }}" rel="stylesheet">

 <!-- Scripts -->
<script
  src="http://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>

<script src="{{ asset('js/calendar-main.js') }}"></script>
<script src="{{ asset('js/calendar-page.js') }}"></script>



@section('content')
<div class="container">
    <div class="row">



                    <div id='wrap'>

                        <div id='calendar'></div>

                        <div style='clear:both'></div>



    </div>
</div>

@endsection
