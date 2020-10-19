@extends('layouts.app')
@section('content')
<div class="banner_wrap" style="background-image: url({{asset('dist/img/images/mentor.jpg')}}); min-height: 420px;">
    <div class="banner_container">
        <div class="login_register">
            
        </div>
        <div class="metor_header">
            <h2  class="tac"><span class="tac first_letter">HSDM</span> <span class="first_letter">द्रोण</span></h2>
        </div>
    </div>
</div>
<div class="sector_list" style="display:flex;">
    <div style="width:50%; border:2px solid #2aa7a1;margin-left: 12px;margin-right: 12px;">
        <h3><span class="big_alpha">
            <span class="first_letter">B</span>enefits <span class="first_letter">O</span>f <span class="first_letter">B</span>eing <span class="first_letter">A</span> <span class="first_letter">M</span>entor
        </h3>
        <ul style="text-align: left; margin-left: 12%;">
            <li><span style="color:red; font-size:10px"> >> </span> Become a Guru  –>  a Teacher and a Guide</li>
            <li><span style="color:red; font-size:10px"> >> </span>  Develop leadership and management qualities</li>
            <li><span style="color:red; font-size:10px"> >> </span>  Reinforce your own study skills and knowledge of your subject(s)</li>
            <li><span style="color:red; font-size:10px"> >> </span>  Engage in a volunteering opportunity, valued by employers</li>
            <li><span style="color:red; font-size:10px"> >> </span>  Gain recognition and appreciation for your skills and experience</li>
            <li><span style="color:red; font-size:10px"> >> </span>  Improve communication and personal skills.</li>
            <li><span style="color:red; font-size:10px"> >> </span>  Benefit from a sense of fulfilment and personal growth</li>
        </ul>
        <br>
        <a href="{{url('/mentor/register')}}"><button style="padding:8px;background:#000d33; margin-bottom:3px; border-radius:20px;color:#fff;padding-left: 25px;padding-right: 25px;"><strong>I WANT TO REGISTER AS A MENTOR</strong></button></a>
    </div>
    <div style="width:50%; border:2px solid #2aa7a1;">
        <h3><span class="big_alpha">
            <span class="first_letter">B</span>enefits <span class="first_letter">O</span>f <span class="first_letter">B</span>eing <span class="first_letter">A</span> <span class="first_letter">M</span>entee
        </h3>
        <ul style="list-style:square; text-align: left; margin-left: 12%;">
            <li><span style="color:red; font-size:10px"> >> </span> Gain practical advice from Academicians & Industry Experts</li>
            <li><span style="color:red; font-size:10px"> >> </span> Learn from the experiences of others</li>
            <li><span style="color:red; font-size:10px"> >> </span> Increase your social & academic confidence</li>
            <li><span style="color:red; font-size:10px"> >> </span> Develop your communication, study & personal skills</li>
            <li><span style="color:red; font-size:10px"> >> </span> Develop strategies for dealing with both personal & academic issues</li>
            <li><span style="color:red; font-size:10px"> >> </span> Identify goals & establish a sense of direction</li>
            <li><span style="color:red; font-size:10px"> >> </span> Gain valuable insight into the next stage of your career</li>
        </ul>
        <br>
        <a href="{{url('/candidate/register')}}"><button style="padding:8px; background:#000d33;color:#fff; margin-bottom:13px; border-radius:20px;padding-left: 25px;padding-right: 25px;"><strong>I WANT TO REGISTER AS A MENTEE</strong></button></a>
        
    </div>
</div>
<div class="sector_list">
    <div class="sector_list_container">
        <h3><span class="big_alpha">
            <span class="first_letter">S</span>earch
            <span class="first_letter">B</span>y
            <span class="first_letter">S</span>ector
        </h3>
        <p style="max-width: 1060px">Mentoring is a form of life-long learning for both the mentee and mentor. The HSDM ????? mentoring programme matches a mentor with a more mentee from within the ????? membership. Mentors can provide support, information and advice, and share professional and personal skills and experiences. The match is based on needs and criteria identified by the mentee.</p>
        <ul>
            @foreach ($schemes as $scheme)
                <li><a class="{{$scheme->schemeName}}" href="{{url('/mentor/home/scheme/'.$scheme->idScheme.'')}}"><span>{{$scheme->schemeName}}</span></a></li>
            @endforeach
        </ul>
    </div>
</div>

<div class="mentor_search_main" >
    <div class="mentor_search_container">
        <div class="search_list_left">
            {!! Form::open(['method' => 'GET',  'action' => ['MainController@getFilterWiseMentors']]) !!}
            
                <div class="searchby_sector">
                    <input class="mentor_apply_filter" type="submit" value="Filter By">
                </div>
                <!--  <div class="searchby_sector">
                    <input type="text" placeholder="Search By Name" class="search_sectorinput">
                    <ul class="search_sector">
                    </ul>
                </div>-->
                <div class="searchby_price">
                    <h3 style="font-size: 20px;">Price</h3>
                        @foreach(getMentorPrice() as $key=>$val)
                        <li>
                            <input disabled checked type="checkbox" id="price_{{$key}}" />
                            <label for="price_{{$key}}">{{$val}}</label>
                        </li> 
                        @endforeach
                </div>
                <div class="searchby_price">
                    <h3 style="font-size: 20px;">Language</h3>
                    <ul>
                        @foreach(getLanguages() as $key=>$val)
                        <li> 
                            <input type="checkbox" id="lang_{{$key}}" @foreach($lang_var as $vat)  @if($vat ==$key) checked @endif @endforeach   value="{{$key}}"  name="languages[]"/>
                            <label for="lang_{{$key}}">{{$val}}</label>
                            

                        @endforeach
                    </ul>
                </div>

                <div class="searchby_price">
                    <h3 style="font-size: 19px;">Mentor Qualification</h3>
                    <ul>
                        @foreach(Qualifications() as $key=>$val)
                        <li>
                            @if(isset($_GET['graduation']))
                                @if($_GET['graduation'] == $key)
                                    <input name="graduation" type="radio" value="{{$key}}" id="graduation_{{$key}}" checked/>
                                    <label for="graduation_{{$key}}">{{$val}}</label>  
                                @else         
                                    <input name="graduation" type="radio" value="{{$key}}" id="graduation_{{$key}}" />
                                    <label for="graduation_{{$key}}">{{$val}}</label>
                                @endif
                            @else         
                                <input name="graduation" type="radio" value="{{$key}}" id="graduation_{{$key}}" />
                                <label for="graduation_{{$key}}">{{$val}}</label>
                            @endif
                        </li>  
                        @endforeach
                    </ul>
                </div>

                <div class="searchby_price">
                    <h3 style="font-size: 20px;">Mentor Experience</h3>
                    <ul>
                        @foreach(Experiences() as $key=>$val)
                        <li>
                            @if(isset($_GET['experience']))
                                @if($_GET['experience'] == $key)
                                    <input type="radio" id="experience_{{$key}}" name="experience" value="{{$key}}" checked>
                                    <label for="experience_{{$key}}">{{$val}}</label> 
                                @else         
                                    <input type="radio" id="experience_{{$key}}" name="experience" value="{{$key}}">
                                    <label for="experience_{{$key}}">{{$val}}</label>
                                @endif
                            @else         
                                <input type="radio" id="experience_{{$key}}" name="experience" value="{{$key}}">
                                <label for="experience_{{$key}}">{{$val}}</label>
                            @endif
                        </li> 
                        @endforeach
                    </ul>
                </div>
            
            {!! Form::close() !!}
        </div>

        <ul class="profile_listing">
            @if(empty($mentors))
                <h2 class="empty">Sorry! No mentors available</h2>
            @else
                @foreach ($mentors as $mentor)
                    <li class="mentor_profile_list">
                        <div class="mentor_profiles">
                            <div class="mentor-img" style="padding-left:5px;">
                                @if($mentor->photo != NULL)
                                    <img style="border: 2px solid gainsboro; width: 100%;height:280px" src="{{$mentor->photo}}"/>
                                @else
                                   <img style="width: 100%; height:280px" src="{{asset('dist/img/images/teacher_silhoutte.jpg')}}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="mentor_text">
                            <ul>
                                <li>
                                    <div>{{ucwords($mentor->firstName)}} {{ucwords($mentor->lastName)}}
                                        <div style="display: inline-block;max-width: 250px;padding: 5px 10px;background: #fb6d05;border-radius: 5px;color: #fff;float:right; font-size:17px;">{{$mentor->shortName}}</div>
                                    </div>
                                </li>
                            </ul>
                            <p>{{$mentor->headline}}- {{$mentor->about}}</p>
                                <p class="lang"><span style="color:#149e12;font-weight: 700; font-size: 19px;">Expertise In :</span> <b style="color:black;font-weight: 700;">{{$mentor->jobRoleName}}</b></p>
                            <a class="mentor_full_profile" href="{{url('/mentor/view/'.$mentor->idMentor.'')}}">View Full Profile</a>
                            <a class="chat_with_mentor" href="{{url('/candidate/chat/'.$mentor->idMentor.'')}}">Chat With {{ucwords($mentor->firstName)}}</a>
                            <div class="languages">
                                <p class="lang"><span>Languages Known: </span>{{ ucfirst($mentor->languages) }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@stop