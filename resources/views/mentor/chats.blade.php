@extends('mentor.mentor_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Chat With Candidate : <span class="font-semibold"></span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        <div class="mentor_dashboard">
            <div class="dashboard_container">
                <div class="dashboard_right_mentor">
                    <div class="chat_wrap">
                        <div class="chat_container">
                            <div class="chat_main_div">
                                <div class="chat_left">
                                    <ul class="user_side_bar">
                                        @foreach ($candidates as $var)
                                        <?php 
                                            $total_msg = \App\MentorCandidateChat::where('idSender','=',$var->idCandidate)->where('idReceiver','=',Auth::guard('mentor')->user()->idMentor)->Where('idSender','!=',Auth::guard('mentor')->user()->idMentor)->where('idReceiver','!=',$var->idCandidate)->count();
                                        ?>
                                        @if($var->idCandidate ==$var->idCandidate)
                                        <li style="background:linear-gradient(to right, rgb(3, 99, 87), rgb(3, 130, 106),rgb(2, 73, 99));">
                                            <a href="{{url('/mentor/chat/'.$var->idCandidate.'')}}" style="color: white;">
                                                @if(!empty($var->candidate->image))
                                                    <img src="{{$var->candidate->image}}" style="    width: 45px;height: 45px;border-radius: 50%;text-align: center;line-height: 2.7;background: #efefef;display: inline-block;vertical-align: top;margin-right: 10px;color: #fff;">
                                                @else
                                                <span class="fas fa-user"></span>
                                                @endif
                                                {{$var->candidate->firstName}} {{$var->candidate->lastName}}
                                                @if($total_msg > 0)<span style="width: 17px;height: 17px;line-height: 1.1;float:right;background: #ca0000;color: white;font-size: 15px;">{{$total_msg}}</span>
                                                @endif
                                            </a>
                                        </li>
                                        @else
                                        <li >
                                            <a href="{{url('/mentor/chat/'.$var->idCandidate.'')}}">@if(!empty($var->candidate->image))
                                                <img src="{{$var->candidate->image}}" style="    width: 45px;height: 45px;border-radius: 50%;text-align: center;line-height: 2.7;background: #efefef;display: inline-block;vertical-align: top;margin-right: 10px;color: #fff;">
                                            @else
                                            <span class="fas fa-user"></span>
                                            @endif
                                            {{$var->candidate->firstName}} {{$var->candidate->lastName}}
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
                                            <h2>Please select candidate to chat<h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop