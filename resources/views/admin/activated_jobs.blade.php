@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Activated Jobs : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>Logo</th>
                    <th>Company</th>
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
                @foreach($active_jobs as $var)
                <tr>
                    <td>{{$i}}</td>
                    <td>@if(!empty($var->logo))<img src="{{$var->logo}}" style="width:90px; height: 50px;">@else <img src="{{asset('dist/img/images/placements/default.jpg')}}" style="width:90px; height: 50px;"> @endif</td>
                    <td>{{$var->companyName}}</td>
                    <td>{{$var->sectorName}}</td>
                    <td>{{$var->jobRoleName}}</td>
                    <td>{{$var->experienceName}}</td>
                    <td>{{str_replace(",", ",\n ", $var->districtName)}}</td>
                    <td>{{date('F d, Y', strtotime($var->startDate))}}</td>
                    <td>{{date('F d, Y', strtotime($var->toDate))}}</td>
                    <td><button data-toggle="modal" data-target="#myModal1" data-id="{{$var->idJobSession}}" data-title="{{$var->sectorName}} {{$var->jobRoleName}}" class="video_pop intrested btn btn-xs btn-danger"><i class="fa fa-close"></i> Deactivate</button></td>                    
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
    var url = "{{url('/admin/job/')}}";
    var jobname = $(this).data('title');
    $(".explore_pop .course_name").text( jobname );
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/deactivated' );
    });
</script>
@stop