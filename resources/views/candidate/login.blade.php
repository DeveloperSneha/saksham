@extends('layouts.app')
@section('content')

<div class="candidate_wrap" style="background: url({{asset('dist/img/images/office.jpg')}}) no-repeat; background-size:cover;padding-bottom: 110px; padding-top: 95px;">
  <div class="candidate_container" style="max-width: 589px;border-radius: 30px; padding: 25px 20px;">
      <div class="login-form" style="width:350px">
        <div class="candidate_form">
          <form name="candidate_login" method="POST" action="{{ route('candidate.login.submit') }}">
            {{ csrf_field() }}
              <h3> Candidate Login</h3> 
            <div class="" style="text-align:center;">
                @if(session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
                @endif
            </div>      
            <div class="form-fields"><i class="fa fa-user" aria-hidden="true"></i>
            	<input class="name-login" type="text" placeholder="Enter mobile number" name="mobile" required>
            	@if ($errors->has('mobile'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('mobile') }}</strong>
	              </span>
	            @endif
            </div>

            <div class="form-fields"><i class="fa fa-lock" aria-hidden="true"></i>
            	<input class="pass-login" type="password" placeholder="Enter Password" name="password" required>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            @endif
            <button type="submit" class="cand_btn" style="margin-top:5px">Login</button>

             <div class="signup" style="color:#737272">
                <p>Don’t have an account?</p>
                <a href="{{url('/candidate/register')}}" style="color:black"><strong>SIGN UP</strong></a>
              </div>

              <div class="signup" style="color:#737272">
                  <p>Forgot Password ?</p>
                  <a href="{{url('candidate/password/reset')}}" style="color:black"><strong>RESET</strong></a>
              </div>

          </form>
        </div>
      </div>
  </div>
</div>
@stop