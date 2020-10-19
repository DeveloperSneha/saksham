@extends('company.company_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Post New Job : <span class="font-semibold">{{ $company->companyName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        {!! Form::model( $company, ['route' => ['jobpost'], 'method' => 'post','class'=>'form-horizontal','files'=> true,'id'=>'jobpost']) !!}
            <div class="row">
                <strong><legend><center style="margin-top: 25px;margin-bottom: 5px;font-size: 25px;">Job Details</center></legend></strong>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Sector</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('idSector',$sector, null, ['class' => 'form-control']) !!}
                              <span id="idSector1"></span>
                              <span class="help-block">
                                <strong>
                                    @if($errors->has('idSector'))
                                    <p>{{ $errors->first('idSector') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Job Role</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('idJobRole',[''=>'Select Job Role'], null, ['class' => 'form-control']) !!}
                            <span id="idJobRole1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('idJobRole'))
                                    <p>{{ $errors->first('idJobRole') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8 controls">
                            {!! Form::select('idState[]', getStates(),null, ['class' => 'form-control state select2','multiple'=>'multiple']) !!}
                            <span id="idState1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('idState'))
                                    <p>{{ $errors->first('idState') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">District</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('job_location[]',[''=>'-- Select District --'],null, ['class' => 'form-control select2','multiple'=>'multiple','id'=>'idDistrict']) !!}
                            <span id="job_location1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('job_location[]'))
                                    <p>{{ $errors->first('job_location[]') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Actual Location</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('actualLocation',null, ['class' => 'form-control']) !!}
                            <span id="actualLocation1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('actualLocation'))
                                    <p>{{$errors->first('actualLocation')}}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Qualifcation</label>
                        <div class="col-sm-8 controls">
                            {!! Form::select('idQualification', getQualifications(),null, ['class' => 'form-control']) !!}
                            <span id="idQualification1"></span>
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Experience</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('idExperience',getExperience(),null, ['class' => 'form-control']) !!}
                          <span id="idExperience1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('idExperience'))
                                    <p>{{ $errors->first('idExperience') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Designation</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('designation',null, ['class' => 'form-control']) !!}
                            <span id="designation1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('designation'))
                                    <p>{{ $errors->first('designation') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Vacancies</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('vacancies',null, ['class' => 'form-control']) !!}
                          <span id="vacancies1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('vacancies'))
                                    <p>{{ $errors->first('vacancies') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Salary Package</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('salary', null, ['class' => 'form-control','placeholder'=>'Salary per Annum']) !!}
                            <span id="salary1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('salary'))
                                    <p>{{ $errors->first('salary') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Salary Negotiable</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('salaryNegotiable',getSalaryNegotiable(),null, ['class' => 'form-control']) !!}
                            <span id="salaryNegotiable1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('salaryNegotiable'))
                                    <p>{{ $errors->first('salaryNegotiable') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Age Limit</label>
                        <div class="col-sm-8 controls">
                            {!! Form::select('idAgeLimit', getAgeLimit(),null, ['class' => 'form-control']) !!}
                            <span id="idAgeLimit1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('idAgeLimit'))
                                    <p>{{ $errors->first('idAgeLimit') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">isActive</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('isActive',isActive(),null, ['class' => 'form-control']) !!}
                            <span id="isActive1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('isActive'))
                                    <p>{{ $errors->first('isActive') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Job Start Date</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('startDate', null, ['class' => 'form-control datepicker','autocomplete'=>'off']) !!}
                            <span id="startDate1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('startDate'))
                                    <p>{{ $errors->first('startDate') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Job End Date</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('toDate',null, ['class' => 'form-control datepicker','autocomplete'=>'off']) !!}
                            <span id="toDate1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('toDate'))
                                    <p>{{ $errors->first('toDate') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">HR Name</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('hrName',null, ['class' => 'form-control']) !!}
                            <span id="hrName1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('hrName'))
                                    <p>{{ $errors->first('hrName') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Hr Contact No.</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('hrContact',null, ['class' => 'form-control']) !!}
                          <span id="hrContact1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('hrContact'))
                                    <p>{{ $errors->first('hrContact') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Job Description</label>
                        <div class="col-sm-10 controls" style="padding-left: 1px; padding-right: 1px">
                            {!! Form::textarea('jobDescription', null, ['class' => 'form-control','cols'=>'101']) !!}
                            <span id="jobDescription1"></span>
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('jobDescription'))
                                    <p>{{ $errors->first('jobDescription') }}</p>
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    <button class="post_new_job_button" type="submit" style="width:300px">Post Job</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="idState[]"]').on('change', function() {
        var stateIDs = [];
        $('.state').each(function () {
            stateIDs.push($(this).val());
        });
        // var stateIDs[] = $(this).val();
            if(stateIDs) {
                $.ajax({
                    url: "{{url('/states') }}"+'/' +stateIDs + "/districts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="idDistrict"]').empty();
                        $('select[id="idDistrict"]').append('<option value="">--- Select District ---</option>');
                        $.each(data, function(key, value) {
                            $('select[id="idDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[id="idDistrict"]').empty();
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
    
    $('#jobpost').on('submit',function(e){
    $.ajaxSetup({
    header:$('meta[name="_token"]').attr('content')
    });
    var formData =  new FormData($('#jobpost')[0]);
       $.ajax({
           type:"POST",
           url: "{{url('company/jobpost') }}",
           processData: false,
           contentType: false,
           data:formData,
           dataType: 'json',
           success:function(data){
              if( data[Object.keys(data)[0]] === 'SUCCESS' ){     //True Case i.e. passed validation
                  window.location = "{{url('company/jobs')}}";
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
                       $.each( errors, function( key, value ) {    
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
                            if(errors['actualLocation']=== undefined){
                                $( '#actualLocation1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['actualLocation']+'</strong></span>';
                               $( '#actualLocation1' ).html( errorname );
                            }
                            if(errors['idQualification']=== undefined){
                                $( '#idQualification1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['idQualification']+'</strong></span>';
                               $( '#idQualification1' ).html( errorname );
                            }
                            if(errors['idExperience']=== undefined){
                                $( '#idExperience1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['idExperience']+'</strong></span>';
                               $( '#idExperience1' ).html( errorname );
                            }
                            if(errors['designation']=== undefined){
                                $( '#designation1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['designation']+'</strong></span>';
                               $( '#designation1' ).html( errorname );
                            }
                            if(errors['vacancies']=== undefined){
                                $( '#vacancies1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['vacancies']+'</strong></span>';
                               $( '#vacancies1' ).html( errorname );
                            }
                            if(errors['salary']=== undefined){
                                $( '#salary1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['salary']+'</strong></span>';
                               $( '#salary1' ).html( errorname );
                            }
                            if(errors['salaryNegotiable']=== undefined){
                                $( '#salaryNegotiable1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['salaryNegotiable']+'</strong></span>';
                               $( '#salaryNegotiable1' ).html( errorname );
                            }
                            if(errors['idAgeLimit']=== undefined){
                                $( '#idAgeLimit1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['idAgeLimit']+'</strong></span>';
                               $( '#idAgeLimit1' ).html( errorname );
                            }
                            if(errors['isActive']=== undefined){
                                $( '#isActive1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['isActive']+'</strong></span>';
                               $( '#isActive1' ).html( errorname );
                            }
                            if(errors['startDate']=== undefined){
                                $( '#startDate1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['startDate']+'</strong></span>';
                               $( '#startDate1' ).html( errorname );
                            }
                            if(errors['toDate']=== undefined){
                                $( '#toDate1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['toDate']+'</strong></span>';
                               $( '#toDate1' ).html( errorname );
                            }
                            if(errors['hrName']=== undefined){
                                $( '#hrName1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['hrName']+'</strong></span>';
                               $( '#hrName1' ).html( errorname );
                            }
                            if(errors['hrContact']=== undefined){
                                $( '#hrContact1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['hrContact']+'</strong></span>';
                               $( '#hrContact1' ).html( errorname );
                            }
                            if(errors['jobDescription']=== undefined){
                                $( '#jobDescription1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['jobDescription']+'</strong></span>';
                               $( '#jobDescription1' ).html( errorname );
                            }
                            if(errors['idState[]']=== undefined){
                                $( '#idState1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['idState[]']+'</strong></span>';
                               $( '#idState1' ).html( errorname );
                            }
                            if(errors['job_location[]']=== undefined){
                                $( '#job_location1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['job_location[]']+'</strong></span>';
                               $( '#job_location1' ).html( errorname );
                            }
                       });
                }
            }
       });
       return false;
    });
    });
</script>
@stop