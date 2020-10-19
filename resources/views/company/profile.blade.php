@extends('company.company_layout')
@section('content')
<?php $company = \App\Company::where('idCompany', '=', Auth::guard('company')->user()->idCompany)->first(); ?>
<div class="panel panel-default">
    <div class="panel-heading">View Profile : <span class="font-semibold">{{ $company->companyName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        <div class="sub_category_view">
           <ul style="padding: 40px 50px 30px;">
                <li class="category_course_id">
                    <h3>Company Name</h3>
                    <div>{{$company->companyName}}</div>
                </li>

                <li class="category_duration">
                    <h3>Company Logo</h3>
                    <div><img src="{{$company->logo or ''}}" height="70px"></div>
                </li>

                <li class="category_overview">
                    <h3>Company Owner Name</h3>
                    <div>{{$company->ownerName}}</div>
                </li>
                @if($company_profile)
                <li class="category_should">
                    <h3>Company Profile</h3>
                    <div><pre style="white-space:pre-wrap;font-size: 17px;font-weight: 400;font-family:Raleway;text-align: justify;border:none;background:#f9f9f9">{{$company_profile->companyProfile}}</pre></div>
                </li>
                
                <li class="category_content">
                    <h3>Location</h3>
                    <div>
                        <ul>
                            <li><span>State</span><div>{{$company_profile->state->stateName or ''}}</div></li>
                            <li><span>District</span><div>{{$company_profile->district->districtName or ''}}</div></li>
                        </ul>
                    </div>
                </li>
                <li class="category_contact">
                    <h3>Point of Contact</h3>
                    <div>
                        <ul>
                            <li><a target="_blank" href="{{$company_profile->website}}"><span>Website</span><div style="color: black;">{{$company_profile->website}}</div></a></li>
                            <li><a href="{{$company_profile->mobile}}"><span>Contact Number</span><div style="color: black;">{{$company_profile->mobile}}</div></a></li>
                            <li><a href="mailto: {{$company->email}}"><span>Mail to</span><div style="color: black;">{{$company->email}}</div></a></li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@stop