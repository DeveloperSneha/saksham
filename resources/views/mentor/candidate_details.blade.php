@extends('mentor.mentor_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">View Candidate : <span class="font-semibold">{{ $candidate->firstName }} {{ $candidate->lastName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">        
        <div class="view_profile" style="padding-top:30px;max-width: none;">
            <div class="profile_container">
                <ul>
                <li>
                    <div class="profile_pic profile_left" style="padding-bottom:0px;position:inherit;width: 16%;">
                        @if(!empty($candidate->image))
                            <img src="{{$candidate->image}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                            @else
                            <img src="{{asset('dist/img/images/default.png')}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                        @endif
                    </div>
                    <div class="profile_txt profile_right" style="padding:0; position: initial;width:83%;margin-left:0px">
                    <h2 class="tittle" style="font-size:35px;font-weight:600;text-align: center;"><span>{{$candidate->firstName}}  {{$candidate->lastName}}</span></h2>
                    <div class="prof_location" style="padding-top:0;margin-left:30px">
                        <ul style="text-align:center;">
                            <li style="width: 50%;margin-right: 0;">
                                <h4><strong>Email</strong></h4>
                                <p>{{$candidate->email}}</p>
                            </li>
                            <li style="width: 20%;margin-right: 0;">
                                <h4><strong>Phone</strong></h4>
                                <p>{{$candidate->mobile}}</p>
                            </li>        
                            <li style="width: 22%;margin-right: 0;">
                                <h4><strong>Aadhar</strong></h4>
                                <p>{{$candidate->aadhar}}</p>
                            </li>
                        </ul>
                    </div>
                    </div>
                </li>
            </ul>
            </div>
        </div>
        <h2 class="candidate_txt" style="font-size:23px;" style="font-size:23px;"><span  class="line-center">Personal Details</span></h2><br>
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4><strong>Father Name</strong></h4>
                    <p>{{$candidate->fatherName}}</p>
                </li>
                <li>
                    <h4><strong>Mother Name</strong></h4>
                    <p>{{$candidate->motherName}}</p>
                </li>        
                <li>
                    <h4><strong>Date of Birth</strong></h4>
                    <p>{{$candidate->dob}}</p>
                </li>
                <li>
                    <h4><strong>Gender</strong></h4>
                    <p>{{$candidate->gender->genderName or ''}}</p>
                </li>
            </ul>
        </div>        
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4><strong>Marital Status</strong></h4>
                    <p>{{$candidate->marital_status->status or ''}}</p>
                </li>
                <li>
                    <h4><strong>Differently Abled</strong></h4>
                    <p>{{$candidate->disabled->status or ''}}</p>
                </li>        
                <li>
                    <h4><strong>Pan Number</strong></h4>
                    <p>{{$candidate->pan}}</p>
                </li>
                <li>
                    <h4><strong>Pin Code</strong></h4>
                    <p>{{$candidate->tempPincode}}</p>
                </li>
            </ul>
        </div>
        <div class="candidate_info1">
            <ul>
                <li>
                    <h4><strong>State</strong></h4>
                    <p>{{$candidate->tempstate->stateName or ''}}</p>
                </li>
                <li>
                    <h4><strong>District</strong></h4>
                    <p>{{$candidate->tempdistrict->districtName or ''}}</p>
                </li>        
                <li>
                    <h4><strong>Sub District</strong></h4>
                    <p>{{$candidate->tempsubdistrict->subDistrictName or ''}}</p>
                </li>
                <li>
                    <h4><strong>Address</strong></h4>
                    <p>{{$candidate->tempAddress}}</p>
                </li>
            </ul>
        </div>
        <h2 class="candidate_txt" style="font-size:23px;"><span  class="line-center">Academic Qualifications</span></h2><br>
        <table class="table table-bordered"  style="text-align:center;">
            <thead style="background: lightgray;">
                <tr>
                    <strong>
                        <th style="text-align:center;">SNo</th>
                        <th style="text-align:center;">Qualification</th>
                        <th style="text-align:center;">University/Board</th>
                        <th style="text-align:center;">Percentage</th>
                        <th style="text-align:center;">Passed Year</th>
                        <th style="text-align:center;">Medium</th>
                    </strong>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($candidate->academics as $val)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$val->qualification->qName}}</td>
                    <td>{{$val->university->universityName}}</td>
                    <td>{{$val->percentage}}%</td>
                    <td>{{$val->passedYear}}</td>
                    <td>{{ucwords($val->medium->mediumName)}}</td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
        @if(!empty($candidate->enrolled_course))
        <h2 class="candidate_txt" style="font-size:23px;"><span  class="line-center">Enrolled Course </span></h2><br>
        <table border="4px" id="detail_table" class="table table-bordered" style="background: lightgray;">
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Sector</td>
                    <td>{{$candidate->enrolled_course->jobrole->sector->sectorName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Job Role</td>
                    <td>{{$candidate->enrolled_course->jobrole->jobRoleName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Enrolled Date</td>
                    <td>{{$candidate->enrolled_course->created_at->format('F j,Y')}}</td>
                </tr>
        </table>
        @endif
        @if(!empty($candidate->jobapplied))
        <h2 class="candidate_txt" style="font-size:23px;"><span  class="line-center">Applied For Job</span></h2><br>
        <table class="table table-bordered"  style="text-align:center;">
            <thead style="background: lightgray;">
                <tr>
                    <th style="text-align:center;"><strong>S.No.</strong></th>
                    <th style="text-align:center;"><strong>Company Name</strong></th>
                    <th style="text-align:center;"><strong>Sector</strong></th>
                    <th style="text-align:center;"><strong>Job Role</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($candidate->jobapplied as $applied)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$applied->job->company->companyName}}</td>
                    <td>{{$applied->job->jobrole->sector->sectorName}}</td>
                    <td>{{$applied->job->jobrole->jobRoleName}}</td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
        @endif
        <h2 class="candidate_txt" style="font-size:23px;"><span  class="line-center">Placements Questionnaire </span></h2><br>
        <table class="table table-bordered"  style="text-align:center;">
            <thead style="background: lightgray;">
                <tr>
                    <strong>
                        <th style="text-align:center;">SNo</th>
                        <th style="text-align:center;">Questions</th>
                        <th style="text-align:center;">Answer</th>
                    </strong>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?php $option1 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q1)->first();?>{{$option1->questions->question}}</td>
                    <td>{{$option1->optionText}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><?php $option2 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q2)->first();?>{{$option2->questions->question}}</td>
                    <td>{{$option2->optionText}}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><?php $option3 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q3)->first();?>{{$option3->questions->question}}</td>
                    <td>{{$option3->optionText}}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><?php $option4 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q6)->first();?>{{$option4->questions->question}}</td>
                    <td>{{$option4->optionText}}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><?php $option5 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q7)->first();?>{{$option5->questions->question}}</td>
                    <td>{{$option5->optionText}}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><?php $option6 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q8)->first();?>{{$option6->questions->question}}</td>
                    <td>{{$option6->optionText}}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><?php $option7 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q9)->first();?>{{$option7->questions->question}}</td>
                    <td>{{$option7->optionText}}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><?php $option8 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q10)->first();?>{{$option8->questions->question}}</td>
                    <td>{{$option8->optionText}}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td><?php $option9 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q11)->first();?>{{$option9->questions->question}}</td>
                    <td>{{$option9->optionText}}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td><?php $option10 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q12)->first();?>{{$option10->questions->question}}</td>
                    <td>{{$option10->optionText}}</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td><?php $option11 = \App\PlacementQuestionOption::where('idOption','=',$candidate->candidate_answer->q13)->first();?>{{$option11->questions->question}}</td>
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
                    <td>{{ucwords($candidate->candidate_answer->q5)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop