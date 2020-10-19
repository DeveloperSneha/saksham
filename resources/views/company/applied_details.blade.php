@extends('company.company_layout')
@section('content')
<style>
    .head{display: none;}
    .left{margin-left:8%;}
    .right{margin-left: 8%}
</style>
<style type="text/css" media="print">
    footer{display: none;}
    .panel-heading{display: none;}
    .head{display: inline}
    .panel-body{margin-top: -10px;}
    .left{margin-left:0%;}
    .right{margin-left: 15%}
</style>

<div class="panel panel-default">
    <div class="panel-heading">Details of Applied Job : <a href="javascript:window.print()" target="_blank" style="float:right;background: transparent;padding-left: 3px; padding-right: 3px; color:white; border:1px solid white"> Print Details </a></div>
    <div class="panel-body">
        <div class="head">
            <table class="table table-bordered" border="4px">
                <tr>
                    <th style="text-align:center;"><img src="{{asset('dist/img/images/logo.png')}}" width="150px" height="70px"></th>
                    <th><p style="text-align:center;font-weight: 700;font-size: 22px;">Saksham <br>(Haryana Skill Development Mission)</p></th>
                </tr>
            </table>
        </div>
        @foreach($job_applied as $var)
        
        <div class="view_profile" style="padding-top:30px;max-width: none;">
            <div class="profile_container">
                <ul>
                    <li>
                        <div class="profile_pic profile_left" style="padding-bottom:0px;position:inherit;width: 16%;">
                            @if(!empty($var->candidate->image))
                                <img src="{{$var->candidate->image}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                                @else
                                <img src="{{asset('dist/img/images/default.png')}}" alt="" style="width:145px;height:140px;border: 2px solid lightgray">
                            @endif
                        </div>
                        <div class="profile_txt profile_right" style="padding:0; position: initial;width:83%;margin-left:0px">
                        <h2 class="tittle" style="font-size:35px;font-weight:600;text-align: center;"><span>{{$var->candidate->firstName}}  {{$var->candidate->lastName}}</span></h2>
                        <div class="prof_location" style="padding-top:0;margin-left:0px">
                            <ul style="text-align:center;">
                                <li style="width: 50%;margin-right: 0;">
                                    <h4><strong>Email</strong></h4>
                                    <p>{{$var->candidate->email}}</p>
                                </li>
                                <li style="width: 20%;margin-right: 0;">
                                    <h4><strong>Phone</strong></h4>
                                    <p>{{$var->candidate->mobile}}</p>
                                </li>        
                                <li style="width: 22%;margin-right: 0;">
                                    <h4><strong>Aadhar</strong></h4>
                                    <p>{{$var->candidate->aadhar}}</p>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">            
            <div class="col-xs-12">
                <h2 style="font-size:23px;background: #024a68;border-radius:25px;border:1px solid black;color:white;margin-top:10px;text-align:center;">Personal Details</h2><br>
                <div class="col-xs-5 left">
                    <p class="form-control-static"><strong>Father Name : </strong>{{$var->candidate->fatherName}}</p>
                    <p class="form-control-static"><strong>Mother Name : </strong>{{$var->candidate->fatherName}}</p>
                    <p class="form-control-static"><strong>Date of Birth : </strong>{{$var->candidate->dob}}</p>
                </div>
                <div class="col-xs-5 right">  
                    <p class="form-control-static"><strong>Gender : </strong>{{ucwords($var->candidate->gender->genderName)}}</p>
                    <p class="form-control-static"><strong>Marital Status : </strong>{{$var->candidate->marital_status->status}}</p>                    
                    <p class="form-control-static"><strong>Any Disability : </strong>{{$var->candidate->disabled->status}}</p>
                    <br>
                </div>
                @if($var->candidate->tempstate)
                <div class="col-xs-5 left">                    
                    <p class="form-control-static"><strong>State : </strong>{{$var->candidate->tempstate->stateName}}</p>
                    <p class="form-control-static"><strong>District : </strong>{{$var->candidate->tempdistrict->districtName}}</p>
                    <p class="form-control-static"><strong>Sub District : </strong>{{$var->candidate->tempsubdistrict->subDistrictName}}</p>
                </div>
                <div class="col-xs-5 right">  
                    <p class="form-control-static"><strong>Address: </strong>{{$var->candidate->tempAddress}}</p>
                    <p class="form-control-static"><strong>Pincode : </strong>{{$var->candidate->tempPincode}}</p>
                    <br>
                </div>
                @endif
            </div>
        </div>
        @if($var->candidate->academics)
        <div class="row">            
            <div class="col-xs-12">
                <h2 style="font-size:23px;background: #024a68;border-radius:25px;border:1px solid black;color:white;margin-top:10px;text-align:center;">Academic Qualifications</h2><br>
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
                        @foreach($var->candidate->academics as $val)
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
            </div>
        </div>
        @endif
        @if($answer)
        <div class="row">            
            <div class="col-xs-12">
                <h2 style="font-size:23px;background: #024a68;border-radius:25px;border:1px solid black;color:white;margin-top:10px;text-align:center;">Placement Questionnaire</h2><br>
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
                            <td><?php $option1 = \App\PlacementQuestionOption::where('idOption','=',$answer->q1)->first();?>{{$option1->questions->question}}</td>
                            <td>{{$option1->optionText}}</td>
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
                            <td><?php $sector_ans =\App\SectorAnswer::where('idCandidate','=',$var->idCandidate)->pluck('q4');
                                $option12 = \App\PlacementQuestionOption::whereIn('idOption', $sector_ans)->get();?> @foreach($option12 as $sector) {{$sector->optionText }},@endforeach</td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Reason for choosing these specialisations</td>
                            <td>{{ucwords($answer->q5)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <h2 style="font-size:23px;background: #024a68;border-radius:25px;border:1px solid black;color:white;margin-top:10px;text-align:center;">Applied Job Details</h2><br>
        <table border="4px" id="detail_table" class="table table-bordered" style="background: lightgray;">
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Sector Name</td>
                    <td>{{$var->job->jobrole->sector->sectorName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Job Role Name</td>
                    <td>{{$var->job->jobrole->jobRoleName}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size: 18px;font-weight: 600;width: 35%">Applied Date</td>
                    <td>{{$var->job->created_at->format('F j,Y')}}</td>
                </tr>
        </table>
        @endforeach
    </div>
</div>
@stop