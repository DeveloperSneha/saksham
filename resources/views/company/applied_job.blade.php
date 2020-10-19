@extends('company.company_layout')
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
                    <th>Candidate Name</th>
                    <th>Father Name</th>
                    <th>Mobile No.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($job_applied as $var)
               <tr>
                    <td>{{$i}}</td>
                    <td>{{$var->job->jobrole->sector->sectorName}}</td>
                    <td>{{$var->job->jobrole->jobRoleName}}</td>
                    <td>{{$var->candidate->firstName}} {{$var->candidate->lastName}}</td>
                    <td>{{$var->candidate->fatherName}}</td>
                    <td>{{$var->candidate->mobile}}</td>
                    <td><a href="{{url('/company/applied/'.$var->idJobApplied.'/details')}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View </a></td>
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
                    <p>Are you willing to Deactivate <br><span class="course_name"></span><br> Job?</p>
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
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/deactivate' );
    });
</script>
@stop