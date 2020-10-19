@extends('layouts.app')
@section('content')
<style>
    .lnk:hover, .lnk:focus{font-weight: 800;}
    .news_scroll-title {
    color: #fff;
    font: normal 20px "Droid Sans", arial, sans-serif;
    text-align: center;
    border-radius: 10px 10px 0 0;
    background: linear-gradient(to right, rgb(16, 138, 224), rgb(0, 214, 251), rgb(0, 95, 148));
    border-bottom: rgb(0, 212, 249) 2px solid;
    padding: 8px 5px 8px 5px;
}
/* FONTS & PADDING */

.scroll-text-if {
        color: #000000;
        font: bold 12px "Droid Sans", arial, sans-serif;
        text-align: left;
        padding: 8px 7px 0px 7px;
        }

.scroll-title-if {
        color: #FA8072;
        font: bold 15px "Droid Sans", arial, sans-serif;
        text-align: left;
        border-bottom: #c6e2ff 0px solid;
        }
</style>
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
        <div class="col-md-3">
            <a href="http://www.hrex.gov.in/" target="_blank" style="color:white" class="lnk"><img src="{{asset('dist/img/images/lin.png')}}"/></a>
        </div>
        <div class="col-md-7">
            <div class="company_search_main">
                <div class="search_div">
                    <div class="search_inputs" style="display: inline-flex;padding-top:5px;" >
                        {!! Form::select('idState', states(),null, ['class' => 'form-control','id'=>'idState']) !!}
                        {!! Form::select('idDistrict', [''=>'--Select District --'],null, ['class' => 'form-control','id'=>'idDistrict']) !!}
                        <input type="submit" class="post_new_job_button" value="Search" style="padding: 1px;font-size: 17px;line-height: 1px;width:40%">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="    margin-top: 1.5%;font-weight: 900;color: white;background: linear-gradient(to right, rgb(26, 41, 128), rgb(38, 208, 206));padding: 6px;font-size: 24px;border-radius: 15px;font-family: none;text-align: center;">
            <?php $count = \App\Candidate::get()->count();?>Total Candidates : <span class="count">{{$count}}</span>
        </div>
        {!! Form::close() !!}
        <div class="placement_search" style="margin-top:8%">
            <div class="placement_sector_list">
                <h3>Search By Sector</h3>
                <div class="placement_list_container">
                    <ul>
                        @foreach ($schemes as $scheme)
                            <?php $class = '';?>
                            @if($scheme->idScheme == 8)
                            <li class="placement_sectr_div {{$scheme->schemeName}}">
                                <div class="placement_sectr_categories">
                                    <a href="{{url('/company/other_sch')}}" class='{{$class}}'>
                                        <div class="con">
                                            <div class="ico"></div>
                                            <p>{{$scheme->schemeName}}</p>
                                            <span style="font-weight: 600;"> Check All
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            @else
                            <li class="placement_sectr_div {{$scheme->schemeName}}">
                                <div class="placement_sectr_categories">
                                    <a href="{{url('/company/scheme/'.$scheme->idScheme.'')}}" class='{{$class}}'>
                                        <div class="con">
                                            <div class="ico"></div>
                                            <p>{{$scheme->schemeName}}</p>
                                            <span style="font-weight: 600;"> <?php 
                                            $secor_ids = $scheme->sector->pluck('idSector')->toArray();
                                            $jobrole_ids =\App\JobRole::whereIn('idSector',$secor_ids)->get()->pluck('idJobRole')->toArray();
                                            $job = \App\Job::whereIn('idJobRole',$jobrole_ids)->get()->pluck('idJob')->toArray();
                                            $jobs =\App\JobSession::whereIn('idJob',$job)->where('toDate','>',Carbon\Carbon::today())->where('isActive','=','Yes')->get()->count();?>
                                                {{$jobs}}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-left: 20px;margin-right: 0px; margin-top:50px;">
    <div class="col-sm-3 newsupdate" style="padding-right: 4%;width:30%;float:right;">
                <div class="stats-info-agile" style="border: 6px ridge rgb(0, 212, 249);border-radius: 5%;box-shadow: 0px 1px 8px 6px rgba(53, 54, 56, 0.47);background: #fff;">
                    <div id="news_iframe_scroll" style="">
                        <div class="news_scroll-title" style="text-align: center;">
                            <b>News and Updates</b><br>
                        </div>
                        <iframe name="NewsIFrame" scrolling="yes" src="{{url('/scroll')}}"  style="overflow-y: auto;overflow-x: hidden;padding: 6px 0px 8px 6px;height: 480px;border-radius: 5%;border: 6px ridge white;background: #fff;border:none"></iframe>
                    </div>
                </div>
    </div>  
    <div class="col-sm-9" style="width:70%">
        <div class="company_search_container">
            <ul class="company_listing" style="margin:0px;">
                @if(count($company_jobs) > 0)
                    @foreach ($company_jobs as $var)            
                        <li class="placement_profile_list">
                            <a href="{{url('/company/job/'.$var->idJob.'')}}">
                                <div class="price">
                                    {{$var->shortName}}
                                </div>
                                <div class="placement_profiles">
                                    <div class="company_img">
                                        @if(count($var->logo)> 0)
                                            <img style="border: 2px solid gainsboro; width: 100%;height:200px" src="{{$var->logo}}"/>
                                        @else
                                           <img style="width: 100%; height:200px" src="{{asset('dist/img/images/placements/default.jpg')}}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="company_text">
                                    <ul>
                                        
                                        <!--<li><p>{{$var->jobDescription}}</p></li>-->
                                        <li class="languages">
                                            <p><span class="fa fa-user"></span>{{$var->designation}}</p>
                                            <p><span class="fa fa-suitcase"></span>{{$var->jobRoleName}}</p>
                                            <p><span class="fa fa-graduation-cap"></span>{{$var->qName}} <span style="float:right" style="font-family: initial;" ><span class="fa fa-coins" ></span> Salary (lacs/annum) : {{$var->salary}}  </span></p>
                                            <p><span class="fa fa-map-marker"></span> {{$var->districtName}} <span style="float:right"><span class="fa fa-map" ></span>Vacancies : {{$var->vacancies}}</span></p>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </li>            
                    @endforeach
                @else
                    <h2 class="empty" style="text-align: center;">Sorry! No Jobs available</h2>   
                @endif
            </ul>    
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