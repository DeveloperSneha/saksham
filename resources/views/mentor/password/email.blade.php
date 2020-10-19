@extends('layouts.app')
@section('content')
<div class="col-md-12" style="margin:78px;">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Reset Password</div>
            <div class="panel-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('mentor/password/email') }}" style="margin:30px;">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off" maxlength="50">

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" style="margin:30px;">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-warning">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>
                    <div style="text-align:center;"><a href="{{url('\mentor\login')}}">Mentor Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
