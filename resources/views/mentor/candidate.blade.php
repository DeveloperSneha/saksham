@extends('mentor.mentor_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Your Candidates : <span class="font-semibold"></span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        <div class="mentor_dashboard">
            <div class="dashboard_container">
                <div class="dashboard_right_mentor" >
                    <div class="results">
                        @if(empty($candidates))
                        <h2 class="empty">Sorry! No candidates available</h2>
                        @else
                            @foreach ($candidates as $var)
                                <div class="user">
                                    <a href="javascript:void(0)" class="user_link overlay_image_link router user_search_result">
                                        <div class="preview_wrapper">
                                            <div class="profile_image_wrapper ">
                                                <div class="preview_image user_image">@if(!empty($var->image))
                                                <img style="border-radius: 50%;" src="{{$candidate->image}}">
                                                @else
                                                <img style="border-radius: 50%;" src="{{asset('dist/img/images/default.png')}}" >
                                            @endif</div>
                                            </div>
                                        </div>
                                    </a>
        
                                    <div class="details_wrapper">
                                        <div class="user_name">{{$var->candidate->firstName}} {{$var->candidate->lastName}}</div>
                                        <div class="email_phone_wrapper">
                                            <div class="user_email">
                                                <div class="label"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                                <a class="copy-icon-container tip-copy" href="javascript:void(0)">
                                                    <div>{{$var->candidate->email}}</div>
                                                </a>
                                            </div>
        
                                            <div class="user_phone">
                                                <div class="label">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </div>
                                                <div class="phone-number">{{$var->candidate->mobile}}</div>
                                            </div>
                                        <center><a class="chat_with_mentor" href="{{url('/mentor/chat/'.$var->candidate->idCandidate.'')}}">Chat with {{$var->candidate->firstName}}</a></center>
        
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop