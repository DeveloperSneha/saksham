@extends('candidate.candidate_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Your Mentors : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>Image</th>
                    <th>Mentor Name</th>
                    <th>Sector</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Languages Know</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($mentors as $var)
                <tr>
                    <td>{{$i}}</td>
                    <td>@if(!empty($var->mentor->photo))<img src="{{$var->mentor->photo}}" width="100px" height="60px" style="border:2px solid #156090">@else <img src="{{asset('dist/img/images/default.png')}}" width="100px" height="60px" style="border:2px solid #156090">@endif</td>
                    <td>{{$var->mentor->firstName}} {{$var->mentor->lastName}}</td>
                    <td>{{$var->jobrole->sector->sectorName}}</td>
                    <td>{{$var->mentor->qualification->qName}}</td>
                    <td>{{$var->experience->experienceName}}</td>
                    <td>{{$var->mentor->languages}}</td>
                    <td><a href="{{url('/candidate/mentors/'.$var->mentor->idMentor.'/view')}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View </a></td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop