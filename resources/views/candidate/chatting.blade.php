@extends('candidate.candidate_layout')
@section('content')
<style>
    @media (max-width: 480px) {
        .chat_wrap .chat_left {display: none;}
    }
</style>
<?php $candidate =\App\Candidate::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->first();?>
<div class="panel panel-default">
    <div class="panel-heading">Chat With Mentor : <span class="font-semibold"></span></div>
    {{-- <div class="panel-body" style="margin-top: 10px!important;"> --}}
        <div class="chat_wrap">
            <div class="chat_container">
                <div class="chat_main_div">
                    <div class="chat_left">
                        <ul class="user_side_bar">
                            @foreach ($mentors as $var)
                            <?php 
                                $total_msg = \App\MentorCandidateChat::where('idSender','=',$var->idMentor)->where('idReceiver','=',Auth::guard('candidate')->user()->idCandidate)->Where('idSender','!=',Auth::guard('candidate')->user()->idCandidate)->where('idReceiver','!=',$var->idMentor)->count();
                            ?>
                                @if($var->idMentor ==$mentor->idMentor)
                                <li style="background:linear-gradient(to right, rgb(3, 99, 87), rgb(3, 130, 106),rgb(2, 73, 99));">
                                    <a href="{{url('/candidate/chat/'.$var->idMentor.'')}}" style="color: white;">
                                        @if(!empty($var->mentor->photo))
                                            <img src="{{$var->mentor->photo}}" style="    width: 45px;height: 45px;border-radius: 50%;text-align: center;line-height: 2.7;background: #efefef;display: inline-block;vertical-align: top;margin-right: 10px;color: #fff;">
                                        @else
                                        <span class="fas fa-user"></span>
                                        @endif
                                        {{$var->mentor->firstName}} {{$var->mentor->lastName}}
                                        @if($total_msg > 0)<span style="width: 17px;height: 17px;line-height: 1.1;float:right;background: #ca0000;color: white;font-size: 15px;">{{$total_msg}}</span>
                                        @endif
                                    </a>
                                </li>
                                @else
                                <li >
                                    <a href="{{url('/candidate/chat/'.$var->idMentor.'')}}">@if(!empty($var->mentor->photo))
                                        <img src="{{$var->mentor->photo}}" style="    width: 45px;height: 45px;border-radius: 50%;text-align: center;line-height: 2.7;background: #efefef;display: inline-block;vertical-align: top;margin-right: 10px;color: #fff;">
                                    @else
                                    <span class="fas fa-user"></span>
                                    @endif
                                    {{$var->mentor->firstName}} {{$var->mentor->lastName}}
                                    @if($total_msg > 0)
                                    <span style="width: 17px;height: 17px;line-height: 1.1;float:right;background: #ca0000;color: white;font-size: 15px;">{{$total_msg}}</span>
                                    @endif
                                </a>
                                </li>
                                @endif
                            
                            @endforeach
                        </ul>
                    </div>
                    <div class="chat_right">
                        <div class="chat_box_div">
                            <div class="chat_box">
                                <h2>Chatting with {{$mentor->firstName}} {{$mentor->lastName}}</h2>
                                <ul class="messages_section">
                                    @foreach ($prev_msg as $msg)
                                    <li class=" right">
                                        @if($msg->senderType=='mentor')
                                        <div class="message">
                                            @if(!empty($mentor->photo))
                                            <img src="{{$mentor->photo}}" style="    width: 45px;height: 45px;border-radius: 50%;text-align: center;line-height: 2.7;background: #efefef;display: inline-block;vertical-align: top;margin-right: 10px;color: #fff;">
                                            @else
                                            <span class="far fa-user"></span>
                                            @endif
                                            
                                            <div class="message_div">{{$msg->message}}</div>
                                            <div class="time"><i class="fas fa-check" style="color:blue;"></i> {{$msg->created_at}}</div>
                                        </div>
                                        @else
                                        <div class="message" style="float:right;">
                                            @if(!empty($mentor->photo))
                                            <img src="{{$mentor->photo}}" style="    width: 45px;height: 45px;border-radius: 50%;float:right;">
                                            @else
                                            <span class="far fa-user" style="float:right;"></span>
                                            @endif                    
                                            <div class="message_div" style="background: #3c8dbc;color: white;">{{$msg->message}}</div>
                                            <div class="time" style="left: 430px;color: white;"><i class="fa fa-check"></i> {{$msg->created_at}}</div>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            {!! Form::open(['method' => 'POST',  'action' => ['Candidate\CandidateController@storeChat',$mentor->idMentor], 'class' => 'form-horizontal']) !!}
                            <div class="form-group" style="margin-right: 0px;margin-left: 0px;margin-top:20px;">
                                <input type="text" placeholder="Enter message..." name="message" style="width: 70%;padding:10px;">
                                <input id="send_chat_message" type="submit" class="send_chat_message btn btn-default pull-right" value="Send" style="width:30%;margin-top: 0px;padding: 10px 0px 12px;font-size:17px;background: #3c8dbc;">
                                <span class="help-block">
                                    <strong>
                                        @if($errors->has('message'))
                                        <p>{{ $errors->first('message') }}</p>
                                        @endif
                                    </strong>
                                </span>
                            </div>
                            {{-- <div class="form-group">
                                <textarea name="message" class="form-control chat_message" placeholder="Enter message..."></textarea>
                            </div>
                            <div class="form-group">
                                <input id="send_chat_message" type="submit" class="send_chat_message btn btn-default pull-right" value="Send">
                                <div class="clearfix"></div>
                            </div> --}}
                            {!! Form::close() !!}         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>
@stop