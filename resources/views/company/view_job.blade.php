@extends('company.company_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit & View Posted Jobs : <span class="font-semibold">{{ $job_details->company->companyName }}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        {!! Form::model( $job_details, ['route' => ['job.update',$job_details->idJob], 'method' => 'post','class'=>'form-horizontal','files'=> true] ) !!}
            <div class="row">
                <strong><legend><center style="margin-top: 25px;margin-bottom: 5px;font-size: 25px;">Edit & Update Job Details</center></legend></strong>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Sector</label>
                        <div class="col-sm-8 controls">
                          {!! Form::select('idSector',sector(),isset($job_details) ? $job_details->jobrole->sector->idSector: null, ['class' => 'form-control']) !!}
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
                          {!! Form::select('idJobRole',jobrole(), null, ['class' => 'form-control']) !!}
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
                        <label class="col-sm-4 control-label">Actual Location</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('actualLocation', null, ['class' => 'form-control']) !!}
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
                            {!! Form::select('idQualification',getQualifications(), null, ['class' => 'form-control']) !!}
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
                            {!! Form::select('idAgeLimit',getAgeLimit(),null, ['class' => 'form-control']) !!}
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
                          {!! Form::select('isActive',isActive(),isset($job_details) ? $job_details->jobsession->isActive: null, ['class' => 'form-control']) !!}
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
                        <label class="col-sm-4 control-label">HR Name</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('hrName',null, ['class' => 'form-control']) !!}
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
                        <label class="col-sm-4 control-label">Job Start Date</label>
                        <div class="col-sm-8 controls">
                            {!! Form::text('startDate', isset($job_details) ? $job_details->jobsession->startDate: null, ['class' => 'form-control datepicker','autocomplete'=>'off']) !!}
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
                        <label class="col-sm-4 control-label">Hr Contact No.</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('hrContact',null, ['class' => 'form-control']) !!}
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Job End Date</label>
                        <div class="col-sm-8 controls">
                          {!! Form::text('toDate',isset($job_details) ? $job_details->jobsession->toDate: null, ['class' => 'form-control datepicker','autocomplete'=>'off']) !!}
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
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Job Description</label>
                        <div class="col-sm-10 controls" style="padding-left: 1px; padding-right: 1px">
                            {!! Form::textarea('jobDescription', null, ['class' => 'form-control','cols'=>'101']) !!}
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
                    <button class="post_new_job_button" type="submit" style="width:300px">Update Job</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
