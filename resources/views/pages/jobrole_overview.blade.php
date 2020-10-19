@extends('layouts.app')
@section('content')
<div class="banner_wrap" style="background-image: url({{asset('dist/img/images/'.$scheme->schemeImage.'/'.$jobrole_overview->jobRoleImage.'')}}">
    <div class="banner_container">
        <div class="banner_header">
        </div>
    </div>
    <div class="breadcrumbs-wrap">
        <div class="container-breadcrumbs">
            <ol id="navigationBreadCrumbs">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="{{ url('/schemes/'.$scheme->idScheme.'')}}">{{$scheme->schemeName}}</a>
                </li>
                <li class="itemLast">{{$jobrole_overview->jobrole->jobRoleName}}</li>
            </ol>
        </div>
    </div>
</div>
<div class="main_wrap">
    <div class="main_container">
        <!-- <div class="sub_links_category">
            <h3>Sub Categories</h3>
            <ul>
                <li><a href="">Agriculture</a></li>
                <li><a href="">Electronics</a></li>
                <li><a href="">Apparel</a></li>
                <li><a href="">Telecom</a></li>
            </ul>
        </div> -->
        <div class="sub_category_view">
            <h1><!--<span class="fa fa-database"></span>--> <span class="sub_head">{{$jobrole_overview->jobrole->jobRoleName}}</span></h1>

            <ul>
                <li class="category_course_id">
                    <h3>Course ID</h3>
                    <div>{{$jobrole_overview->jobRoleCode}}</div>
                </li>

                <li class="category_overview">
                    <h3>Course Overview</h3>
                    <div>{{$jobrole_overview->jobRoleOverview}}</div>
                </li>

                <li class="category_content">
                    <h3>About the program</h3>
                    <div>{{$jobrole_overview->jobRoleAbout}}</div>
                </li>

                @if($jobrole_overview->duration > 0)
                    <li class="category_duration">
                        <h3>Course Duration</h3>
                        <div>{{$jobrole_overview->duration}} hours</div>
                    </li>
                @endif
                
                <li class="category_should">
                    <h3>Who should do it?</h3>
                    <div>       
                        <ul>
                            @if($jobrole_overview->minQualification || $jobrole_overview->maxQualification)
                                <li>
                                    @if(strlen($jobrole_overview->minQualification) > 0)
                                        <span>Minimum Qualification</span>{{$jobrole_overview->minQualification}}
                                    @endif
                                    @if(strlen($jobrole_overview->maxQualification) > 0)
                                        <span>Maximum Qualification</span>{{$jobrole_overview->maxQualification}}
                                    @endif
                                </li>
                            @endif

                            @if($jobrole_overview->minAge || $jobrole_overview->maxAge)
                                <li>
                                    <span>Age</span>: Between {{$jobrole_overview->minAge}} and {{$jobrole_overview->maxAge}} years<br>
                                    @if($jobrole_overview->minAge> 0) 
                                            <span>Minimum Age</span>{{$jobrole_overview->minAge}} years
                                    @endif
                                    @if($jobrole_overview->maxAge > 0)
                                        <span>Maximum Age</span>{{$jobrole_overview->maxAge}} years
                                    @endif
                                </li>
                            @endif
                                @if($jobrole_overview->experience)
                                    <li><span>Experience</span>{{$jobrole_overview->exprience}}</li>
                                @endif
                            </ul>
                    </div>
                </li>

                @if($jobrole_overview->trainingCenters)
                    <li class="category_training">
                        <h3>Centres for training</h3>
                        <div>{{$jobrole_overview->trainingCenters}}</div>
                    </li>
                @endif

                @if($jobrole_overview->carrerOppurtunities)
                    <li class="category_career">
                        <h3>Careers Opportunities</h3>
                        <div>{{$jobrole_overview->carrerOppurtunities}}</div>
                    </li>
                @endif

                <li class="category_contact">
                    <h3>Point of Contact</h3>
                    <div>
                        <p>District Employment Officer</p>
                        <ul>
                            <li><a target="_blank" href="http://www.hsdm.org.in"><span>Website</span>Haryana Skill Development Mission</a></li>
                            <li><a href="tel: +91-0172 2710215"><span>Mobile</span>+91-0172 2710215</a></li>
                            <li><a href="mailto: sakshamyuva.hsdm@gmail.com"><span>Mail to</span>sakshamyuva.hsdm@gmail.com</a></li>
                        </ul>
                    </div>
                </li>

                <li class="category_contact">
                    <a href="{{url('/explore_course')}}" class="">
                        <span class="fa fa-hand-point-up"></span>Enrol
                    </a></li>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop

