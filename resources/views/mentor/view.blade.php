@extends('layouts.app')
@section('content')
<div class="view_profile">
    <div class="profile_container">
        <ul>
            <li>
                <div class="profile_pic profile_left">
                	@if($mentor->photo)
                    <img src="{{$mentor->photo}}" height="275" width="234" alt="" style="width:275px;height:270px;border: 2px solid lightgray">
                    @else
                    <img src="{{asset('dist/img/images/default.png')}}" height="275" width="234" alt="" style="width:275px;height:270px;border: 2px solid lightgray">
                    @endif
                </div>
                <div class="profile_txt profile_right">
                    <h2><span>{{$mentor->firstName}} {{$mentor->lastName}}</span></h2>
                    <div class="designation">
                        <p>{{$mentor->headline}}</p>
                        <ul>
                            <li>
                                @if($mentor->facebookUrl != null)
                                	<a href="http://{{$mentor->facebookUrl}}" title="Facebook">
                                @else
                                	<a title="Facebook">
                                @endif

                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                     </span>
                                </a>
                                
                            </li>
                            <li>
                            	@if($mentor->linkedinUrl != null)
                                	<a href="http://{{$mentor->linkedinUrl}}" title="Linked-In">
                                @else
                                	<a title="Linked-In">
                                @endif
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li>                            	
                            	@if($mentor->twitterUrl != null)
                                	<a href="http://{{$mentor->twitterUrl}}" title="Twitter">
                                @else
                                	<a title="Twitter">
                                @endif
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>                            
                            <li>
                            	@if($mentor->youtubeUrl != null)
                                	<a href="http://{{$mentor->youtubeUrl}}" title="Youtube">
                                @else
                                	<a title="Youtube">
                                @endif
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                                        </span>
                                </a>
                            </li>
                            <li>
                            	@if($mentor->personalWebsite != null)
                            	<a href="http://{{$mentor->personalWebsite}}" target="_blank" title="Website">
                                @else
                                	<a title="Website">
                                @endif
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fa fa-globe fa-stack-1x fa-inverse"></i>
                                        </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="prof_location">
                        <ul>
                            <li style="width:37%">
                                <h4>Email</h4>
                                <p>{{$mentor->email}}</p>
                            </li>
                            <li style="width:15%">
                                <h4>Phone</h4>
                                <p>{{$mentor->mobile}}</p>
                            </li>
                            
                            <li  style="width:40%">
                                <h4>Sectors</h4>
                                <p>@foreach($mentor->mentor_skill as $skill){{$skill->jobrole->sector->sectorName}}@endforeach</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="profile_intro profile_left">
                    <h4>Headline</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                        	<span>{{$mentor->headline}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_intro profile_left">
                    <h4>About</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                        	<span>{{$mentor->about}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left">
                    <h4>Gender</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                            <span>{{$mentor->gender->genderName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left">
                    <h4>Date of Birth</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                            <span>{{$mentor->dob}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left">
                    <h4>Education</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                            <span>{{$mentor->qualification->qName}}</span>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
            	<div class="profile_expertise profile_left">
                    <h4>Expertise</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                           <span>@foreach($mentor->mentor_skill as $skill){{$skill->jobrole->jobRoleName}}@endforeach</span>
                       
                        </li>
                    </ul>
                </div>
            </li>
            <li><div class="profile_expertise profile_left">
                    <h4>Experience</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                        
                           <span>@foreach($mentor->mentor_skill as $skill){{$skill->experience->experienceName}}@endforeach</span>
                       
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="profile_expertise profile_left">
                    <h4>Languages Known</h4>
                </div>
                <div class="profile_expertise_txt profile_right">
                    <ul>
                        <li>
                            <span>{{$mentor->languages}}</span>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
</div>
<div class="similar_mentors_main_wrap">
	<div class="similar_mentors_container">
		<div class="profile_details">
			@if(count($similar_mentor) > 0)
			<h2>
				<span class="first_letter">S</span>imilar <span>
				<span class="first_letter">M</span>entors</span>
				<span class="first_letter">F</span>rom</span>
				<span class="first_letter">S</span>ame</span>
				<span class="first_letter">S</span>ector</span>
			</h2>
			@else
			<h2 class="empty">No Similar Mentors Available</h2>
			@endif
			@foreach($similar_mentor as $var)
			<div class="user">
				<a href="javascript:void(0)" class="user_link overlay_image_link router user_search_result">
					<div class="preview_wrapper">
						<div class="profile_image_wrapper ">
							@if($var->mentor->photo)
							<div class="preview_image user_image" style="background-image: url('{{$var->mentor->photo}}')"></div>
							@else
							<div class="preview_image user_image" style="background-image: url('{{asset('dist/img/images/default.png')}}')"></div>
							@endif
						</div>

					</div>
				</a>
				<div class="details_wrapper ">
					<div class="user_name">{{$var->mentor->firstName}}</div>
					<div class="email_phone_wrapper">
						<div class="user_email">
							<div class="label" ><i class="fa fa-envelope" aria-hidden="true"></i></div >
							<a class="copy-icon-container tip-copy" href = "javascript:void(0)" >
								<div ><span >{{$var->mentor->email}}</span ></div >
							</a >
						</div >
						<div class="user_phone">
							<div class="label">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</div>  
							<div class="phone-number">
								<span>{{$var->mentor->mobile}}</span> 
							</div>
						</div>
						<div class="user_languages">
							<div class="label">
								<i class="fa fa-language" aria-hidden="true"></i>
							</div>  
							<div class="languages">
								<span>{{$var->mentor->languages}}</span> 
							</div>
						</div>
						<div class="mentor_view_profile">
							<a class="mentor_full_profile" href="{{url('/mentor/view/'.$var->idMentor.'')}}">View Full Profile</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop