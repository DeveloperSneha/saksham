@extends('company.company_layout')
@section('content')
<div class="col-md-12">
    <!-- /.info-box -->
    <div class="info-box bg-green" style="border-radius:15px;">
        <span class="info-box-icon">
            @if(Auth::guard('company')->user()->logo)
            <img src="{{Auth::guard('company')->user()->logo}}"  alt="User Image">
        @else
        <img src="{{asset('dist/img/images/placements/default.jpg')}}"  alt="User Image">
        @endif</span>

        <div class="info-box-content">
            <h2 style="font-family: serif;">Welcome !!</h2>
            <span class="info-box-number">@auth <h1 style="font-family: serif;">{{Auth::guard('company')->user()->companyName}}</p> @endauth</h1>
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
                    <h1 style="font-size: 30px;font-family: serif;color: #002a5d;font-weight: 900;">Company Profile</h1>
                    <div><pre style="white-space:pre-wrap;font-size: 17px;font-weight: 400;font-family:Raleway;text-align: justify;border:none;background:#f9f9f9;color:#01012f;">
                        @if($company_profile) {{$company_profile->companyProfile}} @endif</pre>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop