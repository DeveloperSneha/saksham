@extends('mentor.mentor_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit Profile : <span class="font-semibold">{{ $mentor->firstName }} {{ $mentor->lastName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        {!! Form::model( $mentor, ['route' => ['mentorprofile.update'], 'method' => 'post','class'=>'form-horizontal','files'=> true] ) !!}
        <div class="panel-body">
            <div class="row">
                <input type="hidden" name="idMentor" value="{{$mentor->idMentor}}">
                <div class="col-sm-3" style="padding-left: 0px; padding-right: 0px">
                    <div class="form-group">
                        <div class="col-xs-12">
                          <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 5px;font-family: serif;font-weight: 700">Profile Picture</h3>
                            <div class="form-img text-center mgbt-xs-15"> 
                            @if(!empty($mentor->photo))
                                <img style="border-radius: 100px;border-color: teal!important;border: 6px solid; width: 173px; height: 173px;margin-top: 20px;" alt="example image" id="uploadPreview" src="{{$mentor->photo}}">
                                @else
                                <img style="border-radius: 100px;border-color: teal!important;border: 6px solid; width: 173px; height: 173px;margin-top: 20px;"  src="{{asset('dist/img/images/default.png')}}" alt="example image" id="uploadPreview">
                            @endif
                            </div>
                          <div class="form-img-action text-center mgbt-xs-20">
                              <input type="file" name="photo" id="file" style="display:none;" onchange="PreviewImage();">
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
                        {!! Form::label('First Name', null, ['class' => 'col-sm-2 search_inputs control-label required','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('firstName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="fname1"></span>
                        </div>
                        {!! Form::label('Last Name', null, ['class' => 'col-sm-2 control-label','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('lastName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'40','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off']) !!}
                            <span id="lname1"></span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Date of Birth', null, ['class' => 'col-sm-2 control-label required','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('dob', null, ['class' => 'form-control datepicker','onkeypress'=>'return onlyNumbersandSpecialChar(event)','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="dob1"></span>
                        </div>
                        {!! Form::label('Email', null, ['class' => 'col-sm-2 control-label required','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::email('email',null, ['class' => 'form-control','minlength'=>'5','maxlength'=>'100','autocomplete'=>'off','required'=>'required']) !!}
                            <span id="email1"></span>
                        </div>                         
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                        {!! Form::label('Contact No', null, ['class' => 'col-sm-2 control-label required','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('mobile') ? ' has-error' : '' }} ">
                            {!! Form::text('mobile', null, ['class' => 'form-control','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return isNumber(event)', 'pattern'=>'^(\d)(?!\1+$)\d{9}$',  'pattern'=>'^[6789]\d{9}$','autocomplete'=>'off','id'=>'candidate_mobile','required'=>'required']) !!}
                            <span id="mobile1"></span>
                            <span  id="mobilenoexist"></span>
                        </div>
                        {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label required','style'=>'padding-left: 8px;padding-right: 8px;']) !!}
                        <div class="col-sm-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::select('idGender', getGender(),null, ['class' => 'form-control','required'=>'required']) !!}
                            <span id="gender1"></span>
                        </div>                                           
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                            {!! Form::label('Sector', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('idSector') ? ' has-error' : ''}}">
                            @foreach($mentor->mentor_skill as $val)
                                {!! Form::select('idSector', sector(),isset($val) ? $val->JobRole->idSector :null, ['class' => 'form-control']) !!}
                                @endforeach
                                <span class="help-block">
                                    <strong>
                                        @if($errors->has('idSector'))
                                        <p>{{ $errors->first('idSector') }}</p>
                                        @endif
                                    </strong>
                                </span>
                            </div>
                            {!! Form::label('Job Role', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('idJobRole') ? ' has-error' : ''}}">
                            @foreach($mentor->mentor_skill as $val)
                                {!! Form::select('idJobRole', jobrole(),isset($val) ? $val->idJobRole :null, ['class' => 'form-control']) !!}
                                @endforeach
                                <span class="help-block">
                                    <strong>
                                        @if($errors->has('idJobRole'))
                                        <p>{{ $errors->first('idJobRole') }}</p>
                                        @endif
                                    </strong>
                                </span>
                            </div>
                    </div>
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('Experience', null, ['class' => 'col-sm-2 control-label required']) !!}
                    <div class="col-sm-4 {{ $errors -> has('idExperience') ? ' has-error' : ''}}">
                    @foreach($mentor->mentor_skill as $val)
                        {!! Form::select('idExperience', Experiences(),isset($val) ? $val->idExperience :null, ['class' => 'form-control']) !!}
                        @endforeach
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idExperience'))
                                <p>{{ $errors->first('idExperience') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                    {!! Form::label('Education', null, ['class' => 'col-sm-2 control-label required']) !!}
                    <div class="col-sm-4 {{ $errors->has('idQualification') ? ' has-error' : '' }}">
                        {!! Form::select('idQualification',Qualifications() ,null, ['class' => 'form-control']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idQualification'))
                                <p>{{ $errors->first('idQualification') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div> 
                </div>
                </div>
            </div>
            <hr>
            <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Personal Details</h3>
            <div class="col-sm-12">
                
                    <div class="form-group" style="margin-right: 0px;margin-left: 0px;">
                    {!! Form::label('Headline about yourself', null, ['class' => 'col-sm-2 control-label required']) !!}
                    <div class="col-sm-4 {{ $errors->has('headline') ? ' has-error' : '' }}">
                        {!! Form::textarea('headline', null, ['class' => 'form-control','autocomplete'=>'off','required'=>'required','cols'=>'30','rows'=>'4']) !!}
                    </div> 
                    {!! Form::label('Overview about yourself', null, ['class' => 'col-sm-2 control-label required']) !!}
                    <div class="col-sm-4 {{ $errors->has('about') ? ' has-error' : '' }}">
                        {!! Form::textarea('about', null, ['class' => 'form-control','autocomplete'=>'off','cols'=>'30','rows'=>'4','required'=>'required']) !!}
                    </div> 
                </div>
                    <div class="form-group" style="margin-right:0px; margin-left:opx;">
                        
                            {!! Form::label('Languages Known', null, ['class' => 'col-sm-2 control-label required','style'=>'width:18%;']) !!}
                                <div class="col-sm-6 {{ $errors->has('languages') ? ' has-error' : '' }}" >
                                    
                                        @foreach(getLanguages() as $key=>$value)
                                            <li style="list-style-type:none; display: inline;">
                                                <?php $lang = $value;
                                        $str_lang = explode (", ", $lang);?>
                                        @foreach($str_lang as $language)
                                                    <input type="checkbox" id="language_{{$key}}"    name="languages[]" value="{{$key}}" @if(isset($language) && $language==$key) checked @endif >
                                        @endforeach
                                                <label style="padding-left:19px; padding-right:10px;" for="language_{{$key}}">{{$value}}</label>
                                           
                                         </li>
                                        @endforeach
                                    <span class="help-block">
                                        <strong>
                                            @if($errors->has('languages'))
                                            <p>{{ $errors->first('languages') }}</p>
                                            @endif
                                        </strong>
                                    </span>
                                </div> 
                    </div>
            </div>
        </div>
        <!-- panel-body -->
        <div class="pd-20">
          <button class="btn btn-danger col-md-offset-5"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Update Profile</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
<script>
    function PreviewImage() {
        var oFReader = new FileReader();
         console.log(oFReader.readAsDataURL(document.getElementById("file").files[0]));

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>