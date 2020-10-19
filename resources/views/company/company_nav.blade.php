<?php
$company = \App\Company::where('idCompany', '=', Auth::guard('company')->user()->idCompany)->first();
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
                        @if(Auth::guard('company')->check())
                            <li><a href="{{url('/company')}}">{{ Auth::guard('company')->user()->companyName }}</a></li>
                            <li>
                                <a href="{{url('/company/chpass')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
                            </li>
                            <li>
                                <a href="{{ route('company.logout') }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                </a>

                                <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
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
        <li class="{{ checkActive(['company'])}}">
            <a href="{{ url('/company')}}">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview {{ checkActive(['company/profile','company/editprofile']) }}">
            <a href="#">
                <span>Profile</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive(['/company/profile'])}}"><a href="{{ url('/company/profile')}}">View Profile </a></li>
                <li class="{{ checkActive(['/company/editprofile'])}}"><a href="{{ url('/company/editprofile')}}">Edit Profile</a></li>
            </ul>
        </li>        
        <li class="{{ checkActive(['company/jobpost'])}}">
            <a href="{{ url('/company/jobpost')}}">
                <span>New Job Post</span>
            </a>
        </li>
        <li class="treeview {{ checkActive(['company/jobs','company/job/*/viewJob','company/active_jobs','company/deactive_jobs']) }}">
            <a href="#">
                <span>Posted Jobs</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive(['company/job/','company/job/*/viewJob'])}}">
                    <a href="{{ url('/company/jobs')}}">
                        <span>Available Jobs</span>
                    </a>
                </li>
                <li class="{{ checkActive(['company/active_jobs'])}}">
                    <a href="{{ url('/company/active_jobs')}}">
                        <span>Activated Jobs</span>
                    </a>
                </li>
                <li class="{{ checkActive(['company/deactive_jobs'])}}">
                    <a href="{{ url('/company/deactive_jobs')}}">
                        <span>Deactivated Jobs</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ checkActive(['company/applied','company/applied/*/details'])}}">
            <a href="{{ url('/company/applied')}}">
                <span>Applied Jobs</span>
            </a>
        </li>
        <li class="{{ checkActive(['company/chpass'])}}">
            <a href="{{url('/company/chpass')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
        </li>
        <li>
            <a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
            </a>

            <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        <li>
            <a href="{{ asset('CANDIADTE DATA.xlsx') }}">Download Candidates Data</a>
        </li>
    </ul>
    <!-- /.sidebar -->
</aside>