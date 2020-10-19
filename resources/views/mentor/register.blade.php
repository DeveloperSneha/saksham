@extends('layouts.app')
@section('content')
<style>
    .candidate_form .candidate_form_div li.name_fields .search_inputs, .candidate_form .candidate_form_div li.dob_fields .search_inputs, .candidate_form .candidate_form_div li.parents_fields .search_inputs, .candidate_form .candidate_form_div li.category_fields .search_inputs {
        width: 47%;
    }
    .process-model li::after {
        top: 41px;
        width: 103%;
        left: 138px;
    }
    .process-model li.active, .process-model li.visited {color: #fb5100;}
    .process-model li.active i, .process-model li.visited i {border-color: #fb5100;}
    .process-model li.visited::after {background: #fb5100;}
    .process-model li {width: 32%;}
</style>
<div class="candidate_registration" style="margin-top: 0px; padding-top: 0px;font-family: serif; font-size: 15px;border: 2px solid #035b66;width: 92%;margin: 4%;">
    <div style="display:block" class="candidate_form">
        <h2><span style="color:crimson">Mentor Registration</span></h2>
        <ul class="nav nav-tabs process-model more-icon-preocess" id="progressbar" role="tablist">
            <li class="active" id="first"><i class="fas fa-paper-plane"></i><p>Basic Details</p></a></li> 
            <li id="second" ><i class="fa fa-graduation-cap" aria-hidden="true"></i><p>Experience or Skills</p></a></li>
            <li id="third"><i class="fa fa-play" aria-hidden="true"></i><p>Social Media</p></a></li>
        </ul>
        <div id='formerrors' style="text-align:center;"></div>
        <div style="display:block" class="candidate_form" style="margin-left: 15px;margin-right: 15px;">
            <form class="form-horizontal" method="POST" action="{{ route('mentor.register.submit') }}" id="mentorform">
                {{ csrf_field()}}
                <div id="sf1" class="frm">
                    <fieldset>
                        <center><legend style="padding: 10px;"><h3>Basic Details</h3></legend></center>
                        <div class="search_inputs form-group">
                            {!! Form::label('First Name', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('firstName') ? ' has-error' : ''}}">
                                {!! Form::text('firstName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off']) !!}
                                <span id="fname1"></span>
                            </div>
                            {!! Form::label('Last Name', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('lastName') ? ' has-error' : ''}}">
                                {!! Form::text('lastName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off']) !!}
                                <span id="lname1"></span>
                            </div>
                        </div>
                        
                        <div class="search_inputs form-group">
                            {!! Form::label('Mobile Number', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                                    {!! Form::text('mobile', null, ['class' => 'form-control','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^(\d)(?!\1+$)\d{9}$',  'pattern'=>'^[6789]\d{9}$','autocomplete'=>'off']) !!}
                                    <span id="mobile1"></span>
                                    <span  id="mobilenoexist"></span>
                            </div>
                            {!! Form::label('Email', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::email('email',null, ['class' => 'form-control','minlength'=>'5','maxlength'=>'50','autocomplete'=>'off']) !!}
                                    <span id="email1"></span>
                            </div>  
                        </div>
                        <div class="search_inputs form-group">
                            {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    {!! Form::select('idGender', getGender(),null, ['class' => 'form-control']) !!}
                                    <span id="gender1"></span>
                            </div>
                            {!! Form::label('Dob', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('dob') ? ' has-error' : '' }}">
                                {!! Form::text('dob', null, ['class' => 'form-control datepicker','autocomplete'=>'off','required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="search_inputs form-group">
                            {!! Form::label('Password', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::password('password', null, ['class' => 'form-control','maxlength'=>'50','minlength'=>'6','autocomplete'=>'off','required'=>'required']) !!}
                            </div> 
                            {!! Form::label('Confirm Password', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    {!! Form::password('password_confirmation', null, ['class' => 'form-control','required'=>'required','maxlength'=>'50','minlength'=>'6','autocomplete'=>'off','required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="search_inputs form-group">
                        {!! Form::label('Upload Profile Picture', null, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4 {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <input type="file" ng-file-model="photo" name="photo" id="photo" onchange="PreviewImage();">
                            <span id="photo1"></span> 
                        </div>
                        {!! Form::label('Profile Picture', null, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4 {{ $errors->has('photo') ? ' has-error' : '' }}">                        
                            <img style="border-radius: 10px; border-color:#b5b7b7!important;border: 3px solid;width: 140px;height: 100px; margin-top:10px;" alt="photo" id="uploadPreview" name="photo" src="{{asset('dist/img/images/download.png')}}">
                        </div>
                    </div>
                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button style="background-color: #b0232a;" class="btn btn-primary open1 center-block" type="button" id="next1"> Continue <i class="fa fa-arrow-right"></i></button> 
                            </div>
                        </div>
                    </fieldset>
                </div>
               
                <div id="sf2" class="frm" style="display: none;">
                    <fieldset>
                        <center><legend style="padding: 10px;"><h3>Experience or Skills</h3></legend></center>
                        <div class="search_inputs form-group">
                            {!! Form::label('Job Role', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('idJobRole') ? ' has-error' : '' }}" >
                                <select id="job_role" name="idJobRole" style="padding: 10px 15px;border-radius: 10px; width: 100%" class="select2" required="required">
                                    <option value="">-- Select Job Role --</option>
                                    @foreach($sectors as $key=>$value){
                                    <optgroup label="{{$value}}">
                                        <?php $jobroles = \App\JobRole::orderBy('jobRoleName')->where('idSector','=',$key)->get()->pluck('jobRoleName','idJobRole')->toArray();?>                              @foreach($jobroles as $key1=>$value1)
                                        <option value="{{$key1}}">{{$value1}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            {!! Form::label('Experience', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('idExperience') ? ' has-error' : ''}}">
                                {!! Form::select('idExperience', Experiences(),null, ['class' => 'form-control','required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="search_inputs form-group">
                            {!! Form::label('Education', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('idQualification') ? ' has-error' : '' }}">
                                {!! Form::select('idQualification',Qualifications() ,null, ['class' => 'form-control','required'=>'required']) !!}
                            </div> 
                            {!! Form::label('Languages Known', null, ['class' => 'col-sm-2 control-label required']) !!}
                                <div class="col-sm-4 {{ $errors->has('languages') ? ' has-error' : '' }}" >
                                        @foreach(getLanguages() as $key=>$value)
                                            <li style="list-style-type:none; display: inline;">
                                                <input type="checkbox" id="language_{{$key}}"  value="{{$key}}" name="languages[]">
                                                <label style="padding-left:19px; padding-right:10px;" for="language_{{$key}}">{{$value}}</label>
                                            </li>
                                        @endforeach
                                </div> 
                        </div>
                        <div class="search_inputs form-group">
                            {!! Form::label('Headline about yourself', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('headline') ? ' has-error' : '' }}">
                                {!! Form::textarea('headline', null, ['class' => 'form-control','autocomplete'=>'off','required'=>'required','cols'=>'30','rows'=>'4']) !!}
                            </div> 
                            {!! Form::label('Overview about yourself', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors->has('about') ? ' has-error' : '' }}">
                                {!! Form::textarea('about', null, ['class' => 'form-control','autocomplete'=>'off','cols'=>'30','rows'=>'4','required'=>'required']) !!}
                            </div> 
                        </div>
                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2" style="padding:25px;">
                                    <button class="btn btn-warning back2 pull-left" style="background-color: #b0232a;" type="button" id="previous"><span class="fa fa-arrow-left"></span> Previous</button> 
                                    <button class="btn btn-primary open2 pull-right" style="background-color: #b0232a;" type="button" id="next2">Continue <span class="fa fa-arrow-right"></span></button> 
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div id="sf3" class="frm" style="display: none;">
                    <fieldset>
                        <center><legend style="padding: 10px;"><h3>Social Media</h3></legend></center>
                        <div class="search_inputs form-group">
                            {!! Form::label('Website', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('personalWebsite') ? ' has-error' : '' }}">
                                {!! Form::text('personalWebsite', null, ['class' => 'form-control','autocomplete'=>'off']) !!}
                            </div> 
                            {!! Form::label('Facebook Url', null, ['class' => 'col-sm-2 control-label ']) !!}
                            <div class="col-sm-4 {{ $errors->has('facebookUrl') ? ' has-error' : '' }}">
                                {!! Form::text('facebookUrl', null, ['class' => 'form-control','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="search_inputs form-group">
                            {!! Form::label('Twitter Url', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('twitterUrl') ? ' has-error' : '' }}">
                                {!! Form::text('twitterUrl', null, ['class' => 'form-control','autocomplete'=>'off']) !!}
                            </div> 
                            {!! Form::label('Linkedin Url', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('linkedinUrl') ? ' has-error' : '' }}">
                                {!! Form::text('linkedinUrl', null, ['class' => 'form-control','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="search_inputs form-group">
                            {!! Form::label('Youtube Url', null, ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4 {{ $errors->has('youtubeUrl') ? ' has-error' : '' }}">
                                {!! Form::text('youtubeUrl', null, ['class' => 'form-control','autocomplete'=>'off']) !!}
                            </div> 
                        </div>
                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                        <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2" style="padding:25px;">
                                        <button class="btn btn-warning back3 pull-left" style="background-color: #b0232a;" type="button" id="previous"><span class="fa fa-arrow-left"></span> Previous</button> 
                                        <button class="btn btn-primary  pull-right" style="background-color: #b0232a;" type="submit">Submit </button>
                                </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
$(document).ready(function() {
     var v = $('#mentorform').validate({
        rules:{
            firstName: {
                required:true
            },
            idExperience: {
                required:true
            },
            idQualification: {
                required:true
            },
            email:{
                required:true
            },
            mobile: {
                required:true,
                maxlength:10,
                minlength:10
            },
            password: {
                required:true
            },
            idGender: {
                required:true
            },
        },
         messages:{
            firstName:{
                 required: "First name should not be empty."
            },
            mobile:{
                 required:"Mobile number is mandatory.",
                 minlength:"Mobile  number should have atleast 10 digits",
                 maxlength:"Mobile  number should Have At most 10 digits"
            },
            idGender:{
                 required:"Select your gender."
            }
        }
     });
     
    $("#next1").click(function() {
    if (v.form()) {
    	$("#progressbar li#first").addClass("visited");
        $(".frm").hide("fast");
        $("#sf2").show("slow");
        $("#progressbar li#second").addClass("active");
      }
    });

    $("#next2").click(function() {
        if (v.form()) {
        	$("#progressbar li#second").addClass("visited");
            $(".frm").hide("fast");
            $("#sf3").show("slow");
            $("#progressbar li#third").addClass("active");
    }
         
    });

    $(".back2").click(function() {
      $(".frm").hide("fast");
      $("#sf1").show("slow");
      $("#progressbar li#first").removeClass("visited");
      $("#progressbar li#second").removeClass("active");
    });

    $(".back3").click(function() {
      $(".frm").hide("fast");
      $("#sf2").show("slow");
      $("#progressbar li#second").removeClass("visited");
      $("#progressbar li#third").removeClass("active");
    });
});
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("photo").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}
 $('#mentorform').on('submit',function(e){
         $.ajaxSetup({
         header:$('meta[name="_token"]').attr('content')
     });
      var formData =  new FormData($('#mentorform')[0]);
         $.ajax({
             type:"POST",
             url: "{{url('mentor/register') }}",
             processData: false,
             contentType: false,
             data:formData,
             dataType: 'json',
             success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){     //True Case i.e. passed validation
                    window.location = "{{url('mentor')}}";
                }
                else {                  //False Case: With error msg
                 $("#msg").html(data);   //$msg is the id of empty msg
                }
            },

            error: function(data){
                    if( data.status === 422 ) {
                       var errors = data.responseJSON.errors;
                       var errorHtml = '<div class="alert alert-danger"><ul>';
                       $.each( errors, function( key, value ) {    
                          errorHtml += '<li>' + value + '</li>'; 
                       });
                       errorHtml += '</ul></div>';
                       $('#formerrors').html(errorHtml);
                    }
                }
            });
        return false;
});
</script>
@stop