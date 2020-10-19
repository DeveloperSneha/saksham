@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Companies List : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class='table table-bordered table-hover table-striped dataTable' id='table1'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Company Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>District</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company) 
                    <tr>
                      <td>{{$company->idCompany}}</td>
                        <td>
                            @if($company->logo!=null)
                            <img src="{{$company->logo}}" width="100px" height="60px" style="border:2px solid #156090">
                            @else
                            <img src="{{asset('dist/img/images/placements/default.jpg')}}" width="100px" height="60px" style="border:2px solid #156090">
                            @endif
                        </td>
                        <td>{{$company->companyName}}</td>
                        <td>{{$company->ownerName}}</td>
                        <td>{{$company->email}}</td>
                        <td>{{$company->mobile }}</td>
                        <td>{{$company->districtName}}</td>
                        <td>{{date('j F, Y', strtotime($company->created_at))}}</td>
                        <td style="padding:15px">
                            <span data-toggle="modal" data-target="#myModal1" data-title="{{$company->companyName}}" data-id="{{$company->idCompany}}" class="video_pop intrested" style="display: inline-block;padding: 5px 10px;border-radius: 4px;background: #d80000;color: #fff;cursor: pointer;">Delete</span>
                        </td>
                    </tr>
                   @endforeach           
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" id="myModal1">
        <div class="pop_container">
            <div ng-show="interested_popup" class="popup">
                <div class="close close_expore" data-dismiss="modal">x</div>
                <div class="explore_pop">
                    <i class="fa fa-question-circle"></i>
                    <p>Are you willing to Delete Company <br><span class="course_name"></span><br> Job?</p>
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
    var url = "{{url('/admin/company/')}}";
    var jobname = $(this).data('title');
    $(".explore_pop .course_name").text( jobname );
    $(".explore_pop #link").attr('href', url+'/'+jobID+'/delete' );
    });
</script>
@stop