@extends('layouts.app')
@section('content')
<style>
.block > .head {
    background:url({{asset('/dist/img/pt.jpg')}});
    }
</style>
<div class="col-md-12">
     <!-- /.info-box -->
    <div class="info-box bg-green" style="background:url({{asset('/dist/img/pt.jpg')}})">
        <span class="info-box-icon"><img src="{{asset('dist/img/avatar5.png')}}" style="border-radius: 40px;" alt="User Image"></span>

        <div class="info-box-content">
            <h4>Welcome !!</h4>
            <span class="info-box-number">@auth <h1>{{ Auth::user()->name }}</p> @endauth</h1>

<!--            <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
            </div>
            <span class="progress-description">
                20% Increase in 30 Days
            </span>-->
        </div>
        <!-- /.info-box-content -->
    </div>
    
    <!-- /.box -->
</div>
<div class="col-md-12">
<div class="block black bg-white">
            <div class="head">Welcome To Admin DashBoard</div>
            <div class="content">
                This is Admin DashBoard

            </div>

        </div>
</div>
@stop