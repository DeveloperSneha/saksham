@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Reports :Candidates List <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered dataTable" id='tblreport'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Gender</th>
                    <th>Higher Qualifcation</th>
                    <th>University</th>
                    <th>District</th>
                    <th>Passed Year</th>
                    <th>Medium</th>
                    <th>Percentage</th>
                    <th>Aadhaar No.</th>
                    <th>Email</th>
                    <th>Mobile No.</th>
                    <th>Sector</th>
                    <th>Course Enrolled</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate)
                <tr>
                    <td>{{$candidate->idCandidate}}</td>
                    <td>{{$candidate->firstName}} {{$candidate->lastName}}</td>
                    <td>{{$candidate->fatherName}}</td>
                    <td>{{$candidate->genderName}}</td>
                    <td>{{$candidate->qName}}</td>
                    <td>{{$candidate->universityName}}</td>
                    <td>{{$candidate->districtName}}</td>
                    <td>{{$candidate->passedYear}}</td>
                    <td>{{$candidate->mediumName}}</td>
                    <td>@if(!empty($candidate->percentage)){{$candidate->percentage}} % @endif</td>                   
                    <td>{{$candidate->aadhar}}</td>
                    <td>{{$candidate->email}}</td>
                    <td>{{$candidate->mobile}}</td>
                    <td>{{$candidate->shortName}}</td>
                    <td>{{$candidate->jobRoleName}}</td> 
                    
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
            { extend: 'excelHtml5', text: 'Export to Excel' ,title: 'Candidates List',customize: function(xlsx) {
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