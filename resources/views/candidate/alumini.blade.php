@extends('layouts.app')
@section('content')
<div class="candidate_wrap" style="background: url({{asset('dist/img/images/office.jpg')}}) no-repeat; background-size:cover;padding-bottom: 25px; padding-top: 25px;">
  	<div class="candidate_container" style="max-width: 589px;border-radius: 30px; padding: 25px 20px;">
  		<form method="POST" action="{{ route('alumini.submit')}}" class="form-horizontal">
            {{ csrf_field() }}
	      	<div class="login-form" style="width:350px">
			    <h2 style="text-align: center; margin-bottom: 10px;"><span style="color:crimson;">Candidate Alumini</span></h2>
			    <div class="form-fields">
			        <i class="fas fa-user-tie" aria-hidden="true"></i>
			        <input class="name-login" type="text" placeholder="Enter Your Name" name="candidateName" required>
			    </div>
			    <div class="form-fields">
			        <i class="fa fa-user" aria-hidden="true"></i>
			        <input type="text" class="name-login" placeholder="Enter FatherName" name="fatherName" required>
			    </div>
			     <div class="form-fields">
			        <i class="fa fa-envelope" aria-hidden="true"></i>
			        <input class="name-login" type="email" placeholder="Enter Email ID" name="email" required>
			    </div>
			    <div class="form-fields">
			        <i class="fa fa-phone" aria-hidden="true"></i>
			        <input class="name-login" type="text" placeholder="Enter Mobile No" name="mobile" required>
			    </div>
			    <div class="form-fields">
			    	<i class="fa fa-suitcase" aria-hidden="true"></i>
			        <select id="job_role" name="idJobRole" class="name-login" required="required">
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
			    <div class="form-fields">
			        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
			        <input class="name-login datepicker" type="text" name="passedYear" id="passedYear" placeholder="Passed Year" required>
			    </div>
			    <button type="submit" class="cand_btn" style="margin-top:1px;">Submit</button>
			</div>
		</form>
	</div>
</div>
@stop
