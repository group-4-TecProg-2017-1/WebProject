@extends('layouts.custom')
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
        <!-- Ubuntu / Body Font -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>

    <section id="home">     
        
            <div id="slitSlider" class="">
                <div>
                    
                    <!-- single slide item -->
                    <div data-orientation="horizontal" >
                        <div class="sl-slide-inner">
                            <div class="bg-img bg-img-1"></div>
                        <div class="carousel-caption">
                            <div>
                                <img class="wow fadeInUp" src="{{ asset('img/ajudame-title.png') }}" alt="Meghna">

                                 <div class="flex-center position-ref full-height">

                                    <div class="row">
                                        <div class="col-md-6 col-centered login">
            
                                            <form class="form-horizontal col-centered" role="form" method="POST" action="{{ route('login') }}">
                                                {{ csrf_field() }}

                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                                    <div class="col-md-6 col-centered">
                                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                                    <div class="col-md-6 col-centered">
                                                         <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-8 col-centered">
                                                        <button type="submit" class="btn btn-primary">
                                                            Login
                                                        </button>
                                                    </div>

                                                    <a class="small" href="{{ route('password.request') }}">
                                                        <h5>Forgot Your Password?</h5>
                                                    </a>
                                                    <a class="small" href="/register">
                                                        <h5>Register</h5>
                                                    </a>
                                                </div>
                                            </form>    
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            

            </div>
        </section>