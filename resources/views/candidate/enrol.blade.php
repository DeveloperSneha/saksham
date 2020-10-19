@extends('layouts.app')
@section('content')
<div class="candidate_registration" style="margin-top: 0px; padding-top: 0px;font-family: serif; font-size: 15px;border: 2px solid #035b66;width: 92%;margin: 4%;">
    <h2><span style="color:crimson">Candidate Registration</span></h2>
    <ul class="nav nav-tabs process-model more-icon-preocess" id="progressbar" role="tablist">
        <li class="active" id="first"><i class="fas fa-paper-plane"></i><p>Basic Information</p></a></li> 
        <li id="second" ><i class="fa fa-user" aria-hidden="true"></i><p>Personal Information</p></a></li>
        <li id="third"><i class="fa fa-graduation-cap" aria-hidden="true"></i><p>Professional Information</p></a></li>
        <li id="fourth"><i class="fas fa-file"></i><p>Questionnare</p></a></li>
    </ul>
    <div style="display:block" class="candidate_form">
        <form name="official_login" method="POST" action="{{ route('candidate.register.submit')}}" class="form-horizontal" id="enrol" enctype="multipart/form-data" style="padding: 30px;font-family: serif;">
            {{ csrf_field() }}
            <div id='formerrors'></div>
            <div id="sf1" class="frm">
                <fieldset>
                    <center><legend style="padding: 10px;"><h3>Basic Information</h3></legend></center>
                    <div class="search_inputs form-group">
                        <input type="hidden" name="type" value="saksham">
                        {!! Form::label('First Name', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('firstName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="fname1"></span>
                        </div>
                        {!! Form::label('Last Name', null, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('lastName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off']) !!}
                            <span id="lname1"></span>
                        </div>
                    </div>          
                    <div class="search_inputs form-group">
                        {!! Form::label('Father Name', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('fatherName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="father_name1"></span>
                        </div>
                        {!! Form::label('Mother Name', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('motherName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="mother_name1"></span>
                        </div>
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Date of Birth', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('dob', null, ['class' => 'form-control datepicker','onkeypress'=>'return onlyNumbersandSpecialChar(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="dob1"></span>
                        </div>
                        {!! Form::label('Email', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::email('email',null, ['class' => 'form-control','minlength'=>'5','maxlength'=>'100','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="email1"></span>
                        </div>                         
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Mobile Number', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                            {!! Form::text('mobile', null, ['class' => 'form-control','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^(\d)(?!\1+$)\d{9}$',  'pattern'=>'^[6789]\d{9}$','autocomplete'=>'off','id'=>'candidate_mobile','onBlur'=>'getExistingCandidateWithMobile(this);','required'=>'required']) !!}
                            <span id="mobile1"></span>
                            <span  id="mobilenoexist"></span>
                        </div>
                        {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::select('gender', getGender(),null, ['class' => 'form-control','required'=>'required']) !!}
                            <span id="gender1"></span>
                        </div>                                           
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Aadhar Number', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4 {{ $errors->has('aadhar') ? ' has-error' : '' }}{{ $errors->has('aadharabc') ? ' has-error' : '' }}">
                            {!! Form::text('aadhar', null, ['class' => 'form-control','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isNumber(event)', 'pattern'=>'^[2-9]{1}[0-9]{11}$','id'=>'candidate_aadhar','onBlur'=>'getExistingCandidateWithAadhar(this);','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="aadharabc1"></span>
                            <span  id="aadhar1"></span>
                            <span  id="aadharrexist"></span>
                        </div>                        
                        {!! Form::label('Disability (दिव्यांग)', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idDisabled',getDisability(), null, ['class' => 'form-control','required'=>'required']) !!}
                            <span id="disablity1"></span> 
                        </div> 
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Pan Number', null, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('pan', null, ['class' => 'form-control','maxlength'=>'10','minlength'=>'10','pattern'=>'[A-Za-z]{5}\d{4}[A-Za-z]{1}','autocomplete'=>'off']) !!}
                            <span id="pan1"></span>
                        </div>
                        {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('maritalStatus', getMaritalStatus(),null, ['class' => 'form-control','id'=>'marital_status','required'=>'required']) !!}
                            <span id="marital_status1"></span>
                        </div>
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Password', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4 {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::text('password', null, ['class' => 'form-control','maxlength'=>'50','minlength'=>'6','autocomplete'=>'off','required'=>'required','id'=>'password']) !!}
                            <span id="password1"></span> 
                        </div> 
                        {!! Form::label('Confirm Password', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('password_confirmation', null, ['class' => 'form-control','maxlength'=>'50','minlength'=>'6','autocomplete'=>'off','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Upload Profile Picture', null, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4 {{ $errors->has('image') ? ' has-error' : '' }}">
                            <input type="file" ng-file-model="image" name="image" id="image" onchange="PreviewImage();">
                            <span id="image1"></span> 
                        </div>
                        {!! Form::label('Profile Picture', null, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4 {{ $errors->has('image') ? ' has-error' : '' }}">                        
                            <img style="border-radius: 60px; border-color:#b5b7b7!important;border: 3px solid;width: 100px;height: 100px; margin-top:10px;" alt="example image" id="uploadPreview" name="image" src="{{asset('dist/img/images/download.png')}}">
                        </div>
                    </div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button style="background-color: #b0232a;" class="btn btn-primary open1 center-block" type="button" id="next1"> Continue <span class="fa fa-arrow-right"></span></button> 
                        </div>
                    </div>
                </fieldset>
            </div>
            <div id="sf2" class="frm" style="display: none;">
                <fieldset>
                    <center><legend><h3>Personal Information</h3></legend></center>
                    <p style="text-align: center;">Residential Address</p>
                    <div class="search_inputs form-group">
                        {!! Form::label('State', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('tempState',states(), null, ['class' => 'form-control select2','style'=>'width:100%','id'=>'tempState','required'=>'required']) !!}
                            <span id="state_id1"></span>
                        </div>
                        {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('tempDistrict',[''=>'Select District'], null, ['class' => 'form-control select2','style'=>'width:100%','id'=>'tempDistrict','required'=>'required']) !!}
                            <span id="district_id1"></span>
                        </div>
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Full Address', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::textarea('tempAddress', null, ['class'=>'form-control', 'cols'=>'10' ,'rows'=>'4','id'=>'tempAddress','required'=>'required']) !!}
                            <span id="address1"></span>
                        </div>
                        {!! Form::label('Tehsil', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4  {{ $errors->has('tehsil') ? ' has-error' : '' }}">
                           {!! Form::select('tempSubDistrict',[''=>'Select Tehsil'], null, ['class' => 'form-control select2','style'=>'width:100%','id'=>'tempSubDistrict','required'=>'required']) !!}
                            <span id="tehsil1"></span>
                        </div>
                        {!! Form::label('Pin Code', null, ['class' => 'col-sm-2 control-label required','style'=>'margin-top:15px']) !!}    
                        <div class="col-sm-4" style="margin-top: 15px">
                            {!! Form::text('tempPincode', null, ['class' => 'form-control','pattern'=>'^\d{6}$','maxlength'=>'6','minlength'=>'6','autocomplete'=>'off','id'=>'tempPincode','required'=>'required']) !!}
                            <span id="pincode1"></span>
                        </div>  
                    </div>
                    <p style="text-align: center;">Permanent Address <input type="checkbox" id="sameas" style="position: relative;left:0px;">(SAME AS RESIDENTIAL ADDRESS)</p>
                    <div class="search_inputs form-group">
                        {!! Form::label('State', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idState',states(), null, ['class' => 'form-control','id'=>'idState','style'=>'width:100%','required'=>'required']) !!}
                            <span id="state_id1"></span>
                        </div>
                        {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idDistrict',[''=>'Select District'], null, ['class' => 'form-control select2','id'=>'idDistrict','style'=>'width:100%','required'=>'required']) !!}
                            <span id="district_id1"></span>
                        </div>
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Full Address', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4  {{ $errors->has('address') ? ' has-error' : '' }}">
                            {!! Form::textarea('address', null, ['class'=>'form-control','id'=>'address', 'cols'=>'10' ,'rows'=>'4','required'=>'required']) !!}                       
                            <span id="address1"></span>
                        </div>
                         {!! Form::label('Tehsil', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4  {{ $errors->has('tehsil') ? ' has-error' : '' }}">
                            {!! Form::select('idSubDistrict',[''=>'Select Tehsil'], null, ['class' => 'form-control select2','id'=>'idSubDistrict','style'=>'width:100%','required'=>'required']) !!}
                            <span id="tehsil1"></span>
                        </div>
                        <div class="{{ $errors->has('pincode') ? ' has-error' : '' }}">   
                            {!! Form::label('Pin Code', null, ['class' => 'col-sm-2 control-label required','style'=>'margin-top:15px']) !!}    
                            <div class="col-sm-4" style="margin-top: 15px">
                                {!! Form::text('pincode', null, ['class' => 'form-control','pattern'=>'^\d{6}$','id'=>'pincode','maxlength'=>'6','minlength'=>'6','autocomplete'=>'off','required'=>'required']) !!}
                                <span id="pincode1"></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-warning back2 pull-left" style="background-color: #b0232a;" type="button" id="previous"><span class="fa fa-arrow-left"></span> Previous</button> 
                            <button class="btn btn-primary open2 pull-right" style="background-color: #b0232a;" type="button" id="next2">Continue <span class="fa fa-arrow-right"></span></button> 
                        </div>
                    </div>
                </fieldset>
            </div>
            <div id="sf3" class="frm" style="display: none;">
                <fieldset>
                    <center><legend><h3>Professional Information</h3></legend></center>
                    <div class="table-responsive" style="margin: 0px;">
                        <table class="table table-bordered">
                            <thead style="background: gainsboro;">
                                <tr>
                                    <th style="text-align: center;">SNo.</th>
                                    <th style="text-align: center;">Qualification</th>
                                    <th style="text-align: center;">State</th>
                                    <th style="text-align: center;">University/Board</th>
                                    <th style="text-align: center;">District</th>
                                    <th style="text-align: center;">Passing Year</th>
                                    <th style="text-align: center;">Medium</th>
                                    <th style="text-align: center;">Percentage (%)</th>
                                    <th style="width: 100px;"></th>
                                </tr>
                            </thead>
                            <tbody id="qual_list">
                                <tr>
                                    <td class="sno">1</td>
                                    <td>{!! Form::select('qualifications[1][idQualification]',getQualifications() ,null, ['class' => 'form-control select2','style'=>'width:180px;','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idState]',states() ,null, ['class' => 'form-control select2','style'=>'width:150px;','id'=>'qualstate_1','onchange'=>'getDistricts(1)','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idUniversity]',[''=>'--Select University/Board--'] ,null, ['class' => 'form-control select2','id'=>'qualuniversity_1','style'=>'width:220px;','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idDistrict]',[''=>'--Select District--'] ,null, ['class' => 'form-control select2','id'=>'qualdistrict_1','style'=>'width:150px;','required'=>'required']) !!}</td>
                                    <td>{!! Form::text('qualifications[1][passedYear]',null, ['class' => 'form-control datepicker','style'=>'width:60px;','required'=>'required','id'=>'passedYear','placeholder'=>'Year']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][medium]',getMedium() ,null, ['class' => 'form-control select2','style'=>'width:100px;','required'=>'required']) !!}</td>
                                    <td><input type="text" name='qualifications[1][percentage]' style="width:65px;" class="form-control" minlength="2" maxlenght="5" onkeypress='return onlyNumbersandSpecialChar(event)' required></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tr><td></td><td colspan="7" style="text-align: right"><input type="button" class="add-edu-row btn btn-sm btn-success" value="+ Add More Qualifications"></tr>
                        </table>
                    </div>
                    <div class="search_inputs form-group">
                        {!! Form::label('Sector', null, ['class' => 'col-sm-1 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idSector',sector(), null, ['class' => 'form-control','id'=>'idSector','style'=>'width:100%','required'=>'required']) !!}
                            <span id="idSector1"></span>
                        </div>
                        {!! Form::label('Job Role', null, ['class' => 'col-sm-2 control-label required']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idJobRole',[''=>'Select Job Role'], null, ['class' => 'form-control select2','id'=>'idJobRole','style'=>'width:100%','required'=>'required']) !!}
                            <span id="idJobRole1"></span>
                        </div>
                    </div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-warning back3 pull-left" style="background-color: #b0232a;" type="button" id="previous"><span class="fa fa-arrow-left"></span> Previous</button> 
                            <button class="btn btn-primary open3 pull-right" style="background-color: #b0232a;" type="button" id="next3">Continue<span class="fa fa-arrow-right"></span></button> 
                        </div>
                    </div>
                </fieldset>
            </div>
            <div id="sf4" class="frm" style="display: none;">
                <fieldset>
                    <center><legend><h3>Questionnare</h3></legend></center>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="background: white;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">S.No.</th>
                                        <th style="text-align: center;">Questions</th>
                                        <th style="text-align: center;">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i =1;?>
                                    @foreach(placemntQuestions() as $value)
                                    <tr>
                                        <td style="border: 4px solid #f4f4f4;">{{$i}}</td>
                                        <td style="font-size: 17px;border: 4px solid #f4f4f4;">{{$value->question}}</td>
                                        <td style="border: 4px solid #f4f4f4;">
                                            <?php $qans = \App\PlacementQuestionOption::where('idQuestion','=',$value->idQuestion)->get(); if($value->idQuestion == '5'){
                                            echo '<textarea name="questions['.$value->idQuestion.']" rows="4" cols="70" placeholder="  Reason for choosing" required></textarea>';}?>
                                            @foreach($qans as $a)
                                            @if($value->idQuestion == 4)
                                                <input type="{{$value->questionType}}" name="question[{{$a->idOption}}]" value="{{$a->idOption}}" id="que_{{$value->idQuestion}}{{$a->optionValue}}" required>
                                            <label for="que_{{$value->idQuestion}}{{$a->optionValue}}" style="padding-left: 24px;padding-right: 20px;margin-bottom: 0;margin: 5px;">{{$a->optionText}}</label>
                                            @else
                                            <input type="{{$value->questionType}}" name="questions_{{$value->idQuestion}}" value="{{$a->idOption}}" id="que_{{$value->idQuestion}}{{$a->optionValue}}" required>
                                            <label for="que_{{$value->idQuestion}}{{$a->optionValue}}" style="padding-left: 24px;padding-right: 20px;margin-bottom: 0;margin: 5px;">{{$a->optionText}}</label>
                                            @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <?php $i++;?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-warning back4 pull-left" style="background-color: #b0232a;" type="button" id="previous"><span class="fa fa-arrow-left"></span> Previous</button> 
                            <button class="btn btn-primary  pull-right" style="background-color: #b0232a;" type="submit">Submit </button> 
                        </div>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
@include('candidate.candidate_regscript')
@stop