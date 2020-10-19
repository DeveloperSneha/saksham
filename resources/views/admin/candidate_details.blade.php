@extends('admin.admin_layout')
@section('content')
<style>
    .head{display:none;}
</style>
<style type="text/css" media="print">
.candidate_info1 ul{padding:8px;}
.sidebar{
  visibility: hidden;
  display: none;
}
.header_wrap{
  visibility: hidden;
  display: none;
}
footer{
  visibility: hidden;
  display: none;
}
.tittle{font-size:15px;}
.view_profile ul li .profile_pic img{
    width: 100px;
    height: 80px;
}
.candidate_info{padding:10px;}
.col-sm-10{width:100%;float:left;}
.whole_content_wrap{padding:0;}
.print{visibility: hidden;
  display: none;}
.profile_txt {position:none;}
.view_profile ul li .profile_right{margin-left:5px;}
.head{display:inline;}
.view_profile ul li .profile_txt h2{font-size: 15px;}
</style>

<div class="panel panel-default">
    <div class="panel-heading">Candidates List : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <div class="head">
            <table class="table table-bordered" border="4px">
	            <tr>
	                <th style="text-align:center;"><img src="{{asset('dist/img/images/logo.png')}}" width="190px" height="80px"></th>
	                <th><h2 style="text-align:center;">Saksham <br>(Haryana Skill Development Mission)</h2></th>
	            </tr>
	        </table>
        </div>
        <div class="view_profile" style="margin:0;max-width: none;">
            <div class="profile_container">
            	<ul>
	                <li>
	                    <div class="profile_pic profile_left" style="padding-bottom:0px;position:inherit;width: 16%;">
	                        @if($candidate->image!=null)
                            <img src="{{$candidate->image}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                            @else
                            <img src="{{asset('dist/img/images/default.png')}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                            @endif
	                    </div>
	                    <div class="profile_txt profile_right" style="padding:0; position: initial;width:83%;margin-left:0px">
	                        <a class="print" href="javascript:window.print()" style="float:right; margin-right:20px;background: #152032;color: white;border-radius: 7px;padding:7px;font-weight: 700;">Print</a>
	                    <h2 class="tittle" style="font-size:35px;text-align: center;"><span>{{$candidate->firstName}} {{$candidate->lastName}}</span></h2>
	                    <div class="prof_location" style="padding-top:0;margin-left:30px">
	                        <ul style="text-align:center;">
	                            <li style="width: 50%;margin-right: 0;">
	                                <h4>Email</h4>
	                                <p>{{$candidate->email}}</p>
	                            </li>
	                            <li style="width: 20%;margin-right: 0;">
	                                <h4>Phone</h4>
	                                <p>{{$candidate->mobile}}</p>
	                            </li>        
	                            <li style="width: 22%;margin-right: 0;">
	                                <h4>Aadhar</h4>
	                                <p>{{$candidate->aadhar}}</p>
	                            </li>
	                        </ul>
	                    </div>
                    	</div>
	                </li>
            	</ul>
            </div>
        </div>
        <h2 class="candidate_txt"><span  class="line-center">Personal Details</span></h2>
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4>Father Name</h4>
                    <p>{{$candidate->fatherName}}</p>
                </li>
                <li>
                    <h4>Mother Name</h4>
                    <p>{{$candidate->motherName}}</p>
                </li>        
                <li>
                    <h4>Date of Birth</h4>
                    <p>{{$candidate->dob}}</p>
                </li>
                <li>
                    <h4>Gender</h4>
                    <p>{{$candidate->gender->genderName}}</p>
                </li>
            </ul>
        </div>
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4>State</h4>
                    <p>{{$candidate->state->stateName or ''}}</p>
                </li>
                <li>
                    <h4>District</h4>
                    <p></p>
                </li>        
                <li>
                    <h4>Block</h4>
                    <p></p>
                </li>
                <li>
                    <h4>Tehsil</h4>
                    <p></p>
                </li>
            </ul>
        </div>
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4>Marital Status</h4>
                    <p>{{$candidate->maritalStatus->status or ''}}</p>
                </li>
                <li>
                    <h4>Differently Abled</h4>
                    <p></p>
                </li>        
                <li>
                    <h4>Pan Number</h4>
                    <p>{{$candidate->pan}}</p>
                </li>
                <li>
                    <h4>Pin Code</h4>
                    <p>{{$candidate->pincode}}</p>
                </li>
            </ul>
        </div>
        <h2 class="candidate_txt"><span  class="line-center">Education Details</span></h2>
        <div class="candidate_info" >
            <table border="4px" id="detail_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th><h4>Qualification</h4></th>
                        <th><h4>Institution Name</h4></th>
                        <th><h4>Percentage</h4></th>
                        <th><h4>Passed Year</h4></th>
                        <th><h4>District</h4></th>
                        <th><h4>Medium</h4></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($candidate->academics as $academic)
                    <tr>
                        <td>{{$academic->qualification->qName}}</td>
                        <td>{{$academic->university->universityName}}</td>
                        <td>{{$academic->percentage}}</td>
                        <td>{{$academic->passedYear}}</td>
                        <td>{{$academic->district->districtName or ''}}</td>
                        <td>{{$academic->medium->mediumName}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(count($candidate->enrolled_course)>0)
        <h2 class="candidate_txt"><span  class="line-center">Enrolled Course </span></h2>
        <div class="candidate_info" >
            <table border="4px" id="detail_table" class="table table-bordered">
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;">Sector</td>
                    <td>{{$candidate->enrolled_course->jobrole->sector->sectorName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;">Job Role</td>
                    <td>{{$candidate->enrolled_course->jobrole->jobRoleName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;">Enrolled Date</td>
                    <td>{{$candidate->enrolled_course->created_at->format('F j,Y')}}</td>
                </tr>
            </table>
        </div>
        @endif
        @if(count($candidate->jobapplied)>0)
        <h2 class="candidate_txt"><span  class="line-center">Applied For Job</span></h2>
        <div class="candidate_info" >
            <table border="4px" id="detail_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th><h4>Company Name</h4></th>
                        <th><h4>Sector</h4></th>
                        <th><h4>Job Role</h4></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidate->jobapplied as $val)
                   <tr>
                        <td>{{$val->Job->company->companyName}}</td>
                        <td>{{$val->job->jobrole->sector->sectorName}}</td>
                        <td>{{$val->job->jobrole->jobRoleName}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <h2 class="candidate_txt"><span  class="line-center">Placements Questionnaire </span></h2>
        <div class="candidate_info" >
            <table border="4px" id="detail_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SNo.</th>
                        <th>Questions</th>
                        <th>Answers</th>
                    </tr>
                </thead>
                <?php
                $answer =\App\CandidateAnswer::where('idCandidate','=',$candidate->idCandidate)->first();
                ?>
                @if($answer)
                <tbody>
                        <tr>
                            <td>1</td>
                            <td><?php $option1 = \App\PlacementQuestionOption::where('idOption','=',$answer->q1)->first();?>{{$option1->questions->question}}</td>
                            <td>{{$answer->q1}}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><?php $option2 = \App\PlacementQuestionOption::where('idOption','=',$answer->q2)->first();?>{{$option2->questions->question}}</td>
                            <td>{{$option2->optionText}}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><?php $option3 = \App\PlacementQuestionOption::where('idOption','=',$answer->q3)->first();?>{{$option3->questions->question}}</td>
                            <td>{{$option3->optionText}}</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><?php $option4 = \App\PlacementQuestionOption::where('idOption','=',$answer->q6)->first();?>{{$option4->questions->question}}</td>
                            <td>{{$option4->optionText}}</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><?php $option5 = \App\PlacementQuestionOption::where('idOption','=',$answer->q7)->first();?>{{$option5->questions->question}}</td>
                            <td>{{$option5->optionText}}</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><?php $option6 = \App\PlacementQuestionOption::where('idOption','=',$answer->q8)->first();?>{{$option6->questions->question}}</td>
                            <td>{{$option6->optionText}}</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><?php $option7 = \App\PlacementQuestionOption::where('idOption','=',$answer->q9)->first();?>{{$option7->questions->question}}</td>
                            <td>{{$option7->optionText}}</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><?php $option8 = \App\PlacementQuestionOption::where('idOption','=',$answer->q10)->first();?>{{$option8->questions->question}}</td>
                            <td>{{$option8->optionText}}</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td><?php $option9 = \App\PlacementQuestionOption::where('idOption','=',$answer->q11)->first();?>{{$option9->questions->question}}</td>
                            <td>{{$option9->optionText}}</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td><?php $option10 = \App\PlacementQuestionOption::where('idOption','=',$answer->q12)->first();?>{{$option10->questions->question}}</td>
                            <td>{{$option10->optionText}}</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td><?php $option11 = \App\PlacementQuestionOption::where('idOption','=',$answer->q13)->first();?>{{$option11->questions->question}}</td>
                            <td>{{$option11->optionText}}</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Please selct the training and skill development areas that are most interesting to you </td>
                            <td><?php $sector_ans =\App\SectorAnswer::where('idCandidate','=',$candidate->idCandidate)->pluck('q4');
                                $option12 = \App\PlacementQuestionOption::whereIn('idOption', $sector_ans)->get();?> @foreach($option12 as $sector) {{$sector->optionText }},@endforeach</td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Reason for choosing these specialisations</td>
                            <td>{{ucwords($answer->q5)}}</td>
                        </tr>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
@stop