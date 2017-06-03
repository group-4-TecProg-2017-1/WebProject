<!DOCTYPE html>
@extends('layouts.master')

<body>

  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : 'your-app-id',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   </script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Monitoring Details</div>
                <div class="panel-body">

                        <div class="form-group">
                            <label for="inputContentApproached">Content Approached:</label>
                            <p>{{$monitoring->contentApproached}}</p>
                        </div>

                        <hr></hr>
                        <div class="form-group">
                            <label for="inputType">Type:</label>
                            <p>{{$monitoring->type}}</p>
                        </div>

                        <hr></hr>
                        <div class="form-group">
                            <label for="inputTime">Start Time</label>
                            <p>{{$monitoring->startTime}}</p>
                        </div>

                        <hr></hr>
                        <div class="form-group">
                            <label for="inputDuration">Duration</label>
                            <p>{{$monitoring->duration}}</p>
                        </div>

                        <hr></hr>
                        <div class="form-group">
                            <label for="inputDuration">Location</label>
                                @if ($locations->count())
                                    @foreach ($locations as $location)
                                        <p>{{ $location->description }}</p>
                                        <p><strong>Building:</strong>  {{ $location->building }}</p>
                                        <p><strong>Room:</strong>  {{ $location->room }}</p>
                                    @endforeach
                                @else
                                  <!-- Nothing to show -->
                                @endif
                        </div>

                        <hr></hr>
                        <div class="form-group">
                            <label for="inputDuration">Courses</label>
                                @if ($courses->count())
                                    @foreach ($courses as $course)
                                        <p><strong>ID:</strong>  {{ $course->id }}</p>
                                        <p><strong>Course:</strong>  {{ $course->name }}</p>
                                    @endforeach
                                @else
                                  <!-- Nothing to show -->
                                @endif
                        </div>

                        <hr></hr>
                        <div class="form-group">
                            <label for="inputDuration">Monitors</label>
                                @foreach ($monitors as $monitor)
                                  <p><strong>Name:</strong>  {{$monitor->name}}</p>
                                @endforeach
                        </div>

                        <hr></hr>
                        <div class="fb-like" data-href="{{Request::fullUrl()}}" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                        <hr></hr>

                        <!--Facebook Comment Section -->
                            <div id="fb-root"></div>
                              <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9";
                                fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                              </script>

                            <div class="fb-comments" data-href="{{Request::fullUrl()}}" data-numposts="5"></div>

                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


</body>

</html>
