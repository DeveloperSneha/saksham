@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Candidates List : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class='table table-bordered table-hover table-striped dataTable' id='table1' >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($candidates as $candidate)
                <tr>
                    <td>{{$candidate->idCandidate}}</td>
                    <td>
                        @if($candidate->image!=null)
                        <img src="{{$candidate->image}}" width="60px" height="60px" style="border-radius: 50%;">
                        @else
                        <img src="{{asset('dist/img/images/default.png')}}" width="60px" height="60px" style="border-radius: 50%;">
                        @endif
                    </td>
                    <td>{{$candidate->firstName}} {{$candidate->lastName}}</td>
                    <td>{{$candidate->fatherName or ''}}</td>
                    <td>{{$candidate->email or ''}}</td>
                    <td>{{$candidate->mobile}}</td>
                    <td style="padding:15px">
                        <a href="{{url('admin/candidates/'.$candidate->idCandidate.'/details')}}" target="_blank" data-candidate_name="{{$candidate->firstName}} {{$candidate->lastName}}" style="text-decoration: none;display: inline-block;padding: 5px 10px;border-radius: 4px;background: #036101;color: #fff;cursor: pointer;">View</a>
                            <span data-toggle="modal" data-target="#myModal1"  data-title="{{$candidate->firstName}} {{$candidate->lastName}}" data-id="{{$candidate->idCandidate}}" class="video_pop intrested" style="display: inline-block;padding: 5px 10px;border-radius: 4px;background: #a20101;color: #fff;cursor: pointer;">Delete</span>
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
                    <p>Are you willing to Delete Candidate <br><span class="course_name"></span><br> ?</p>
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
    var url = "{{url('/admin/candidate/')}}";
    var jobname = $(this).data('title');
    $(".explore_pop .course_name").text( jobname );
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/delete' );
    });
</script>
@stop