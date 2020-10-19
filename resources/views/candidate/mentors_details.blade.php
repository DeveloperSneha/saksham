@extends('candidate.candidate_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">View Profile : <span class="font-semibold">{{ $mentor->firstName }} {{ $mentor->lastName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">        
        <div class="view_profile" style="padding-top:30px;max-width: none;">
            <div class="profile_container">
                <ul>
                <li>
                    <div class="profile_pic profile_left" style="padding-bottom:0px;position:inherit;width: 16%;">
                        @if(!empty($mentor->photo))
                            <img src="{{$mentor->photo}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                            @else
                            <img src="{{asset('dist/img/images/default.png')}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                        @endif
                    </div>
                    <div class="profile_txt profile_right" style="padding:0; position: initial;width:83%;margin-left:0px">
                    <h2 class="tittle" style="font-size:35px;font-weight:600;text-align: center;"><span>{{$mentor->firstName}}  {{$mentor->lastName}}</span></h2>
                    <div class="prof_location" style="padding-top:0;margin-left:30px">
                        <ul style="text-align:center;">
                            <li style="width: 50%;margin-right: 0;">
                                <h4><strong>Email</strong></h4>
                                <p>{{$mentor->email}}</p>
                            </li>
                            <li style="width: 20%;margin-right: 0;">
                                <h4><strong>Phone</strong></h4>
                                <p>{{$mentor->mobile}}</p>
                            </li>        
                            <li style="width: 22%;margin-right: 0;">
                                <h4><strong>Date of Birth</strong></h4>
                                <p>{{$mentor->dob}}</p>
                            </li>
                        </ul>
                    </div>
                    </div>
                </li>
            </ul>
            </div>
        </div>
        <h2 class="candidate_txt" style="font-size:23px;" style="font-size:23px;"><span  class="line-center">About</span></h2><br>
            <div style="text-align:center">{{$mentor->about}}</div>
        <h2 class="candidate_txt" style="font-size:23px;" style="font-size:23px;"><span  class="line-center">Headline</span></h2><br>
               <div style="text-align:center"> {{$mentor->headline}} </div>
        <h2 class="candidate_txt" style="font-size:23px;" style="font-size:23px;"><span  class="line-center">Social Details</span></h2><br>
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4><strong>Website</strong></h4>
                    <p>{{$mentor->personalWebsite}}</p>
                </li>
                <li>
                    <h4><strong>Facebook Url</strong></h4>
                    <p>{{$mentor->facebookUrl}}</p>
                </li>        
                <li>
                    <h4><strong>Twitter Url</strong></h4>
                    <p>{{$mentor->twitterUrl}}</p>
                </li>
                <li>
                    <h4><strong>Linkedin Url</strong></h4>
                    <p>{{$mentor->twitterUrl}}</p>
                </li>
            </ul>
        </div> 
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4><strong>Youtube Url</strong></h4>
                    <p>{{$mentor->youtubeUrl}}</p>
                </li>
                <li>
                    <h4><strong>Languages</strong></h4>
                    <p>{{ucfirst($mentor->languages)}}</p>
                </li>
                <li>
                    <h4><strong>Gender</strong></h4>
                    <p>{{ucfirst($mentor->gender->genderName)}}</p>
                </li>
            </ul>
        </div> 
        <h2 class="candidate_txt" style="font-size:23px;"><span  class="line-center">Academic Skills</span></h2><br>
        <table border="4px" id="detail_table" class="table table-bordered" style="background: lightgray;">
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Higher Qualification</td>
                    <td>{{$mentor->qualification->qName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Sector</td>
                    <td>@foreach ($mentor->mentor_skill as $val){{$val->jobrole->sector->sectorName}}@endforeach</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Job Role</td>
                    <td>@foreach ($mentor->mentor_skill as $val){{$val->jobrole->jobRoleName}}@endforeach</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Experience</td>
                    <td>@foreach ($mentor->mentor_skill as $val){{$val->experience->experienceName}}@endforeach</td>
                </tr>
        </table>
    </div>
</div>
@stop