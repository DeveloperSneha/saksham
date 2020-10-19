@extends('candidate.candidate_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Chat With Mentors : <span class="font-semibold"></span></div>
    <div class="panel-body">
    	<div class="chat_wrap">
            <div class="chat_container">
                <div class="chat_main_div">
                    <div class="chat_left">
                        <ul class="user_side_bar">
                            @if(count($mentors)>0)
                            @foreach ($mentors as $var)
                                <?php 
                                    $total_msg = \App\MentorCandidateChat::where('idSender','=',$var->idMentor)->where('idReceiver','=',Auth::guard('candidate')->user()->idCandidate)->Where('idSender','!=',Auth::guard('candidate')->user()->idCandidate)->where('idReceiver','!=',$var->idMentor)->count();
                                ?>
                                <li>
                                    <a href="{{url('/candidate/chat/'.$var->idMentor.'')}}">
                                        @if(!empty($var->mentor->photo))
                                            <img src="{{$var->mentor->photo}}" style="    width: 45px;height: 45px;border-radius: 50%;text-align: center;line-height: 2.7;background: #efefef;display: inline-block;vertical-align: top;margin-right: 10px;color: #fff;">
                                        @else
                                        <span class="fas fa-user"></span>
                                        @endif
                                        {{$var->mentor->firstName}} {{$var->mentor->lastName}}
                                        @if($total_msg > 0)<span style="width: 17px;height: 17px;line-height: 1.1;float:right;background: #0dc701;color: white;font-size: 15px;">{{$total_msg}}</span>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                            @else
                            No Mentor is Available
                            @endif
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
@stop