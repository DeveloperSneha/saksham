@extends('company.company_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Posted Jobs : <span class="font-semibold">{{ Auth::guard('company')->user()->companyName }}</span></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>Sector</th>
                    <th>Job Role</th>
                    <th>Experience</th>
                    <th>District</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($company_jobs as $var)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$var->jobrole->sector->sectorName}}</td>
                    <td>{{$var->jobrole->jobRoleName}}</td>
                    <td>{{$var->experience->experienceName}}</td>
                    <td>@foreach($var->joblocation as $val){{$val->district->districtName}}, <br>@endforeach</td>
                    <td>{{$var->jobsession->startDate}}</td>
                    <td>{{$var->jobsession->toDate}}</td>
                    <td>@if($var->jobsession->isActive == 'Yes')Activated
                        @elseif($var->jobsession->isActive == 'No')Deactivated
                        @endif
                    </td>
                    <td style="width:208px;"><a href="{{url('/company/job/'.$var->idJob.'/viewJob')}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Edit </a>
                        <a href="{{url('/company/job/'.$var->idJob.'/editloc')}}" class="btn btn-xs btn-primary"><i class="fa fa-map"></i> Edit Location</a>
                    <a data-toggle="modal" data-target="#myModal1" data-id="{{$var->idJob}}" data-title="{{$var->jobrole->sector->sectorName}} {{$var->jobrole->jobRoleName}}" class="video_pop intrested btn btn-xs btn-danger"><i class="fa fa-close"></i> Delete</a>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal" id="myModal1">
        <div class="pop_container">
            <div ng-show="interested_popup" class="popup">
                <div class="close close_expore" data-dismiss="modal">x</div>
                <div class="explore_pop">
                    <i class="fa fa-question-circle"></i>
                    <p>Are you willing to Delete <br><span class="course_name"></span><br> Job?</p>
                    <div class="explore_yes_no">
                        <a href="" id="link" class="explore_yes">Yes</a>
                        <span class="explore_no" data-dismiss="modal">No</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    $(document).on("click", ".video_pop", function () {
    var jobID = $(this).data('id');
    console.log(jobID);
    var url = "{{url('/company/job/')}}";
    var jobname = $(this).data('title');
    $(".explore_pop .course_name").text( jobname );
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/deleteJob' );
    });
</script>
@stop