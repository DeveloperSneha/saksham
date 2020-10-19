@extends('layouts.app')
@section('content')

<div class="company_login_wrap comp_log" style="background: url({{asset('dist/img/images/building.jpg')}}) no-repeat; padding: 40px;">
   <div class="company_login_container">
        <div class="company_login_div">
            <div ng-controller="login_controller">
                <div class="login_form_title" style="background: url({{asset('dist/img/images/login-bg.jpg')}}) no-repeat center;">
                    <span class="login100_form_title">
                        Company Login
                    </span>
                </div>
                <form name="official_login" method="POST" action="{{ route('company.login.submit')}}" class="company_login_form">
                    {{ csrf_field()}}
                    <ul class="container">
                        <li><!-- <label for="uname">Email Id</label> -->
                            <input type="email" placeholder="Enter email id" name="email" required></li>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors -> first('email')}}</strong>
                        </span>
                        @endif
                        <li><!-- <label for="upass">Password</label> -->
                            <input type="password" placeholder="Enter Password" name="password" required>
                        </li>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">{{ $error}}</li>
                        @endforeach
                        @endif

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button type="submit" class="login100-form-btn">
                                    Login
                                </button>
                            </div>
                        </div>
                        <div class="psw center pt20"><a href="{{url('company/register')}}">Register your company?</a></div>
                        <div class="psw center pt20" style="padding-bottom:9px;"><a href="{{url('company/password/reset')}}">Forgot Password?</a></div>
                    </ul>

                </form>
            </div>
        </div>
    </div>
</div>
@stop