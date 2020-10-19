@extends('layouts.app')
@section('content')
<div class="view_profile">
    <div class="profile_container">
        <ul>
            <li>
                <div class="profile_pic profile_left">
                    @if(!empty($job_details->job->company->logo ))
                        <img style="border-radius: 10px; width: 100%;height:242px;border: 6px solid #025965;" src="{{$job_details->job->company->logo}}"/>
                    @else
                        <img style="border-radius: 10px; width: 100%;height:242px;border: 6px solid #025965;" src="{{asset('dist/img/images/placements/default.jpg')}}" alt="">
                    @endif
                </div>
                <div class="profile_txt profile_right">
                    <h2><span>{{$job_details->job->company->companyName}}</span></h2>
                    <div class="job_description">
                        <ul>
                            <li>
                                <a href="">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fab fa-google-plus-g fa-stack-1x fa-inverse"></i>
                                        </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="prof_location" >
                        <ul>
                          <li style="width: 35%;">
                                <h4 style="font-weight: 600;">Email</h4>
                                <p>{{$job_details->job->company->email}}</p>
                            </li>
                            <li>
                                <h4 style="font-weight: 600;">Contact Number</h4>
                                <p>{{$job_details->job->company->companyprofile->mobile}}</p>
                            </li>
                            <li>
                                <h4 style="font-weight: 600;">Website</h4>
                                <p><?php $pos =stripos($job_details->job->company->companyprofile->website, 'http');
                               ?>
                                    @if($pos == 0)
                                    <a href="<?php echo $job_details->job->company->companyprofile->website; ?>" target="_blank">{{$job_details->job->company->companyprofile->website}}</a>
                                    @else<a href="http://{{$job_details->job->company->companyprofile->website}}" target="_blank">{{$job_details->job->company->companyprofile->website}}
                                    </a>
                                    @endif
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Sector</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->jobrole->sector->sectorName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Job Role</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->jobrole->jobRoleName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Company Profile</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li style="width: 100%;">
                            <span>{{$job_details->job->company->companyprofile->companyProfile}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Job Designation</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li style="width: 100%;"><pre style="display: block; padding: 0px;margin: 0px;font-size: 19px;line-height: 1.42857143;color: #333; word-break: break-all;word-wrap: break-word;background-color: transparent;border: none;font-family:serif;overflow: visible;">{{$job_details->job->designation}}</pre>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Job Description</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li style="width: 100%;"><pre style="display: block; padding: 0px;margin: 0px;font-size: 19px;line-height: 1.42857143;color: #333; word-break: break-all;word-wrap: break-word;background-color: transparent;border: none;font-family:serif;">{{$job_details->job->jobDescription}}</pre>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Required Expertise</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->experience->experienceName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Required Location</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>@foreach($job_details->job->joblocation as $val){{$val->district->districtName}} , @endforeach </span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Required Qualification</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->qualification->qName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Age Limit</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->agelimit->age}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Salary Package</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->salary}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Salary Negotiable</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->salaryNegotiable}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Job Start Date</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->startDate}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Job Is Valid Till</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->toDate}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">Vacancies</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->vacancies}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">HR Name</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->hrName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left" style="padding:5px;">
                    <h4 style="font-weight: 600;">HR Contact Details</h4>
                </div>
                <div class="profile_expertise_txt profile_right" style="padding:5px;">
                    <ul>
                        <li>
                            <span>{{$job_details->job->hrContact}}</span>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="col-sm-12" style="text-align: center;margin:30px;">
        @if(Auth::guard('candidate'))
        {!! Form::open(['method' => 'POST',  'action' => ['Candidate\CandidateController@SaveAppliedJob',$job_details->job->idJob], 'class' => 'form-horizontal']) !!}
            <input type="hidden" ng-model="company_id" name="company_id" value="{{$job_details->job->company->idCompany}}">
            <input type="submit" class="post_new_job_button" value="Apply Now" style="padding-left: 30px;padding-right: 30px;color:white;font-weight:700;width:40%">
        {!! Form::close() !!} 
        @else
        <a href="{{url('/candidate/login')}}" target="_blank" class="post_new_job_button" style="padding-left: 30px;padding-right: 30px;">Apply Here</a>
        @endif
    </div>
</div>

@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="idState"]').on('change', function() {
        var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: "{{url('/state/') }}"+'/' +stateID + "/districts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idDistrict"]').empty();
                        $('select[name="idDistrict"]').append('<option value="">--- Select District ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="idDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="idDistrict"]').empty();
            }
        });
        $('select[name="idSector"]').on('change', function() {
        var sectorID = $(this).val();
            if(sectorID) {
                $.ajax({
                    url: "{{url('/sector/') }}"+'/' +sectorID + "/jobrole",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idJobRole"]').empty();
                        $('select[name="idJobRole"]').append('<option value="">--- Select Job Role ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="idJobRole"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="idJobRole"]').empty();
            }
        });
    });
</script>
@stop