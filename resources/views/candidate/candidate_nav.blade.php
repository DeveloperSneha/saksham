<?php
$candidate = \App\Candidate::where('idCandidate', '=', Auth::guard('candidate')->user()->idCandidate)->first();
$locale =  Session::get('locale');
?>
<style>
    .header_wrap .logo {
        float: left;
        width: 15%;
    }
    .header_wrap .logo img {
        width: 160px; 
        margin-top: -8px;
    }
    .main-header .logo{
        overflow: visible;
    }
    .sidebar-menu>li> a {
        transition: .5s ease;
        color: #fff;
    }
    .sidebar-menu>li> a:visited{
        transition: .5s ease;
        color: #fff;
    }
    .skin-green-light .main-header .logo {background-color: transparent;}
</style>
<header class="main-header navbar navbar-fixed-top head-top">
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
                    @if (\Route::current()->getName() == 'home')<li><a id="leaders_messages" href="javascript:void(0)">Leadership Messages</a></li>@endif          
                    <li><a href="{{ url('/explore_course')}}">Explore Courses</a></li>
                    <li><a href="{{ url('/mentor/home/')}}">HSDM द्रोण</a></li>
                    <li><a href="{{ url('/company/home/')}}">HSDM नौकरी</a></li>
                    <li><a href="{{ url('/admin/home/')}}">Saksham दर्पण</a></li>
                    <li class="has-child">
                       <a href="javascript:void(0)" class="login_menu">Login</a>
                       <ul class="drop_down">

                        @if(Auth::guard('candidate')->check())
                            <li><a href="{{url('/candidate')}}">{{ Auth::guard('candidate')->user()->firstName }}{{ Auth::guard('candidate')->user()->firstName }}</a></li>   
                            <li>
                                <a href="{{url('/candidate/chpass')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
                            </li>
                            <li>
                                <a href="{{ route('candidate.logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-candidate').submit();">
                                        <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                </a>

                                <form id="logout-candidate" action="{{ route('candidate.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                            </li>
                                
                        @else
                            <li><a href="{{url('/admin/login')}}">दर्पण Login</a></li>
                            <li><a href="{{url('mentor/login')}}">द्रोण Login</a></li>
                            <li><a href="{{url('company/login')}}">नौकरी Login</a></li>
                            <li><a href="{{url('candidate/login')}}">Candidate Login</a></li>
                        @endif
                   
                       </ul>
                    </li>
                    <li><a href="http://hsdm.org.in/" target="_blank"><img src="{{asset('dist/img/images/hsdm.png')}}"/ width="85px" height="50px" style="margin-top: -15px;"></a></li>
                    <li class="close_menu"><a href="javascript:void(0)">x</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="background: linear-gradient(to right, rgb(3, 99, 87), rgb(3, 130, 106),rgb(2, 73, 99)); margin-top: 60px">
        <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="{{ checkActive(['candidate'])}}">
            <a href="{{ url('/candidate')}}">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview {{ checkActive(['candidate/profile','candidate/editprofile']) }}">
            <a href="#">
                <span>Profile 
                    @if(!count($candidate->academics)>0) 
                        <br><blink class="blink" style="font-size: 13px">( 25% Profile is Completed*) </blink> 
                    @endif
                </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive(['/candidate/profile'])}}"><a href="{{ url('/candidate/profile')}}">View Profile </a></li>
                <li class="{{ checkActive(['/candidate/editprofile'])}}"><a href="{{ url('/candidate/editprofile')}}">Edit Profile</a></li>
            </ul>
        </li>        
        <li class="{{ checkActive(['candidate/jobs','candidate/job/*/details','candidate/scheme/*/jobs'])}}">
            <a href="{{ url('/candidate/jobs')}}">
                <span>Available Jobs</span>
            </a>
        </li>
        <li class="{{ checkActive(['candidate/applied','candidate/applied/*/details'])}}">
            <a href="{{ url('/candidate/applied')}}">
                <span>Applied Jobs</span>
            </a>
        </li>
        <li class="{{ checkActive(['candidate/mentors','candidate/mentors/*/details'])}}">
            <a href="{{ url('/candidate/mentors')}}">
                <span>Available Mentors</span>
            </a>
        </li>
        <li class="{{ checkActive(['candidate/chat'])}}">
            <a href="{{ url('/candidate/chat')}}">
                <span>Chat With Mentors</span>
            </a>
        </li>
        <li class="{{ checkActive(['candidate/chpass'])}}">
            <a href="{{url('/candidate/chpass')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
        </li>
        <li>
            <a href="{{ route('candidate.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
            </a>

            <form id="logout-form" action="{{ route('candidate.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    <!-- /.sidebar -->
</aside>