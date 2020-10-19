@extends('mentor.mentor_layout')
@section('content')
<div class="col-md-12">
    <!-- /.info-box -->
    <div class="info-box bg-green" style="border-radius:15px;">
        <span class="info-box-icon">
            @if(Auth::guard('mentor')->user()->photo)
            <img src="{{Auth::guard('mentor')->user()->photo}}"  alt="User Image">
            @else
            <img src="{{asset('dist/img/images/default.png')}}"  alt="User Image">
            @endif
            </span>

        <div class="info-box-content">
            <h2 style="font-family: serif;">Welcome !!</h2>
            <span class="info-box-number">@auth <h1 style="font-family: serif;">{{Auth::guard('mentor')->user()->firstName}} {{Auth::guard('mentor')->user()->lastName}}@endauth</h1></span> 
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.box -->
</div>
<div class="col-md-12">
    <div class="block black bg-white">
        <div class="sub_category_view">
            <ul style="padding: 15px 10px 30px;">
                <li class="category_overview" style="padding-left: 0px; text-align: center;">
                    <h1 style="font-size: 30px;font-family: serif;color: #002a5d;font-weight: 900;">Your Profile </h1>
                    <p>{{Auth::guard('mentor')->user()->about}}</p>
                    <p>({{Auth::guard('mentor')->user()->headline}})</p>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop