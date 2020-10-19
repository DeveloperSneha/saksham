@extends('layouts.app')
@section('content')
<div class="banner_wrap" style="background-image: url({{asset('dist/img/images/placement.jpg')}}); min-height: 480px;">
    <div class="banner_container">
        <div class="login_register_company">
            <a href="http://hsdm.org.in/testimonials.html" target="_blank" style="background:#fb6d05;float: left; color:white;padding: 6px; border-radius: 5px;"><b>Testimonials</b></a>
            <a href="http://hsdm.org.in/placements.html" target="_blank" style="background:#fb6d05;float: left; color:white;padding: 6px; border-radius: 5px;margin-left: 10px;"><b>Placements</b></a>  
            <ul>
                <!--<li><a href="">Candidate Alumni</a></li>-->
                <li><a href="{{url('/candidate/login')}}">Candidate Login</a></li>
                <li><a href="{{url('/candidate/register')}}">Candidate Registration</a></li>
                <li><a href="{{url('/alumini')}}">Candidate Alumini</a></li>
                <li><a href="{{url('/company/login')}}">Company Login</a></li>
                <li><a href="{{url('/company/register')}}">Company Registration</a></li>
            </ul>          
        </div>
        <div class="company_header">
            <br><br> <h2 class="tac">Bringing Talent Closer to Opportunities</h2>
        </div>
        {!! Form::open(['method' => 'GET',  'action' => ['MainController@getStateWiseJobs']]) !!}
        <div class="company_search_main">
            <div class="search_div">
                <div class="search_inputs" style="display: inline-flex;" ng-controller="company_dashboard_controller">
                    {!! Form::select('idState', states(),null, ['class' => 'form-control','id'=>'idState']) !!}
                    {!! Form::select('idDistrict', [''=>'--Select District --'],null, ['class' => 'form-control','id'=>'idDistrict']) !!}
                    <input type="submit" class="post_new_job_button" value="Search" style="padding: 1px;font-size: 17px;line-height: 1px;width:40%">
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="placement_search">
            <div class="placement_sector_list" style="position: relative;">
                <h3>Search By Sector</h3>
                <div class="placement_list_container">
                    <ul>
                        @foreach ($sectors as $sector)
                            <?php $class = '';?>
                            <li style="margin-bottom: 15px;" class="placement_sectr_div {{$sector->scheme->schemeName}}">
                                <div class="placement_sectr_categories">
                                    <a href="{{url('/company/sector/'.$sector->idSector.'')}}" class='{{$class}}'>
                                        <div class="con">
                                            <div class="ico"></div>
                                            <p>{{$sector->shortName}}</p>
                                            <span style="font-weight: 600;">
                                                <?php 
                                                $jobrole_ids = $sector->jobrole->pluck('idJobRole')->toArray();
                                                $job = \App\Job::whereIn('idJobRole',$jobrole_ids)->get()->pluck('idJob')->toArray();
                                                $jobs =\App\JobSession::whereIn('idJob',$job)->where('toDate','>',Carbon\Carbon::today())->where('isActive','=','Yes')->get()->count();?>
                                                 {{$jobs}}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        
        $('select[name="idState"]').on('change', function() {
        var stateID = $(this).val();
        if(stateID) {
            $.ajax({
                url: "{{url('/state/') }}"+'/' +stateID + "/districts",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="idDistrict"]').empty();
                    $('select[name="idDistrict"]').append('<option value="">--- Select District ---</option>');
                    $.each(data, function(key, value) {
                        $('select[name="idDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                }
            });
        }else{
            $('select[name="idDistrict"]').empty();
        }
    });

var cur_state = $( "#idState option:selected" ).val();
        if(cur_state) {
            $.ajax({
                url: "{{url('/state/') }}"+'/' +cur_state + "/districts",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="idDistrict"]').empty();
                    $('select[name="idDistrict"]').append('<option value="">--- Select District ---</option>');
                    $.each(data, function(key, value) {
                        $('select[name="idDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                }
            });
        }else{
            $('select[name="idDistrict"]').empty();
        }
    });
</script>
@stop