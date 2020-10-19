@extends('company.company_layout')
@section('content')
<?php $company = \App\Company::where('idCompany', '=', Auth::guard('company')->user()->idCompany)->first(); ?>
<div class="panel panel-default">
    <div class="panel-heading">Edit Profile : <span class="font-semibold">{{ $company->companyName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        {!! Form::model( $company_profile, ['route' => ['editprofile.update'], 'method' => 'post','class'=>'form-horizontal','files'=> true] ) !!}
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4" style="padding-left: 0px; padding-right: 0px">
                    <div class="form-group">
                        <div class="col-xs-12">
                          <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 5px;font-family: serif;font-weight: 700">Company Logo</h3>
                          
                          <div class="form-img text-center mgbt-xs-15"> 
                          @if($company->logo)
                          <img style="border-radius: 60px;border-color: teal!important;border: 6px solid; width: 300px; height: 265px;" alt="example image" id="uploadPreview" src="{{$company->logo}}">
                          @else 
                          <img style="border-radius: 60px;border-color: teal!important;border: 6px solid; width: 300px; height: 265px;" alt="example image" id="uploadPreview" src="{{asset('dist/img/images/placements/default.jpg')}}">
                          @endif
                          </div>
                          <div class="form-img-action text-center mgbt-xs-20">
                              <input type="file" name="logo" id="file" style="display:none;" onchange="PreviewImage();">
                              <a class="btn vd_btn  vd_bg-blue" onclick="document.getElementById('file').click();"  style="background: teal;color:white;"><i class="fa fa-cloud"></i> Change & Upload</a> </div>
                              <br>
                              <strong style="font-size: 18px;"><center><span>Status
                                <span class="label label-success">Active</span></span>
                            </center></strong>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-8">
                    <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Profile Setting</h3>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Name</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('companyName', isset($company_profile) ? $company_profile->company->companyName : null, ['class' => 'form-control','placeholder'=>'Enter Company Name','maxlength'=>'15','minlength'=>'2','autocomplete'=>'off','readonly'=>'readonly']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('companyName'))
                                    <p>{{ $errors->first('companyName') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <!-- form-group -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Owner Name</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('ownerName',isset($company_profile) ? $company_profile->company->ownerName : null,['placeholder'=>'Enter Company Owner Name.','minlength'=>'5','maxlength'=>'50']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('ownerName'))
                                    <p>{{ $errors->first('ownerName') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Email</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('email',null,['placeholder'=>'Enter Company Email.','minlength'=>'5','maxlength'=>'50']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('email'))
                                    <p>{{ $errors->first('email') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Website</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('website',null,['placeholder'=>'Enter Company website.','minlength'=>'3']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('website'))
                                    <p>{{ $errors->first('website') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Contact No</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('mobile',null,['placeholder'=>'Enter Company Contact No.','minlength'=>'10','maxlength'=>'10']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('mobile'))
                                    <p>{{ $errors->first('mobile') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Location</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('location',null,['placeholder'=>'Enter Company website.','minlength'=>'3']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('location'))
                                    <p>{{ $errors->first('location') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3 class="mgbt-xs-15" style="text-align: center;padding-bottom: 30px;font-family: serif;font-weight: 700">Profile Setting</h3>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company Profile</label>
                        <div class="col-sm-9 controls">
                          {!! Form::textarea('companyProfile',null,['placeholder'=>'Enter Company Profile.','rows'=>'5']) !!}
                              <span class="help-block">
                                <strong>
                                    @if($errors->has('companyProfile'))
                                    <p>{{ $errors->first('companyProfile') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">State</label>
                        <div class="col-sm-9 controls">
                            {!! Form::select('idState', states(),null, ['class' => 'form-control']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('idState'))
                                    <p>{{ $errors->first('idState') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">District</label>
                        <div class="col-sm-9 controls">
                          {!! Form::select('idDistrict', districts(),null, ['class' => 'form-control']) !!}
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('idDistrict'))
                                    <p>{{ $errors->first('idDistrict') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
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
    });
    
    function PreviewImage() {
        var oFReader = new FileReader();
        console.log(oFReader.readAsDataURL(document.getElementById("file").files[0]));

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>
@stop