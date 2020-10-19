@extends('candidate.candidate_layout')
@section('content')
<div id='formerrors'></div>
<div class="panel panel-default">
    <div class="panel-heading">Edit Profile : <span class="font-semibold">{{ $candidate->firstName }} {{ $candidate->lastName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        {!! Form::model( $candidate, ['route' => ['candidateprofile.update'], 'method' => 'post','class'=>'form-horizontal','id'=>'idProfile','files'=> true] ) !!}
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3" style="padding-left: 0px; padding-right: 0px">
                    <div class="form-group">
                        <div class="col-xs-12">
                          <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 5px;font-family: serif;font-weight: 700">Profile Picture</h3>
                            <div class="form-img text-center mgbt-xs-15"> 
                            @if(!empty($candidate->image))
                                <img style="border-radius: 100px;border-color: teal!important;border: 6px solid; width: 150px; height: 150px;margin-top: 20px;" alt="example image" id="uploadPreview" src="{{$candidate->image}}">
                                @else
                                <img style="border-radius: 100px;border-color: teal!important;border: 6px solid; width: 150px; height: 150px;margin-top: 20px;"  src="{{asset('dist/img/images/default.png')}}" alt="example image" id="uploadPreview">
                            @endif
                            </div>
                          <div class="form-img-action text-center mgbt-xs-20">
                              <input type="file" name="image" id="file" style="display:none;" onchange="PreviewImage();">
                              <a class="btn vd_btn  vd_bg-blue" onclick="document.getElementById('file').click();"  style="background: teal;color:white;"><i class="fa fa-cloud"></i> Change & Upload</a> </div>
                              <br>
                              <strong style="font-size: 18px;"><center><span>Status
                                <span class="label label-success">Active</span></span>
                            </center></strong>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-9">
                    <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Basic Details</h3>

                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('First Name', null, ['class' => 'col-sm-2 search_inputs control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('firstName', null, ['class' => 'form-control','pattern'=>'^[^\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="fname1"></span>
                        </div>
                        {!! Form::label('Last Name', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('lastName', null, ['class' => 'form-control','pattern'=>'^[^\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off']) !!}
                            <span id="lname1"></span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Father Name', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('fatherName', null, ['class' => 'form-control','pattern'=>'^[^\s][a-zA-Z_\s-]+$','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="father_name1"></span>
                        </div>
                        {!! Form::label('Mother Name', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('motherName', null, ['class' => 'form-control','pattern'=>'^[^\s][a-zA-Z_\s-]+$','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="mother_name1"></span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Date of Birth', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('dob', null, ['class' => 'form-control datepicker','onkeypress'=>'return onlyNumbersandSpecialChar(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="dob1"></span>
                        </div>
                        {!! Form::label('Email', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::email('email',null, ['class' => 'form-control','minlength'=>'5','maxlength'=>'100','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="email1"></span>
                        </div>                         
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Contact No', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                            {!! Form::text('mobile', null, ['class' => 'form-control','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^(\d)(?!\1+$)\d{9}$',  'pattern'=>'^[6789]\d{9}$','autocomplete'=>'off','required'=>'required','id'=>'candidate_mobile']) !!}
                            <span id="mobile1"></span>
                            <span  id="mobilenoexist"></span>
                        </div>
                        {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::select('idGender', getGender(),null, ['class' => 'form-control','required'=>'required']) !!}
                            <span id="gender1"></span>
                        </div>                                           
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Aadhar No.', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('aadhar') ? ' has-error' : '' }}{{ $errors->has('aadharabc') ? ' has-error' : '' }}">
                            {!! Form::text('aadhar', null, ['class' => 'form-control','maxlength'=>'12','minlength'=>'12','onkeypress'=>'return isNumber(event)','id'=>'candidate_aadhar','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="aadharabc1"></span>
                            <span  id="aadhar1"></span>
                            <span  id="aadharrexist"></span>
                        </div>
                        {!! Form::label('Pan No.', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('pan', null, ['class' => 'form-control','maxlength'=>'10','minlength'=>'10','pattern'=>'[A-Za-z]{5}\d{4}[A-Za-z]{1}','autocomplete'=>'off']) !!}
                            <span id="pan1"></span>
                        </div>  
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Any Disability', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idDisabled',getDisability(), null, ['class' => 'form-control','required'=>'required']) !!}
                            <span id="disablity1"></span> 
                        </div>
                        {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('maritalStatus', getMaritalStatus(),null, ['class' => 'form-control','id'=>'marital_status','required'=>'required']) !!}
                            <span id="marital_status1"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            <hr>
            <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Personal Details</h3>
            <div class="row">
                <p style="text-align: center;">Residential Address</p>
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('State', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('tempState',states(), null, ['class' => 'form-control select2','style'=>'width:100%','id'=>'tempState','required'=>'required']) !!}
                        <span id="state_id1"></span>
                    </div>
                    {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('tempDistrict',districts(), null, ['class' => 'form-control select2','style'=>'width:100%','id'=>'tempDistrict','required'=>'required']) !!}
                        <span id="district_id1"></span>
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('Full Address', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::textarea('tempAddress', null, ['class'=>'form-control', 'cols'=>'10' ,'rows'=>'4','id'=>'tempAddress','required'=>'required']) !!}
                        <span id="address1"></span>
                    </div>
                    {!! Form::label('Tehsil', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4  {{ $errors->has('tehsil') ? ' has-error' : '' }}">
                       {!! Form::select('tempSubDistrict',subdistricts(), null, ['class' => 'form-control select2','style'=>'width:100%','id'=>'tempSubDistrict','required'=>'required']) !!}
                        <span id="tehsil1"></span>
                    </div>
                    {!! Form::label('Pin Code', null, ['class' => 'col-sm-2 control-label','style'=>'margin-top:15px']) !!}    
                    <div class="col-sm-4" style="margin-top: 15px">
                        {!! Form::text('tempPincode', null, ['class' => 'form-control','pattern'=>'^\d{6}$','maxlength'=>'6','minlength'=>'6','autocomplete'=>'off','required'=>'required','id'=>'tempPincode']) !!}
                        <span id="pincode1"></span>
                    </div>  
                </div>             
                <p style="text-align: center;">Permanent Address (SAME AS RESIDENTIAL ADDRESS)<input type="checkbox" id="sameas" style="position: relative;left:0px;"></p>
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('State', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('idState',states(), null, ['class' => 'form-control','id'=>'idState','style'=>'width:100%','required'=>'required']) !!}
                        <span id="state_id1"></span>
                    </div>
                    {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('idDistrict',districts(), null, ['class' => 'form-control select2','id'=>'idDistrict','style'=>'width:100%','required'=>'required']) !!}
                        <span id="district_id1"></span>
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('Full Address', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4  {{ $errors->has('address') ? ' has-error' : '' }}">
                        {!! Form::textarea('address', null, ['class'=>'form-control','id'=>'address', 'cols'=>'10' ,'rows'=>'4','required'=>'required']) !!}                       
                        <span id="address1"></span>
                    </div>
                     {!! Form::label('Tehsil', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4  {{ $errors->has('tehsil') ? ' has-error' : '' }}">
                        {!! Form::select('idSubDistrict',subdistricts(), null, ['class' => 'form-control select2','id'=>'idSubDistrict','style'=>'width:100%','required'=>'required']) !!}
                        <span id="tehsil1"></span>
                    </div>
                    <div class="{{ $errors->has('pincode') ? ' has-error' : '' }}">   
                        {!! Form::label('Pin Code', null, ['class' => 'col-sm-2 control-label','style'=>'margin-top:15px']) !!}    
                        <div class="col-sm-4" style="margin-top: 15px">
                            {!! Form::text('pincode', null, ['class' => 'form-control','pattern'=>'^\d{6}$','id'=>'pincode','maxlength'=>'6','minlength'=>'6','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="pincode1"></span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Professional Details</h3>
            <div class="row">
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
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
                                    <th style="text-align: center;">(%) age</th>
                                    <th style="width: 100px;"></th>
                                </tr>
                            </thead>
                            <tbody id="qual_list">
                                <?php $i=1;?>
                                @if(count($candidate->academics)>0)
                                @foreach($candidate->academics as $val)
                                <tr>
                                    <td class="sno">{{$i}}</td>
                                    <td>{!! Form::select('qualifications[1][idQualification]',getQualifications() ,isset($val) ? $val->idQualification :null, ['class' => 'form-control select2','style'=>'width:150px;','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idState]',states() ,isset($val) ? $val->district->state->idState:null, ['class' => 'form-control select2','style'=>'width:150px;','id'=>'qualstate_1','onchange'=>'getDistricts(1)','required'=>'required']) !!}</td>
                                    <td style="width: 220px;">{!! Form::select('qualifications[1][idUniversity]',university() ,isset($val) ? $val->idUniversity :null, ['class' => 'form-control select2','id'=>'qualuniversity_1','required'=>'required']) !!}</td>
                                    <td style="width: 220px;">{!! Form::select('qualifications[1][idDistrict]',districts() ,isset($val) ? $val->idDistrict :null, ['class' => 'form-control select2','id'=>'qualdistrict_1','required'=>'required']) !!}</td>
                                    <td>{!! Form::text('qualifications[1][passedYear]',isset($val) ? $val->passedYear :null, ['class' => 'form-control datepicker','style'=>'width:60px;','id'=>'passedYear','placeholder'=>'Year','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idMedium]',getMedium() ,isset($val) ? $val->idMedium :null, ['class' => 'form-control select2','style'=>'width:100px;','required'=>'required']) !!}</td>
                                    <td>{!! Form::text('qualifications[1][percentage]',isset($val) ? $val->percentage :null, ['class' => 'form-control','style'=>'width:60px;','id'=>'percentage','onkeypress'=>'return onlyNumbersandSpecialChar(event)','required'=>'required']) !!}</td>
                                    <td></td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @else
                                <tr>
                                    <td class="sno">1</td>
                                    <td>{!! Form::select('qualifications[1][idQualification]',getQualifications() ,null, ['class' => 'form-control select2','style'=>'width:180px;','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idState]',states() ,null, ['class' => 'form-control select2','style'=>'width:150px;','id'=>'qualstate_1','onchange'=>'getDistricts(1)','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idUniversity]',[''=>'--Select University/Board--'] ,null, ['class' => 'form-control select2','id'=>'qualuniversity_1','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idDistrict]',[''=>'--Select District--'] ,null, ['class' => 'form-control select2','id'=>'qualdistrict_1','required'=>'required']) !!}</td>
                                    <td>{!! Form::text('qualifications[1][passedYear]',null, ['class' => 'form-control datepicker','style'=>'width:60px;','id'=>'passedYear','placeholder'=>'Year','required'=>'required']) !!}</td>
                                    <td>{!! Form::select('qualifications[1][idMedium]',getMedium() ,null, ['class' => 'form-control select2','required'=>'required']) !!}</td>
                                    <td><input type="text" name='qualifications[1][percentage]' style="width:65px;" class="form-control" minlength="2" maxlenght="5" onkeypress='return onlyNumbersandSpecialChar(event)' required></td>
                                    <td></td>
                                </tr>
                                @endif
                            </tbody>
                            <tr><td></td><td colspan="7" style="text-align: right"><input type="button" class="add-edu-row btn btn-sm btn-success" value="+ Add More Qualifications"></tr>
                        </table>
                    </div>
                </div>                
            </div>
            <hr>
            <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Enrolled Course</h3>
            <div class="row">
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('Sector', null, ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('idSector',sector(), isset($candidate->enrolled_course) ? $candidate->enrolled_course->jobrole->idSector : null, ['class' => 'form-control','id'=>'idSector','style'=>'width:100%','required'=>'required']) !!}
                            <span id="idSector1"></span>
                    </div>
                    {!! Form::label('Job Role', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('idJobRole',jobrole(), isset($candidate->enrolled_course) ? $candidate->enrolled_course->jobrole->idJobRole:null, ['class' => 'form-control select2','id'=>'idJobRole','style'=>'width:100%','required'=>'required']) !!}
                        <span id="idJobRole1"></span>
                    </div>
                </div>
            </div>
            <?php $ans = \App\CandidateAnswer::where('idCandidate','=',Auth::user()->idCandidate)->get(); ?>
            @if(!count($ans)>0)
            <hr>
            <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Questionnare</h3>
            <div class="row">
                <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    <table class="table table-bordered" style="background: white;">
                        <thead style="background: lightgray;">
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
                                    echo '<textarea name="questions_'.$value->idQuestion.'" rows="4" cols="70" placeholder="  Reason for choosing"></textarea>';}?>
                                    @foreach($qans as $a)
                                    @if($value->idQuestion == 4)
                                        <input type="{{$value->questionType}}" name="questions[{{$a->idQuestion}}]" value="{{$a->idOption}}" id="que_{{$value->idQuestion}}{{$a->optionValue}}">
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
            @endif                
        <!-- panel-body -->
        <div class="pd-20">
          <button class="btn btn-danger col-md-offset-5"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Update Profile</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
<script>
    $(document).ready(function() {
        var v = $('#idProfile').validate({            
            rules:{
                passord_confirmation: {
                            equalTo:"#password"
                        }
            },
            messages:{
                passord_confirmation :{
                    equalTo :"Password & Confirm Password is Not Same"
                }
            }
        });
        $('select[name="tempState"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: "{{url('/state/') }}"+'/' +stateID + "/districts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="tempDistrict"]').empty();
                        $('select[name="tempSubDistrict"]').empty();
                        $('select[name="tempDistrict"]').append('<option value="">--- Select District ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="tempDistrict"]').append('<option id="tempdisId'+ key +'" value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="tempDistrict"]').empty();
            }
        });

        $('select[name="idState"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: "{{url('/state/') }}"+'/' +stateID + "/districts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idDistrict"]').empty();
                        $('select[name="idSubDistrict"]').empty();
                        $('select[name="idDistrict"]').append('<option value="">--- Select District ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="idDistrict"]').append('<option  value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idDistrict"]').empty();
            }
        });

        $('select[name="tempDistrict"]').on('change', function() {
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: "{{url('/district/') }}"+'/' +districtID + "/subdistricts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="tempSubDistrict"]').empty();
                        $('select[name="tempSubDistrict"]').append('<option value="">--- Select Tehsil ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="tempSubDistrict"]').append('<option id="tempsubId'+ key +'" value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="tempSubDistrict"]').empty();
            }
        });
        $('select[name="idDistrict"]').on('change', function() {
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: "{{url('/district/') }}"+'/' +districtID + "/subdistricts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idSubDistrict"]').empty();
                        $('select[name="idSubDistrict"]').append('<option value="">--- Select Tehsil ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="idSubDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="idSubDistrict"]').empty();
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
        // Qualification Row
        var i = 1;
        $(".add-edu-row").click(function(){
            i++;  
            var markup = '<tr><td class="sno">'+i+'</td>\
                <td style="width:150px;"><select name="qualifications['+i+'][idQualification]"  class = "form-control col-sm-3 select2">@foreach(getQualifications() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\
                <td style="width:150px;"><select name="qualifications['+i+'][idState]"  class = "form-control col-sm-3 select2" id = "qualstate_'+i+'" onchange="getDistricts('+i+')">@foreach(states() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\n\
                <td style="width:150px;"><select name="qualifications['+i+'][idUniversity]"  class = "form-control col-sm-3 select2" id = "qualuniversity_'+i+'"><option value="">-- Select University / Board--</option></select></td>\n\
                <td style="width:150px;"><select name="qualifications['+i+'][idDistrict]"  class = "form-control col-sm-3 select2" id = "qualdistrict_'+i+'"><option value="">-- Select District--</option></select></td>\n\
                <td style="width:60px;"><input type="text" name="qualifications['+i+'][passedYear]" class = "form-control col-sm-3 datepicker" id="passedYear"></td>\n\
                <td style="width:100px;"><select name="qualifications['+i+'][idMedium]"  class = "form-control col-sm-3 select2">@foreach(getMedium() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\n\
                <td style="width:65px;"><input type="text" name="qualifications['+i+'][percentage]" class="form-control" style="width:65px;"></td>\n\
                <td style="text-align:right;vertical-align: middle;"><input type="button"  class="btn btn-xs btn-danger" value="Delete" id="remove_row"></td></tr>';
                setTimeout(function(){
                    $('.select2').select2();
                }, 100);
                setTimeout(function(){                
                    $('.datepicker').datepicker({
                        autoclose: true,
                        format: 'dd-mm-yyyy',
                        todayBtn:true,
                        todayHighlight:true,
                        orientation: 'auto'
                      });
                    $("#passedYear").datepicker({
                        format: "yyyy",
                        viewMode: "years", 
                        minViewMode: "years",
                        autoclose: true,
                    });
                }, 100);
                $("#qual_list").append(markup);
        });
        $('#qual_list').on('click', 'input[type="button"]', function () {
            $(this).closest('tr').remove();
             i = $('.sno:last').text();
        });

        $("#sameas").change(function() {
        if(this.checked) {
            $("#idState").val($("#tempState option:selected").val());
            
            var tmpdis = $("#tempDistrict option:selected").val();
            $("#idDistrict").empty();
            $("#idDistrict").append('<option value="'+tmpdis+'">'+$("#tempdisId"+ $("#tempDistrict option:selected").val()).text()+'</option>');
            
            var tmpsubdis = $("#tempSubDistrict option:selected").val();
            $("#idSubDistrict").empty();
            $("#idSubDistrict").append('<option value="'+tmpsubdis+'">'+$("#tempsubId"+ $("#tempSubDistrict option:selected").val()).text()+'</option>');
          
            $("#address").val($("#tempAddress").val());
            $("#pincode").val($("#tempPincode").val());
            
            // then form will be automatically filled .. 
        }
        else{
            $("#idState").val('');
            $("#address").val('');
            $("#idDistrict").val('');
            $("#idSubDistrict").val('');
            $("#pincode").val('');
        }
        });
    });
    function PreviewImage() {
        var oFReader = new FileReader();
        console.log(oFReader.readAsDataURL(document.getElementById("file").files[0]));

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

    function getDistricts(stateid){
        var state = $('#qualstate_'+stateid).val();
        if(state){
            $.ajax({
                    url: "{{url('/state/') }}"+'/' +state + "/districts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="qualdistrict_'+stateid+'"]').empty();
                        $('select[id="qualdistrict_'+stateid+'"]').append('<option value="">--- Select District ---</option>');
                        $.each(data, function(key, value) {
                            $('select[id="qualdistrict_'+stateid+'"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
            });
        }else{
            $('select[id="qualdistrict_'+stateid+'"]').empty();
        }
        var stateId = $('#qualstate_'+stateid).val();
        if(stateId){
            $.ajax({
                    url: "{{url('/state/') }}"+'/' +stateId + "/university",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="qualuniversity_'+stateid+'"]').empty();
                        $('select[id="qualuniversity_'+stateid+'"]').append('<option value="">--- Select University/Board ---</option>');
                        $.each(data, function(key, value) {
                            $('select[id="qualuniversity_'+stateid+'"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
            });
        }else{
            $('select[id="qualuniversity_'+stateid+'"]').empty();
        }
    }    
</script>
@stop