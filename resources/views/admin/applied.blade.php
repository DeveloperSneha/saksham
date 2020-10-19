@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Applied Job List : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class='table table-bordered table-hover table-striped dataTable' id='table1' >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Candidate</th>
                        <th>Mobile No.</th>
                        <th>Company</th>
                        <th>Sector</th>
                        <th>Job Role</th>
                        <th>Applied On</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($applied_jobs as $applied)
                <tr>
                    <td>{{$applied->idJobApplied}}</td>
                    <td>{{$applied->firstName}} {{$applied->lastName}}</td>
                    <td>{{$applied->mobile}}</td>
                    <td>{{$applied->companyName}}</td>
                    <td>{{$applied->shortName}}</td>
                    <td>{{$applied->jobRoleName}}</td>
                    <td>{{date('j F, Y', strtotime($applied->updated_at))}}</td>
                    
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
</div>
@stop