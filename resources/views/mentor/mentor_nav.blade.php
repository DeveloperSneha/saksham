<?php
$company = \App\Mentor::where('idMentor', '=', Auth::guard('mentor')->user()->idMentor)->first();
$locale =  Session::get('locale');
?>
<style>
    @media (max-width: 750px) {
        .header_wrap .logo {
            float: left!important;
            width: 42%!important;
        }
        .main-sidebar {
            margin-top: -12px!important;
        }
        .sr-only {
            position: relative!important;
            width: 19px;
            z-index: 100; 
        }
        .last-child{margin-top:100px;}
    }
    .main-sidebar{
        background: linear-gradient(to right, rgb(3, 99, 87), rgb(3, 130, 106),rgb(2, 73, 99)); 
        margin-top: 62px;
    }
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
                        @if(Auth::guard('mentor')->check())
                            <li><a href="{{url('/mentor')}}">{{ Auth::guard('mentor')->user()->firstName }} {{ Auth::guard('mentor')->user()->lastName }}</a></li>
                            <li>
                                <a href="{{url('/mentor/chpass')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
                            </li>
                            <li>
                                <a href="{{ route('mentor.logout') }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                </a>

                                <form id="logout-form" action="{{ route('mentor.logout') }}" method="POST" style="display: none;">
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
                    <li class="last-child"><a href="http://hsdm.org.in/" target="_blank"><img src="{{asset('dist/img/images/hsdm.png')}}"/ width="85px" height="50px" style="margin-top: -15px;"></a></li>
                    <li class="close_menu"><a href="javascript:void(0)">x</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- Left side column. contains the logo and sidebar -->
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only" style="margin-left:30px;"><i class-"fa fa-bars"></i> Click to Open Sidebar Navigation</span>
</a>
<aside class="main-sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="{{ checkActive(['mentor'])}}">
            <a href="{{ url('/mentor')}}">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview {{ checkActive(['mentor/profile','mentor/editprofile']) }}">
            <a href="#">
                <span>Profile</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive(['/mentor/profile'])}}"><a href="{{ url('/mentor/profile')}}">View Profile </a></li>
                <li class="{{ checkActive(['/mentor/editprofile'])}}"><a href="{{ url('/mentor/editprofile')}}">Edit Profile</a></li>
            </ul>
        </li>
        <li class="{{ checkActive(['mentor/candidate'])}}">
            <a href="{{ url('/mentor/candidate')}}">
                <span>Candidates</span>
            </a>
        </li>
        <li class="{{ checkActive(['mentor/chats'])}}">
            <a href="{{ url('/mentor/chats')}}">
                <span>Chats</span>
            </a>
        </li>
        <li class="{{ checkActive(['mentor/chpass'])}}">
            <a href="{{url('/mentor/chpass')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
        </li>
        <li>
            <a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
            </a>

            <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    <!-- /.sidebar -->
</aside>