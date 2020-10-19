@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Companies List : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class='table table-bordered table-hover table-striped dataTable' id='table1' >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Mentor Name</th>
                        <th>Job Role</th>
                        <th>Experience</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mentors as $mentor)
                    <tr>
                        <td>{{$mentor->idMentor}}</td>
                        <td>
                            @if($mentor->photo!=null)
                            <img src="{{$mentor->photo}}" width="80px" height="60px" style="border:2px solid #156090">
                            @else
                            <img src="{{asset('dist/img/images/default.png')}}" width="80px" height="60px" style="border:2px solid #156090">
                            @endif
                        </td>
                        <td>{{$mentor->firstName}}  {{$mentor->lastName}}</td>
                        <td>{{$mentor->jobRoleName}}</td>
                        <td>{{$mentor->experienceName}}</td>
                        <td>{{$mentor->email}}</td>
                        <td>{{$mentor->mobile}}</td>
                        <td>{{date('j F, Y', strtotime($mentor->created_at))}}</td>
                        <td>
                           <span data-toggle="modal" data-target="#myModal1" data-title="{{$mentor->firstName}}{{$mentor->lastName}}" data-id="{{$mentor->idMentor}}"class="video_pop intrested" style="display: inline-block;padding: 5px 10px;border-radius: 4px;background: #d80000;color: #fff;cursor: pointer;">Delete</span>
                        </td>
                    </tr>
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
                    <p>Are you willing to Delete Mentor <br><span class="course_name"></span><br>?</p>
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
    var url = "{{url('/admin/mentor/')}}";
    var jobname = $(this).data('title');
    $(".explore_pop .course_name").text( jobname );
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/delete' );
    });
</script>
@stop