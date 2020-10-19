@extends('layouts.app')
@section('content')
<div class="admin_login_wrap adin_log" style="background: url({{asset('dist/img/images/bg-01.jpg')}}) no-repeat">
  <div class="admin_login_container">
    <div class="admin_login_div">
      <span class="fa fa-user"></span>
      <div ng-controller="login_controller">
          <h2>Saksham Darpan Login</h2>
          <form name="official_login" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
              <div class="">
                  <div class="search_inputs">
                      <div class="official_login_type_div" ng-init="login_type='admin'">
                          <ul>
                              <li class="official_login_txt"><b>Login As</b></li>
                              <li>
                                  <input type="radio" id="login_type_admin" name="login_type" value="admin" >
                                  <label for="login_type_admin">Admin</label>
                              </li>
                              <li>
                                  <input type="radio" id="login_type_manager" name="login_type"  value="manager">
                                  <label for="login_type_manager">Manager</label>
                              </li>
                              <li>
                                  <input type="radio" id="login_type_deo" name="login_type"  value="deo">
                                  <label for="login_type_deo">DEO</label>
                              </li>
                          </ul>
                      </div>
                  </div>

                  <input type="text" placeholder="Enter Username" name="email" required>
                  
                  <input type="password" placeholder="Enter Password" required name="password">
                  @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                  @endif
                  <button type="submit">Login</button>
                  <br>
                  <br>
                  <a style="color: #f4f1ed" href="#">Forgot Password?</a>
              </div>

          </form>
      </div>
    </div>
  </div>
</div>
@stop