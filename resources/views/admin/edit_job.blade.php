@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default" style="margin:20px;">
    <div class="panel-heading">Edit & View Jobs : <span class="font-semibold">{{ $jobsession->job->company->companyName }}</span></div>
    <div class="panel-body">
    	{!! Form::model( $jobsession, ['route' => ['editjob.update',$jobsession->idJob], 'method' => 'post','class'=>'form-horizontal','files'=> true] ) !!}
    	<div class="row">
    		<div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Sector</label>
                    <div class="col-sm-8 controls">
                      {!! Form::select('idSector',sector(),isset($jobsession) ? $jobsession->job->jobrole->sector->idSector: null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
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
                      {!! Form::select('idJobRole',jobrole(), isset($jobsession) ? $jobsession->job->jobrole->idJobRole: null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
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
	                <label class="col-sm-4 control-label">Job Start Date</label>
	                <div class="col-sm-8 controls">
	                    {!! Form::text('startDate', isset($jobsession) ? $jobsession->startDate: null, ['class' => 'form-control datepicker','autocomplete'=>'off']) !!}
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
	                  {!! Form::text('toDate',isset($jobsession) ? $jobsession->toDate: null, ['class' => 'form-control datepicker','autocomplete'=>'off']) !!}
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
                    <label class="col-sm-4 control-label">Designation</label>
                    <div class="col-sm-8 controls">
                        {!! Form::text('designation',isset($jobsession) ? $jobsession->job->designation: null, ['class' => 'form-control','disabled'=>'disabled']) !!}
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
	                <label class="col-sm-4 control-label">isActive</label>
	                <div class="col-sm-8 controls">
	                  {!! Form::select('isActive',isActive(),isset($jobsession) ? $jobsession->isActive: null, ['class' => 'form-control']) !!}
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
	    </div>
	    <div class="col-sm-12" style="text-align: center;">
            <button class="post_new_job_button" type="submit" style="width:300px">Update Job</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop