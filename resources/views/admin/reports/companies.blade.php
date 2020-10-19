@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Reports : Companies List <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered dataTable" id='tblreport'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Owner Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>State</th>
                        <th>District</th>
                        {{-- <th>Website</th> --}}
                        {{-- <th>Company Profile</th> --}}
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>{{$company->idCompany}}</td>
                    <td>{{$company->companyName}}</td>
                    <td>{{$company->ownerName}}</td>
                    <td>{{$company->mobile}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->stateName}}</td>
                    <td>{{$company->districtName}}</td>                   
                    {{-- <td>{{$company->website}}</td> --}}
                    {{-- <td>{{$company->companyProfile}}</td> --}}
                    <td>{{$company->location}}</td>
                    
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
            { extend: 'excelHtml5', text: 'Export to Excel' ,title: 'Companies List',customize: function(xlsx) {
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