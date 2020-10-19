@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Reports : Companies List <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered dataTable" id='tblreport'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mentor</th>
                    <th>Sector</th>
                    <th>Job Role</th>
                    <th>Experience</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mentors as $mentor)
                <tr>
                    <td>{{$mentor->idMentor}}</td>                    
                    <td>{{$mentor->firstName}}  {{$mentor->lastName}}</td>
                    <td>{{$mentor->shortName}}</td>
                    <td>{{$mentor->jobRoleName}}</td>
                    <td>{{$mentor->experienceName}}</td>
                    <td>{{$mentor->genderName}}</td>
                    <td>{{$mentor->email}}</td>
                    <td>{{$mentor->mobile}}</td>
                    <td>{{date('j F, Y', strtotime($mentor->created_at))}}</td>
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
            { extend: 'excelHtml5', text: 'Export to Excel' ,title: 'Mentors List',customize: function(xlsx) {
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