Dear Team,
<br><br>
The list of companies registered today :<br><br>
<table border="2" bgcolor="lightgray">
    <thead>
        <tr>
            <th>Sr No.</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>District</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;?>
        @foreach($company as $val)
        <tr>
            <td>{{$i}}</td>
            <td>{{$val->companyName}}</td>
            <td>{{$val->email}}</td>
            <?php $pro = App\CompanyProfile::where('idCompany','=',$val->idCompany)->first();
                $district =App\District::where('idDistrict','=',$pro->idDistrict)->first();?>
            <td>{{$district->districtName}}</td>
            <td>{{$val->created_at}}</td>
        </tr>
        <?php $i++;?>
        @endforeach
    </tbody>
</table>
<br><br>

<b>Regards,<br>
Haryana Skill Development Mission</b>