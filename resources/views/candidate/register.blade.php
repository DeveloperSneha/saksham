@extends('layouts.app')
@section('content')
<div class="candidate_registration" style="margin-top: 0px; padding-top: 0px;font-family: serif; font-size: 15px;border: 2px solid #035b66;width: 92%;margin: 4%;">
    <h2><span style="color:crimson">Candidate Registration</span></h2>
    <div style="display:block" class="candidate_form">
        <form name="official_login" method="POST" action="{{ route('candidate.register.submit')}}" class="form-horizontal" id="enrol" enctype="multipart/form-data" style="padding-right: 25px;font-family: serif;">
            {{ csrf_field() }}
            <div id='formerrors'></div>
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
                            {!! Form::select('idGender', getGender(),null, ['class' => 'form-control','required'=>'required']) !!}
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
                        {!! Form::label('Sector', null, ['class' => 'col-sm-2 control-label required']) !!}
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
                    <div class="company_login_form">
                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button type="submit" class="login100-form-btn">Register</button>
                            </div>
                        </div></div>
        </form>
    </div>
</div>
@stop
@section('script')
<script>
function getExistingCandidateWithAadhar(element){
    $( '#aadharabc1' ).empty();
    var aadharno = $('#candidate_aadhar').val();
    $.ajax({
            type:"GET",
            url: "{{url('candidate/existaadhar') }}",
            data: {aadhar:aadharno},
            dataType: 'json',
            success:function(data){
                if(data!=null){
                   $( '#aadharrexist' ).empty();
                   errorname = '<span class="help-block"><strong>Aadhar No has Already been Taken.</strong></span>';
                   $( '#aadharrexist' ).html(errorname);
                }else{
                   $( '#aadharrexist' ).empty();
                }
            },
            error: function(data){
                var errors = data.responseJSON.errors;
                console.log(errors);
                if(errors['aadharabc']=== undefined){
                    $( '#aadharabc1' ).empty();
                }else{
                   erroraadhar = '<span class="help-block"><strong>'+errors['aadharabc']+'</strong></span>';
                   $( '#aadharabc1' ).html( erroraadhar );
                }
            }
        });
}
function getExistingCandidateWithMobile(element){
    $( '#mobile1' ).empty();
    $( '#mobilenoexist' ).empty();
    var mobileno = $('#candidate_mobile').val();
    $.ajax({
            type:"GET",
            url: "{{url('candidate/existmobile') }}",
            data: {mobile:mobileno},
            dataType: 'json',
            success:function(data){
                if(data!=null){
                   $( '#mobilenoexist' ).empty();
                   errorname = '<span class="help-block"><strong>Mobile No has Already been Taken</strong></span>';
                   $('#mobilenoexist' ).html(errorname);
                }else{
                   $('#mobilenoexist' ).empty();
                }
            }
        });
}

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}

$(document).ready(function() {
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

    $('#enrol').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });
    var formData =  new FormData($('#enrol')[0]);
       $.ajax({
           type:"POST",
           url: "{{url('candidate/register') }}",
           processData: false,
           contentType: false,
           data:formData,
           dataType: 'json',
           success:function(data){
              if( data[Object.keys(data)[0]] === 'SUCCESS' ){     //True Case i.e. passed validation
                  window.location = "{{url('candidate/login')}}";
              }
              else {                  //False Case: With error msg
                $("#msg").html(data);   //$msg is the id of empty msg
              }
          },

            error: function(data){
                      // e.preventDefault(e);
                if( data.status === 422 ) {
                       var errors = data.responseJSON.errors;
                       var errorHtml = '<div class="alert alert-danger"><ul>';
                      
                        if(errors['firstName']=== undefined){
                            $( '#fname1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['firstName']+'</strong></span>';
                           $( '#fname1' ).html( errorname );
                        }
                        if(errors['lastName']=== undefined){
                            $( '#lname1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['lastName']+'</strong></span>';
                           $( '#lname1' ).html( errorname );
                        }
                        if(errors['fatherName']=== undefined){
                            $( '#father_name1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['fatherName']+'</strong></span>';
                           $( '#father_name1' ).html( errorname );
                        }
                        if(errors['motherName']=== undefined){
                            $( '#mother_name1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['motherName']+'</strong></span>';
                           $( '#mother_name1' ).html( errorname );
                        }
                        if(errors['dob']=== undefined){
                            $( '#dob1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['dob']+'</strong></span>';
                           $( '#dob1' ).html( errorname );
                        }
                        if(errors['email']=== undefined){
                            $( '#email1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['email']+'</strong></span>';
                           $( '#email1' ).html( errorname );
                        }
                        if(errors['mobile']=== undefined){
                            $( '#mobile1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['mobile']+'</strong></span>';
                           $( '#mobile1' ).html( errorname );
                        }
                        if(errors['mobilenoexist']=== undefined){
                            $( '#mobilenoexist' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['mobilenoexist']+'</strong></span>';
                           $( '#mobilenoexist' ).html( errorname );
                        }
                        if(errors['idGender']=== undefined){
                            $( '#gender1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['idGender']+'</strong></span>';
                           $( '#gender1' ).html( errorname );
                        }
                        if(errors['idDisabled']=== undefined){
                            $( '#disablity1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['idDisabled']+'</strong></span>';
                           $( '#disablity1' ).html( errorname );
                        }
                        if(errors['aadhar']=== undefined){
                            $( '#aadhar1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['aadhar']+'</strong></span>';
                           $( '#aadhar1' ).html( errorname );
                        }
                        if(errors['aadharabc']=== undefined){
                            $( '#aadharabc1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['aadharabc']+'</strong></span>';
                           $( '#aadharabc1' ).html( errorname );
                        }
                        if(errors['aadharrexist']=== undefined){
                            $( '#aadharrexist' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['aadharrexist']+'</strong></span>';
                           $( '#aadharrexist' ).html( errorname );
                        }
                        if(errors['pan']=== undefined){
                            $( '#pan1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['pan']+'</strong></span>';
                           $( '#pan1' ).html( errorname );
                        }
                        if(errors['maritalStatus']=== undefined){
                            $( '#marital_status1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['maritalStatus']+'</strong></span>';
                           $( '#marital_status1' ).html( errorname );
                        }
                        if(errors['idSector']=== undefined){
                            $( '#idSector1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['idSector']+'</strong></span>';
                           $( '#idSector1' ).html( errorname );
                        }
                        if(errors['idJobRole']=== undefined){
                            $( '#idJobRole1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['idJobRole']+'</strong></span>';
                           $( '#idJobRole1' ).html( errorname );
                        }
                        if(errors['image']=== undefined){
                            $( '#image1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['image']+'</strong></span>';
                           $( '#image1' ).html( errorname );
                        }
                        if(errors['password']=== undefined){
                            $( '#password1' ).empty();
                        }else{
                           errorname = '<span class="help-block"><strong>'+errors['password']+'</strong></span>';
                           $( '#password1' ).html( errorname );
                        }
                       // errorHtml += '</ul></div>';
                       // $('#formerrors').html(errorHtml);
                }
            }
       });
       return false;
    });
});
</script>
@stop