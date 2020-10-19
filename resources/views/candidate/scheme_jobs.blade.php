@extends('candidate.candidate_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Jobs : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <div class="company_search_container">
            <ul class="company_listing" style="margin: 10px auto 0;">
                @foreach ($company_jobs as $job)
                @if(count($job) > 0)
                    <li class="placement_profile_list">
                        <a href="{{url('/candidate/job/'.$job->idJob.'/details')}}">
                            <div class="price">
                                {{$job->shortName}}
                            </div>
                            <div class="placement_profiles">
                                <div class="company_img">
                                    @if(count($job->logo)> 0)
                                        <img style="border: 2px solid gainsboro; width: 100%;height:200px" src="{{$job->logo}}"/>
                                    @else
                                       <img style="width: 100%; height:200px" src="{{asset('dist/img/images/placements/default.jpg')}}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="company_text">
                                <ul>
                                    <li>
                                        <div class="comp_name">{{$job->companyName}}</div>
                                    </li>
                                    <!--<li><p>{{$job->jobDescription}}</p></li>-->
                                    <li class="languages">
                                        <p><span class="fa fa-user"></span>{{$job->designation}}</p>
                                        <p><span class="fa fa-suitcase"></span>{{$job->jobRoleName}}</p>
                                        <p><span class="fa fa-graduation-cap"></span>{{$job->qName}} <span class="fa fa-map" style="margin-left:40%"></span>Vacancies :{{$job->vacancies}}</p>
                                        <p><span class="fa fa-map-marker"></span>{{$job->districtName}}</p>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </li>
                @else
                    <h2 class="empty">Sorry! No Jobs available</h2>   
                @endif
                @endforeach
                
            </ul>    
        </div>
    </div>
</div>
@stop