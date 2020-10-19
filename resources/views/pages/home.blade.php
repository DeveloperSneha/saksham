@extends('layouts.app')
@section('content')
<style>
.flip_pop img{
    height: 600px;
    width:580px;
}
.page {
 width:582px!important;   
}
</style>

<div class="slider_banner_wrap">
    <div class="container-banner">
        <div id="interactive" class="interactive">
            <ol id="slides" class="slides">
                {{-- <li class="slide slide1" style="background: url({{asset('dist/img/images/slide1.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide2" style="background: url({{asset('dist/img/images/slide2.jpg')}}) no-repeat top center;"></li> --}}
                <li class="slide slide3 lazy" style="background: url({{asset('dist/img/images/slide3.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide4 lazy" style="background: url({{asset('dist/img/images/slide4.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide5 lazy" style="background: url({{asset('dist/img/images/slide5.jpg')}}) no-repeat top center;"></li>       
                <li class="slide slide6 lazy">
                    <div class="analytics_div" style="padding: 5px 20px 19px;border-radius: 0px; display: table;width: 100%;margin-bottom: 0px;background: linear-gradient(to right, rgb(0, 197, 197), rgb(144, 224, 204), rgb(9, 253, 187));">
                        <div class="head_slide"><span class="first_letter">S</span>aksham <span class="first_letter">D</span>arpan</div>
                        <h2 style="color:black;text-align: center;">Statistics Of Candidate By Sector Wise - Enrolled</h2>
                        <?php $counter = 1; $active = '';
                            if($counter == 1) { $active = ' active ';}
                        ?>
                        <div class="sector_training sector_data_div {{$active}}" id="sectorwise_{{$counter}}">
                            <div class="analytics_data">
                                <ul class="data_head">
                                    <li>Sector</li>
                                    <li>Male</li>
                                    <li>Female</li>
                                    <li>Total</li>
                                </ul>
                                <?php
                                $GRAPH_DATA_POINTS = array();
                                $CANDIDATE_KEY = 'training';?>
                                @foreach($darpan_data as $darpan)
                                <ul class="data_values">
                                    <li>{{$darpan->sector_name}}</li>
                                    <li>{{$darpan->training_male}}</li>
                                    <li>{{$darpan->training_female}}</li>
                                    <li>{{$darpan->training_male + $darpan->training_female}}</li>
                                    
                                    <?php  $total= $darpan->training_male + $darpan->training_female;
                                    $GRAPH_DATA_POINTS[] = array(
                                        'label' => $darpan->sector_name,
                                        'y' => $total,
                                        'male_count' => $darpan->training_male,
                                        'female_count' => $darpan->training_female
                                    );
                                    ?>
                                </ul> 
                                @endforeach                               
                            </div>
                            <div class="analytics_chart">
                                <div id="chartContainer{{$counter}}" ></div>
                            </div>
                        </div>
                        <?php                        
                        $sector_wise_graphs_script_data = '
                                  var sector_'.$CANDIDATE_KEY.' = {
                                    animationEnabled: true,
                                    toolTip: {
                                        content : "{label} <br> Total: {y} <br> Male: {male_count} <br> Female: {female_count}"
                                    },
                                    title: {
                                        text: "Enrolled"
                                    },
                                    axisY: {
                                        title: "Male & Female",
                                        suffix: "",
                                        includeZero: false
                                    },
                                    axisX: {
                                        title: "Sectors"
                                    },
                                    data: [{
                                        type: "splineArea",
                                        yValueFormatString: "#,##0.0#"% "",
                                        dataPoints: '.json_encode($GRAPH_DATA_POINTS).'
                                    }]
                                };
                            ';
                        $counter++;
                        ?>
                    </div>
                </li>         
            </ol>
        </div>
    </div>
</div>
    


<div class="peoples_wrap">
    <div id="leaders" class="peoples_container">
        <h2><span class="first_letter">L</span>eadership <span><span class="first_letter">M</span>essages</span></h2>
        <div class="new_leader" style="margin-bottom:20px;text-align:center;">
            <ul>
                <li id="nehru" class="active"><img class="lazy" src="{{asset('dist/img/images/raj_nehru.png')}}" alt="Raj Nehru" style="height: 100px;margin-top: -25px;width:160px;"></li>
                <div class="cm_content nehru active" style="padding: 10px;position: relative;">
                <h3>Shri. Raj Nehru 
                </h3>
                <div class="designation">Mission Director- HSDM (Govt. of Haryana)</div>
                <p>Haryana skill development mission is providing skill training to the SAKSHAM YOUTH in various emerging sectors so as to empower them with right attitude, skills and knowledge to face the competitive world thereby turning an asset for the state and the Country.</p>                    
            </div>
            </ul>
        </div>
        <div class="col-sm-3 peoples_left" style="padding: 20px;">
            <ul>
                {{-- <li id="modi"><img class="lazy" src="{{asset('dist/img/images/narendra_modi.png')}}" alt="Narendra Modi"></li>
                <li id="kattar" ><img class="lazy" src="{{asset('dist/img/images/manohar_lal_khattar.png')}}" alt="Manohar Lal Khattar"></li>
                <li id="vipul_goyal" class="zindex2"><img class="lazy" src="{{asset('dist/img/images/vipul.png')}}" alt="Viupl Goyal"></li> --}}
                <li id="devinder" ><img class="lazy" src="{{asset('dist/img/images/devinder.jpg')}}" alt="Shri Devender Singh, IAS" width="258px" height="258px"></li>
                <li id="nehru" class="active"><img class="lazy" src="{{asset('dist/img/images/raj_nehru.png')}}" alt="Raj Nehru"></li>
            </ul>
        </div>
        <div class="col-sm-9 peoples_right">               
            <!--<div class="cm_content modi ">-->
            <!--    <h3>Shri Narendra Modi</h3>-->
            <!--    <div class="designation">Hon’ble Prime Minister of India</div>-->
            <!--    <p>-->
            <!--        Skilling is building a better India.-->
            <!--    </p>-->
            <!--    <p>-->
            <!--        If we have to move India towards development then skill development should be our mission-->
            <!--    </p>-->
            <!--</div>-->
            <!--<div class="cm_content kattar ">-->
            <!--    <h3>Shri. Manohar Lal Khattar</h3>-->
            <!--    <div class="designation">Hon’ble Chief Minister of Haryana</div>-->
            <!--    <p>The youth hold the key to economy’s development hence there is no better investment than helping youth to develop their skills and abilities .Haryana Skill development Mission is taking steps in empowering our SAKSHAM youth with the skills that are required for employment and entrepreneurship through skill trainings.</p>-->
            <!--</div>-->
            <!--<div class="cm_content vipul_goyal ">-->
            <!--    <h3>Shri. Vipul Goyal</h3>-->
            <!--    <div class="designation">Minister for Skill Develoment and Industrial Training</div>-->
            <!--    <p>-->
            <!--        Skilling helps the youth to upgrade their own abilities to contribute in their own as well as national development by making them employable or entrepreneurs.-->
            <!--    </p>-->
            <!--    <p>-->
            <!--        I am sure with the initiative of Skill trainings of SAKSHAM youth, their skills and abilities will be developed,which are required in the workplace by giving them various options of selecting the sector and job role of their interest.-->
            <!--    </p>-->
            <!--</div>-->
            <div class="cm_content devinder ">
                <h3>Shri Devender Singh, IAS</h3>
                <div class="designation">Additional Chief Secretary to Govt. of  Haryana<br>Industries, Civil Aviation and Skill Development & Industrial Training </div>
                <p>
                    Empowering the youth through Skills development strengthens their capacity to help address the many challenges facing society, including unemployment, poverty &amp; injustice. There is no better investment than helping a young person to develop their Skills.
                </p>
                <p>
                    HSDM is making additional efforts towards the SAKSHAM youth by making them skilled, through skill trainings programme under various job roles which are in high demand to make them employable or Entrepreneurs.
                </p>
            </div>
            <div class="cm_content nehru active">
                <h3>Shri. Raj Nehru 
                    <div class="social">
                        <ul>
                            <li>
                                <a class="video_pop" href="javascript:void(0)">
                                    video
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-play fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </h3>
                <div class="designation">Mission Director- HSDM (Govt. of Haryana)</div>
                <p>Haryana skill development mission is providing skill training to the SAKSHAM YOUTH in various emerging sectors so as to empower them with right attitude, skills and knowledge to face the competitive world thereby turning an asset for the state and the Country.</p>                    
            </div>
        </div>
    </div>
</div>

<div class="about_saksham_wrap">
    <div class="About_saksham_container">
        <h2> <span class="first_letter">A</span>bout <span><span class="first_letter">S</span>aksham</span></h2>
        <div style="margin-right: 35px; background: linear-gradient(to right, rgb(239, 239, 187), rgb(212, 211, 221)); padding:15px;">
            <p>Saksham Scheme has been approved by the Haryana State Government in 2016 to provide monthly Unemployment allowance to educated youth and Honorarium to the eligible Post Graduate applicants for honorary assignment in various Departments / Boards / Corporations / Registered Societies etc. under Haryana Government and in Private Companies / Enterprises.</p>
            <ul class="about_points">
                <p style="font-weight: bold">The main objectives of Scheme are:</p>
                <li>
                    The Scheme aims to provide Unemployment Allowance &amp; Honorarium to the eligible youth.
                </li>
                <li>This Scheme also intends to provide allowance to eligible educated Unemployed youth of Haryana State for their skill up-gradation
                </li>
                <li>This Scheme is to enable such youth to develop their skill which in turn will enable them to take up Employment or Self-Employment in the Sector of their choice, since this scheme Empowers the youth to choose the Sector in which they would like to develop their Skills.
                </li>
            </ul>
        </div>
        
        <h2><span class="first_letter">S</span>ectors <span class="first_letter">U</span>nder <span class="first_letter">S</span>aksham</h2>
        <ul class="sakshayam_schemes">
            @foreach($schemes as $scheme)
            <li>
                <a href="{{ url('/schemes/'.$scheme->idScheme.'')}}">
                    <div class="img_div">
                        <img class="lazy" src="{{asset('dist/img/images/'.$scheme->schemeImage.'.jpg')}}" alt="">
                        <div class="text">
                            <h4>{{$scheme->schemeName}}</h4>
                            <p>Read More</p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>


<div class="course_search">
    <div class="course_container">
        <div class="trainee_life">
            <h2><span class="first_letter">T</span>rainee <span class="first_letter">L</span>ifecycle</h2>
            <ul>
                <li>
                    <a href="{{ url('/explore_course')}}">
                        <div class="c100 p50">
                            <span class="fa fa-search"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p>Search Course</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/explore_course')}}">
                        <div class="c100 p50">
                            <span class="fa fa-list"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p>Enroll For Course</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/contact_officers')}}">
                        <div class="c100 p50">
                            <span class="fa fa-book"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p>Find DEO</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/company/home')}}">
                        <div class="c100 p50">
                            <span class="fa fa-star"></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <p>Get Placed</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>



<div class="placement_wrap">
    <div class="placement_container">
        <div class="placement_left">
            <h2><span class="first_letter">H</span>SDM <span class="first_letter">नौकरी</span></h2>
            <p>Haryana Skill Development Mission has been setup, aimed at the growth and development of youth of Haryana and providing maximum employment opportunities to them by helping them to gain skills and get placed in their desired Jobs. Saksham Naukri is a platform for Youth to search Job Openings and can get placed. Saksham Naukri also provides companies to search skilled youth.</p>
            <a href="/company/home/" class="btn-svg btn-svg-chrome">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                    <line class="top" x1="0" y1="0" y2="0" x2="400%" style="stroke-dasharray: 259.8, 205.8;"></line>
                    <line class="left" x1="0" x2="0" y1="100%" y2="-300%"
                    style="stroke-dasharray: 91.6, 37.6;"></line>
                    <line class="bottom" y1="100%" y2="100%" x2="200%" x1="-200%"
                    style="stroke-dasharray: 259.8, 205.8;"></line>
                    <line class="right" y1="0" x1="100%" x2="100%" y2="400%"
                    style="stroke-dasharray: 91.6, 37.6;"></line>
                </svg>
                Get Started
            </a>
            <!-- <a href="/company/home/">Get Started</a> -->
        </div>
        <div class="placement_right">
            <img class="lazy" src="{{asset('dist/img/images/interviews_placements.jpg')}}" alt="Interviews & Placements" style="border-radius: 45px;">
        </div>
    </div>
</div>

<div class="placement_wrap mentor_wrap">
    <div class="mentor_mentee_container">
        <div class="placement_left">
            <img class="lazy" src="{{asset('dist/img/images/mentor_mentee.jpg')}}" alt="Mentor-Mentees" style="border-radius: 45px;">
        </div>
        <div class="placement_right">
            <h2><span class="first_letter">H</span>SDM <span class="first_letter">द्रोण</span></h2>
            <p>Mentoring is a form of life-long learning for both the mentee and mentor. The HSDM द्रोण mentoring programme matches a mentor with a more mentee from within the द्रोण membership. Mentors can provide support, information and advice, and share professional and personal skills and experiences. The match is based on needs and criteria identified by the mentee. </p>
            <a href="/mentor/home/" class="mentor_btn">Get Trained</a>
        </div>
    </div>
</div>

<div class="dashboard_wrap">
    <div class="dashboard_container">
        <font size=8 color=red font-family=Oswald><strong>स</strong></font><font size=8 color=blue ><strong>क्षम &nbsp;</strong></font>
        <font size=8 color=red font-family=Oswald><strong> द</strong></font>
        <font size=8 color=green font-family=Oswald><strong>र्पण   &nbsp;</strong></font>
        <!--  <h2> सक्षम दर्पण</h2>   -->
        <a href="/admin/home/">
            <ul>
                @foreach($darpan_sector_wise as $var)
                <li>
                    <div class="counter_div">
                        <div class="counter">
                            <div class="icon_div">
                                <span class="fa fa-list-alt"></span>
                            </div>
                        </div>
                        <p>Trainees Enrolled</p>
                        <span class="count">3860</span>
                        <!--<span class="count">{{$var->Total_training}}</span>-->
                    </div>
                </li>

                <li>
                    <div class="counter_div">
                        <div class="counter">
                            <div class="icon_div">
                                <span class="fa fa-graduation-cap"></span>
                            </div>
                        </div>
                        <p>Trainees Certified</p>
                        <span class="count">2417</span>
                        <!--<span class="count">{{$var->Total_certified}}</span>-->
                    </div>
                </li>

                <li>
                    <div class="counter_div">
                        <div class="counter">
                            <div class="icon_div">
                                <span class="fa fa-users"></span>
                            </div>
                        </div>
                        <p>TP Empanelled</p>
                        <span class="count">6</span>
                    </div>
                </li>
                <li>
                    <div class="counter_div">
                        <div class="counter">
                            <div class="icon_div">
                                <span class="fa fa-hand-point-up"></span>
                            </div>
                        </div>
                        <p>Click here for Saksham दर्पण</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </a>
    </div>
</div>
<div class="circle-ripple"></div>
<div class="flip_book_wrap">
    <div class="flip_book_container">
        <div class="title-div">
            <h2> <span class="first_letter">F</span>lip <span><span class="first_letter">B</span>ooks</span></h2>
        </div>
        <section class="main">
            <ul class="ch-grid">
                @foreach ($schemes as $scheme)
                    <li id="{{$scheme->flipBooks}}_flip">
                        <div class="ch-item">
                            <div class="ch-info">
                                <div class="ch-info-front ch-img-11"><i class="{{$scheme->schemeIcon}}"></i></div>
                                <div class="ch-info-back">
                                    <h3>{{$scheme->schemeName}}</h3>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</div>

<div class="login_hme_wrap">
    <div class="login_hme_container">
        <h2>Login to <span>Our Portals</span></h2>
        <div class="category-grid">                 
            <div class="category-row">
                <div class="item"><a href="/admin/login/"><i class="far fa-user"></i><h4>Admin</h4></a></div><div class="item"><a href="/mentor/login/"><i class="fas fa-users-cog"></i><h4>Mentor</h4><a/></div><div class="item"><a href="/company/login/"><i class="fas fa-building"></i><h4>Company</h4></a></div><div class="item"><a href="/candidate/login/"><i class="fas fa-user-tie"></i><h4>Candidate</h4></a></div>
            </div> <!-- end .category-row -->
        </div>
    </div>
</div>

<!--<div class="treadmil_div_wrap">-->
<!--    <div class="treadmil_div_container">-->
<!--        <div class="treadmil_div">-->
<!--            <h3><span class="fas fa-bullhorn"></span> <span class="first_letter">N</span>ews & <span class="first_letter">E</span>vents</h3>-->
<!--            <div class="treadmill">-->
<!--                @foreach ($notifications as $notification)-->
<!--                <div class="treadmill-unit">-->
<!--                    @if($notification->type == 'text') -->
<!--                    <p>{{$notification->text}}</p>-->
<!--                    @endif-->

<!--                    @if($notification->type == 'link')-->
<!--                    <a target="_blank" href="'.$notification->url.'"><p>{{$notification->text}}</p></a>-->
<!--                    @endif-->
<!--                    @if($notification->type == 'file')-->
<!--                    <a target="_blank" href="'.$notification->file.'"><p>{{$notification->text}}</p></a>-->
<!--                    @endif                        -->
<!--                </div>-->
<!--                @endforeach-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="galleries_wrap">
    <div class="galleries_container">
        <h2><span class="first_letter">G</span>allery</h2>
        <div class="slider-div">
            <h3>Image Gallery</h3>
            <div class="slider">
                <ul class="sliderimg">
                    @for($i = 1; $i<18 ;$i++)
                    <li class="slide">
                        <img alt="image{{$i}}" src="{{asset('dist/img/images/popup/image'.$i.'.jpg')}}" itemprop="thumbnail" />
                    </li>
                    @endfor        
                </ul>
            </div>
            <div class="scroller-nav">
                <a href="javascript:void(0);" id="prev">
                    <span class="fa fa-chevron-left" aria-hidden="true"> </span>
                </a>
                <a href="javascript:void(0);" id="next">
                    <span class="fa fa-chevron-right" aria-hidden="true"> </span>
                </a>
            </div>
        </div>
        <div class="video_gallery_div">
            <h3>Video Gallery</h3>
            <div class="video_gallery">
                <ul class="video_img">
                    @for($i = 8; $i<12 ;$i++)
                    <li class="slide">
                        <img alt="image{{$i}}" src="{{asset('dist/img/images/popup/image'.$i.'.jpg')}}" itemprop="thumbnail" />
                    </li>
                    @endfor
                </ul>
            </div>
            <div class="scroller-nav">
                <a href="javascript:void(0);" id="prev1">
                    <span class="fa fa-chevron-left" aria-hidden="true"> </span>
                </a>
                <a href="javascript:void(0);" id="next1">
                    <span class="fa fa-chevron-right" aria-hidden="true"> </span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal_box">
    <div class="pop_container">
        <div class="close">x</div>
        <div class="popup">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/2ZVdsUQf-B0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
        </div>
    </div>
</div>

<div class="modal_box1">
    <div class="pop_container">
        <div class="close">x</div>
        <div class="image_load"></div>
    </div>
</div>


<div class="flip_pop">
    <div class="close">x</div>
    <?php
        $flip_count = 0;
        foreach ($schemes as $scheme) {
            if($scheme->flipBooks) {
                if($flip_count==0){$flip_count='';}
                echo '
                    <div class="flipbook_wrap_pop ' . $scheme->flipBooks . '_flip active">
                        <a href="" class="btn_flip next_flip'.$flip_count.'">
                            <span class="fas fa-arrow-circle-right"></span>
                        </a>
                        <div class="' . $scheme->flipBooks . '">';
                        echo $scheme->flipBooks;
                            for ($i = 1; $i <= $scheme->flipImagesCount; $i++) {
                                echo '
                                    <div>';?>
                                        <img class="lazy" alt="' . $scheme->flipBooks . '_' . $i . '" src="{{asset('dist/img/images/flip_books/'. $scheme->flipBooks . '/' . $i . '.jpg')}}" itemprop="thumbnail" />
                                            <?php echo ' </div>
                                        ';
                            }
               echo '</div>
                        <a href="" class="btn_flip prev_flip">
                          <span class="fas fa-arrow-circle-left"></span>
                        </a>
                    </div>
                ';
            }
            $flip_count++;
        }
    ?>
</div>
<footer id="footer_block" style="postion:absolute;">
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Saksham</h5>
                <ul>
                    <li><a href="/explore_course/">Explore Courses</a></li>
                    <li><a href="/mentor/home/">HSDM द्रोण</a></li>
                    <li><a href="/company/home/">HSDM नौकरी</a></li>
                    <li><a href="/admin/home/">Saksham दर्पण</a></li>
                    <li><a href="/candidate/login/">Candidate Login</a></li>
                </ul>
            </div>
            <div class="col">
                <h5><a href="/contact_us/" style="color:white">Contact Us</a></h5>
                <ul>
                    <li><a href="#"><label>Address :- </label> Haryana Skill Development Mission <br/>IP-2, Sector 3, Panchkula, Haryana</a></li>
                    <!--<li><a href="#"><label>Phone :- </label> 072068 08908</a></li>-->
                    <li><a href="#"><label>Email :- </label> haryanasdm@gmail.com</a></li>
                </ul>
            </div>
            <div class="col">
                <center><h5>Get In Touch With Us</h5></center>
                <iframe style="height: 140px;width:455px;border: 2px solid gray;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6861.652693174812!2d76.87150414915132!3d30.695161641370657!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x43a1d42f6b380d6a!2sHaryana+Skill+Development+Mission!5e0!3m2!1sen!2sin!4v1543907336206"  frameborder="1" align="middle" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</footer>
@stop
@section('script')
<script src="{{ asset('dist/js/flipbook.js')}}"></script>
<script>
    window.onload = function () {
    <?php
      echo $sector_wise_graphs_script_data;
    ?>

    $("#chartContainer1").CanvasJSChart(sector_training);
}
    $(".flip_book_wrap ul li").click(function(){
      var id = $(this).attr("id");
      $(".flipbook_wrap_pop").removeClass("active"); 
      $(".flipbook_wrap_pop."+id).addClass("active"); 
    });
</script>
@stop