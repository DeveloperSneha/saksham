@extends('candidate.candidate_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Applied Jobs : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>Sector</th>
                    <th>Job Role</th>
                    <th>Experience Required</th>
                    <th>District</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($applied_jobs as $var)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$var->job->jobrole->sector->shortName}}</td>
                    <td>{{$var->job->jobrole->jobRoleName}}</td>
                    <td>{{$var->job->experience->experienceName}}</td>
                    <td>@foreach($var->job->jobLocation as $val) {{$val->district->districtName}} <br>@endforeach</td>
                    <td>{{$var->job->jobsession->startDate}}</td>
                    <td>{{$var->job->jobsession->toDate}}</td>
                    <td><a href="{{url('/candidate/job/'.$var->idJob.'/details')}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View </a></td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop