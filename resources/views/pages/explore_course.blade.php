@extends('layouts.app')
@section('content')
<div class="training_list" ng-controller="explore_course">

    <div class="search_wrap explore_course_header">
        <div class="course_search_training">
            <div class="course_training_container">
                <ul>
                    <li class="done">
                        <a href="/explore_course/">
                            <div class="c100 p50">
                                <span class="fa fa-search"></span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                            <p class="">Explore Courses</p>
                        </a>
                    </li>

                    <li>
                        <div class="c100 p50">
                            <span class="fa fa-book"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p class="">Enrol For Course</p>
                    </li>
                    <li>
                        <div class="c100 p50">
                            <span class="fa fa-list"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p class="">Find DEO</p>
                    </li>
                    <li>
                        <div class="c100 p50">
                            <span class="fa fa-star"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p class="">Get Placed</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Explore Course -->
    <div class="search_wrap explore_course">
        <div class="search_div">
            <h2>Explore Courses</h2>
            <div class="search_inputs_cn sector" style="margin-left: 25px;">
                <div id="sector">
                    <span class="fa fa-book"></span>
                    <p>By Sector</p>
                </div>
                <ul class="sector_btns">
                    @foreach ($schemes as $scheme)
                    <li><a href="{{url('/explore_course/scheme/'.$scheme->idScheme.'')}}">
                        <div class="imgs"></div>
                        <p>{{$scheme->schemeName}}</p>
                    </a></li>
                    @endforeach
                </ul>
            </div>
            <div class="search_inputs_cn place">
                <div id="place">
                    <span class="fas fa-map-marker-alt"></span>
                    <p>By Place</p>
                </div>
                <div class="place_lists">
                    <ul class="places_btns">
                        <div id="map" >
                            <img src="{{asset('dist/img/images/haryana_district_map.gif')}}" width="550" height="550" alt="haryana" usemap="#haryanamap">
                            <map name="haryanamap">
                                <area shape="circle" coords="415,70,25" alt="Panchkula" href="{{url('/explore_course/district/70')}}">
                                <area shape="circle" coords="415,110,25" alt="Ambala" href="{{url('/explore_course/district/58')}}">
                                <area shape="circle" coords="480,120,25" alt="Yamunanagar" href="{{url('/explore_course/district/76')}}">
                                <area shape="circle" coords="400,160,25" alt="Kurukshetra" href="{{url('/explore_course/district/68')}}">
                                <area shape="circle" coords="330,190,25" alt="Kaithal" href="{{url('/explore_course/district/66')}}">
                                <area shape="circle" coords="420,200,35" alt="Karnal" href="{{url('/explore_course/district/67')}}">
                                <area shape="circle" coords="80,230,40" alt="Sirsa" href="{{url('/explore_course/district/74')}}">
                                <area shape="circle" coords="180,230,30" alt="Fatehabad" href="{{url('/explore_course/district/61')}}">
                                <area shape="circle" coords="320,270,15" alt="Jind" href="{{url('/explore_course/district/65')}}">
                                <area shape="circle" coords="406,260,25" alt="Panipat" href="{{url('/explore_course/district/71')}}">
                                <area shape="circle" coords="420,320,25" alt="Sonipat" href="{{url('/explore_course/district/75')}}">
                                <area shape="circle" coords="230,290,30" alt="Hisar" href="{{url('/explore_course/district/63')}}">
                                <area shape="circle" coords="340,330,15" alt="Rohtak" href="{{url('/explore_course/district/73')}}">
                                <area shape="circle" coords="260,340,20" alt="Bhiwani" href="{{url('/explore_course/district/59')}}">
                                <area shape="circle" coords="300,370,15" alt="Charkhi Dadri" href="{{url('/explore_course/district/701')}}">
                                <area shape="circle" coords="380,375,15" alt="Jhajjar" href="{{url('/explore_course/district/64')}}">
                                <area shape="circle" coords="300,440,25" alt="Mahendragarh" href="{{url('/explore_course/district/69')}}">
                                <area shape="circle" coords="340,430,20" alt="Rewari" href="{{url('/explore_course/district/72')}}">
                                <area shape="circle" coords="420,400,20" alt="Gurugram" href="{{url('/explore_course/district/62')}}">
                                <area shape="circle" coords="490,410,20" alt="Faridabad" href="{{url('/explore_course/district/60')}}">
                                <area shape="circle" coords="495,475,20" alt="Palwal" href="{{url('/explore_course/district/619')}}">
                                <area shape="circle" coords="440,460,20" alt="Nuh" href="{{url('/explore_course/district/604')}}">
                            </map>
                        {{-- </div> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Listing of DEO -->
    <div id="deo_listing" class="search_wrap deo_listing">
        <div class="heading">
            <h2><span><span class="first_letter">A</span>vailable <span class="first_letter">C</span>ourses</span></h2>
            <p>Make the most of the opportunity available by Exploring among the trending Courses and get Skilled</p>
        </div>

        <div class="explore_details">
            @if(count($explore_course) == 0)
                <h2 class="empty">Sorry! No courses available</h2>
            @else
                @foreach ($explore_course as $course)
                @if($course->jobrole)
                <div class="explore_view">
                    <div class="img_sector_div">
                        <?php if($course->jobrole->sector->sectorName == "Apparel, Made-Ups & Home Furnishing")
                        $course->jobrole->sector->sectorName ="Apparel";?>
                        <?php if($course->jobrole->sector->sectorName == "Banking, Financial Services and Insurance")
                        $course->jobrole->sector->sectorName ="BFSI";?>
                        <?php if($course->jobrole->sector->sectorName == "Electronics & Hardware")
                        $course->jobrole->sector->sectorName ="Electronics";?>
                        <div class="img_sector {{$course->jobrole->sector->sectorName or ''}}"></div>
                        <p>{{$course->jobrole->sector->sectorName or ''}}</p>
                    </div>                    
                    <ul class="explore_img_div">
                        <li>
                            <h4 class="brief">
                                <a href="">{{$course->jobrole->jobRoleName or ''}}</a>
                            </h4>
                        </li>
                        
                        @if ($course->idDistrict)
                            <li><a href="{{url('/explore_course/district/'.$course->idDistrict.'')}}">
                                <i class="fa fa-map-marker"></i> {{$course->district->districtName or ''}}</a>
                            </li>
                        @endif
                        <li class="explore_enrol">
                                <button data-toggle="modal" data-target="#myModal1" data-id="{{$course->idJobRole}}" data-title="{{$course->jobrole->jobRoleName or ''}}" class="video_pop intrested">Enroll</button>
                                {{-- <span ng-click="enrol_course($event)" data-explore_job_role={{$jobrole->job_role}} data-explore_job_id="{{$jobrole->id}}" class="video_pop intrested">Enroll</span> --}}
                        </li>
                    </ul>
                </div>
                @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="modal" id="myModal1">
        <div class="pop_container">
            <div ng-show="interested_popup" class="popup">
                <div class="close close_expore" data-dismiss="modal">x</div>
                <div class="explore_pop">
                    <i class="fa fa-question-circle"></i>
                    <p>Are you willing to enroll <br><span class="course_name"></span><br> course?</p>
                    <div class="explore_yes_no">
                        <a href="" id="link" class="explore_yes">Yes</a>
                        <span data-toggle="modal" data-target="#myModal" class="explore_no" data-dismiss="modal">No</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="pop_container">
            <div class="popup">
              <div class="close close_expore" data-dismiss="modal">x</div>
                <div class="explore_pop">
                    <i class="fa fa-exclamation-circle"></i>
                    <p>Do you want to explore other courses offered by HSDM ?</p>
                    <div class="explore_yes_no">
                        <a target="_blank" href="http://www.hsdm.org.in/" class="explore_yes">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@stop
@section('script')
<script>
    $(document).on("click", ".video_pop", function () {
    var jobroleID = $(this).data('id');
    console.log(jobroleID);
    var url = "{{url('/candidate/enrol/')}}";
    var jobrole = $(this).data('title');
    console.log(jobrole);
    $(".explore_pop .course_name").text( jobrole );
    $(".explore_pop #link").attr('href', url+'/'+jobroleID );
    });
</script>
@stop