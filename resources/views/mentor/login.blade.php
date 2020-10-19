@extends('layouts.app')
@section('content')

<div class="admin_login_wrap mentor_log" style="background-image: url({{asset('dist/img/images/mentor-bg.jpg')}})">
  <div class="admin_login_container">
    <div class="mentor_login_div">
      <div ng-controller="login_controller">
          <h2>द्रोण Login</h2>
          <form name="official_login" method="POST" action="{{ route('mentor.login.submit') }}">
            {{ csrf_field() }}
               
              <div class="">
                  <ul>
                      <li>
                        <!-- <label for="uname"><b>Email Id</b></label> -->
                        <input type="email" placeholder="Enter email id" name="email" required>
                        @if ($errors->has('email'))
      			              <span class="help-block">
      			                  <strong>{{ $errors->first('email') }}</strong>
      			              </span>
      			            @endif
                      </li>
                    <li>
                      <!-- <label for="upass"><b>Password</b></label> -->
                      <input type="password" placeholder="Enter Password" name="password" required>
                   </li>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    @endif
                    <li><button type="submit">Login</button></li>
                  </ul>
              </div>

              <div class="signup">
                  <p>Don’t have an account?</p>
                  <a href="{{url('mentor/register')}}">Sign Up Now</a>
              </div>
              <div class="signup">
                  <p>Forgot Password?</p>
                  <a href="{{url('mentor/password/reset')}}">Reset Now</a>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
@stop