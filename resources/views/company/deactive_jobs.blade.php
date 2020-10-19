@extends('company.company_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Deactivated Jobs : <span class="font-semibold"></span></div>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($company_jobs as $var)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$var->job->jobrole->sector->sectorName}}</td>
                    <td>{{$var->job->jobrole->jobRoleName}}</td>
                    <td>{{$var->job->experience->experienceName}}</td>
                    <td>@foreach($var->job->joblocation as $val){{$val->district->districtName}} <br>@endforeach</td>
                    <td>{{$var->startDate}}</td>
                    <td>{{$var->toDate}}</td>
                    <td>
                        <button data-toggle="modal" data-target="#myModal1" data-id="{{$var->idJobSession}}" data-title="{{$var->job->jobrole->sector->sectorName}} {{$var->job->jobrole->jobRoleName}}" class="video_pop intrested btn btn-xs btn-success"><i class="fa fa-check"></i> Activate</button>
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
                    <p>Are you willing to Activate <br><span class="course_name"></span><br> Job?</p>
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
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/activate' );
    });
</script>
@stop