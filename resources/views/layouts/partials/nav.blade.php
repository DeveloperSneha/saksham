<style>
    @media (max-width: 750px) {
        .last-child{margin-top:100px;}
    }
</style>
<div class="header_wrap">
    <div class="header_container">
        <div class="logo">
            <a href="/"><img src="{{asset('dist/img/images/logo.png')}}"/ ></a>
        </div>

        <span class="fas fa-bars" id="mobile_menu"></span>

        <nav class="nav_main">
            <ul>
                <li><a href="{{ url('/')}}"><i class="fa fa-home"></i></a></li>                
                <li><a href="{{ url('/about')}}">Sectors in saksham</a></li>      
                <!--@if (\Route::current()->getName() == 'home')<li><a id="leaders_messages" href="javascript:void(0)">Leadership Messages</a></li>@endif          -->
                <li><a href="{{ url('/candidate/register')}}">Candidate Registration</a></li>
                <li><a href="{{ url('/explore_course')}}">Explore Courses</a></li>
                <li><a href="{{ url('/mentor/home/')}}">HSDM द्रोण</a></li>
                <li><a href="{{ url('/company/home/')}}">HSDM नौकरी</a></li>
                <li><a href="{{ url('/admin/home/')}}">Saksham दर्पण</a></li>
                <li class="has-child">
                   <a href="javascript:void(0)" class="login_menu">Login</a>
                   <ul class="drop_down">
                    @if (Auth::guard('web')->check() || Auth::guard('candidate')->check() || Auth::guard('mentor')->check() ||Auth::guard('company')->check())

                            @if(Auth::guard('web')->check())
                             <li><a href="{{url('/admin')}}">{{ Auth::user()->name }}</a></li>
                               <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout').submit();">
                                        <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                    </a>

                                    <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            @elseif(Auth::guard('candidate')->check())
                             <li><a href="{{url('/candidate')}}">{{ Auth::guard('candidate')->user()->firstName }} {{ Auth::guard('candidate')->user()->firstName }}</a></li>
                               <li>
                                    <a href="{{ route('candidate.logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('candidate-logout').submit();">
                                        <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                    </a>

                                    <form id="candidate-logout" action="{{ route('candidate.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @elseif(Auth::guard('company')->check())
                             <li><a href="{{url('/company')}}">{{ Auth::guard('company')->user()->companyName }}</a></li>
                               <li>
                                    <a href="{{ route('company.logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-company').submit();">
                                        <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                    </a>

                                    <form id="logout-company" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @elseif(Auth::guard('mentor')->check())
                             <li><a href="{{url('/mentor')}}">{{ Auth::guard('mentor')->user()->firstName }} {{ Auth::guard('mentor')->user()->lastName }}</a></li>
                               <li>
                                    <a href="{{ route('mentor.logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-mentor').submit();">
                                        <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                    </a>

                                    <form id="logout-mentor" action="{{ route('mentor.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                    @else
                        <li><a href="{{url('/admin/login')}}">दर्पण Login</a></li>
                        <li><a href="{{url('/mentor/login')}}">द्रोण Login</a></li>
                        <li><a href="{{url('/company/login')}}">नौकरी Login</a></li>
                        <li><a href="{{url('/candidate/login')}}">Candidate Login</a></li>
                    @endif
               
                   </ul>
                </li>
                <li class="last-child"><a href="http://hsdm.org.in/" target="_blank"><img src="{{asset('dist/img/images/hsdm.png')}}"/ width="85px" height="50px" style="margin-top: -15px;"></a></li>
                <li class="close_menu"><a href="javascript:void(0)">x</a></li>
            </ul>
        </nav>
    </div>
</div>