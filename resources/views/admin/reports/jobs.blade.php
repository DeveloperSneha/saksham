@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Reports : Jobs List <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered dataTable" id='tblreport'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Sector</th>
                        <th>Job Role</th>
                        <th>Job Description</th>
                        <th>Designation</th>
                        <th>Experience Required</th>
                        <th>Qualification Required</th>
                        <th>Age Limit</th>
                        <th>Vacancies</th>
                        <th>Salary</th>
                        <th>State</th>
                        <th>District</th>
                        <th>HR Name</th>
                        <th>HR Contact</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($companies_job as $job)
                <tr>
                    <td>{{$job->idJob}}</td>
                    <td>{{$job->companyName}}</td>
                    <td>{{$job->shortName}}</td>
                    <td>{{$job->jobRoleName}}</td>                    
                    <td>{{$job->jobDescription}}</td>
                    <td>{{$job->designation}}</td>                    
                    <td>{{$job->experienceName}}</td>
                    <td>{{$job->qName}}</td>
                    <td>{{$job->age}}</td>
                    <td>{{$job->vacancies}}</td>
                    <td>{{$job->salary}}</td>
                    <td>{{$job->stateName}}</td>
                    <td>{{$job->districtName}}</td>
                    <td>{{$job->hrName}}</td>
                    <td>{{$job->hrContact}}</td>
                    <td>{{$job->startDate}}</td>
                    <td>{{$job->toDate}}</td>
                    <td>@if($job->toDate > today_date() && $job->isActive =='Yes') Activated @else Deactivated @endif</td>
                    
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
</div>
@stop
@section('script')
<script>
$(function () {
    $('#tblreport').DataTable({
       
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive': true,
        dom: 'lBfrtip',
        
        buttons: [
            { extend: 'excelHtml5', text: 'Export to Excel' ,title: 'Job List',customize: function(xlsx) {
        var sheet = xlsx.xl.worksheets['sheet1.xml'];
        // Loop over the cells
        $('row c', sheet).each(function() {
        //select the index of the row
        var numero=$(this).parent().index() ;
            var residuo = numero%2;
            if (numero==1){           
                $(this).attr('s','22');//22 - Bold, blue background
            }
        });
    },}
        //     'excelHtml5', 'pdfHtml5'
        ]
    });
 });
 </script>
@stop