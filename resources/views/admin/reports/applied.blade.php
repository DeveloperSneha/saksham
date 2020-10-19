@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Reports : Applied Job List <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered dataTable" id='tblreport'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Candidate</th>
                        <th>Father Name</th>
                        <th>Mobile</th>
                        <th>Aadhaar No.</th>
                        <th>Company</th>
                        <th>Job Designation</th>
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
                    <td>{{$applied->fatherName}}</td>
                    <td>{{$applied->mobile}}</td>
                    <td>{{$applied->aadhar}}</td>
                    <td>{{$applied->companyName}}</td>
                    <td>{{$applied->designation}}</td>
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
            { extend: 'excelHtml5', text: 'Export to Excel' ,title: 'Candidates Applied For Jobs',customize: function(xlsx) {
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