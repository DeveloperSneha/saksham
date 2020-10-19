@extends('layouts.app')
@section('content')
<div class="contact_us_main_wrap">
    <h2><span class="first_letter">O</span>fficers <span><span class="first_letter">C</span>ontacts</span></h2>
    <div class="contact_us_container">
        <div class="profile_details">
            @foreach($officers_contact as $contact)
                <div class="user">
                    <a href="javascript:void(0)" class="user_link overlay_image_link router user_search_result">
                        <div class="preview_wrapper">
                            <div class="profile_image_wrapper ">
                                <div class="preview_image user_image" style="background-image: url({{asset('dist/img/images/default.png')}}"></div>
                            </div>
                        </div>
                    </a>

                    <div class="details_wrapper ">
                        <div class="user_desgn">{{$contact->district}}</div>
                        <div class="user_name">{{$contact->name}} - {{$contact->designation}}</div>
                        <div class="user_company">{{$contact->office}}</div>

                        <div class="email_phone_wrapper">
                            @if($contact->email_ids)
                            <div class="user_email" >
                                <div class="label" ><i class="fa fa-envelope" aria - hidden = "true" ></i ></div >
                                <a class="copy-icon-container tip-copy" href = "javascript:void(0)" >
                                    <div ><span >{{$contact->email_ids}} </span ></div >
                                </a >
                            </div >
                            @endif
                            @if($contact->mobile_number)
                            <div class="user_phone">
                                <div class="label">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>  
                                <div class="phone-number">
                                    <span>{{$contact->mobile_number}}</span> 
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>               
            @endforeach
        </div>
    </div>
</div>
@stop