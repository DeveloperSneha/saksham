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
                        @if (Auth::guard('web')->check() || Auth::guard('candidate')->check() || Auth::guard('mentor')->check() ||Auth::guard('company')->check())

                                @if(Auth::guard('web')->check())
                                 <li><a href="{{url('/admin')}}">{{ Auth::guard('web')->user()->name }}</a></li>
                                   <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif

                                @if(Auth::guard('candidate')->check())
                                 <li><a href="{{url('/candidate')}}">{{ Auth::guard('candidate')->user()->firstName }}{{ Auth::guard('candidate')->user()->firstName }}</a></li>
                                   <li>
                                        <a href="{{ route('candidate.logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('candidate.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif

                                @if(Auth::guard('mentor')->check())
                                 <li><a href="{{url('/mentor')}}">{{ Auth::guard('mentor')->user()->firstName }}{{ Auth::guard('mentor')->user()->lastName }}</a></li>
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
                                @endif

                                @if(Auth::guard('company')->check())
                                 <li><a href="{{url('/company')}}">{{ Auth::guard('company')->user()->companyName }}</a></li>
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
                                @endif
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
<aside class="main-sidebar" style="background: linear-gradient(to right, rgb(3, 99, 87), rgb(3, 130, 106),rgb(2, 73, 99)); margin-top: 62px">
        <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="{{ checkActive(['admin'])}}">
            <a href="{{ url('/admin')}}">
                <span>Dashboard</span>
            </a>
        </li>
        {{-- <li class="treeview {{ checkActive(['']) }}">
            <a href="#">
                <span>Profile</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive([''])}}"><a href="#">View Profile </a></li>
                <li class="{{ checkActive([''])}}"><a href="#">Edit Profile</a></li>
            </ul>
        </li>   --}}      
        <li class="{{ checkActive(['admin/companies'])}}">
            <a href="{{ url('/admin/companies')}}">
                <span>Companies</span>
            </a>
        </li>
        <li class="{{ checkActive(['admin/candidates','admin/candidates/*/details'])}}">
            <a href="{{ url('/admin/candidates')}}">
                <span>Candidates</span>
            </a>
        </li>
        <li class="treeview {{ checkActive(['admin/activated','admin/deactivated']) }}">
            <a href="#">
                <span>Available Jobs</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive(['admin/activated'])}}"><a href="{{ url('/admin/activated')}}">Activated Jobs</a></li>
                <li class="{{ checkActive(['admin/deactivated'])}}"><a href="{{ url('/admin/deactivated')}}">Deactivated Jobs</a></li>
            </ul>
        </li>  
        <li class="{{ checkActive(['admin/applied'])}}">
            <a href="{{ url('/admin/applied')}}">
                <span>Applied Jobs</span>
            </a>
        </li>
        <li class="{{ checkActive(['admin/mentors'])}}">
            <a href="{{ url('/admin/mentors')}}">
                <span>Mentors</span>
            </a>
        </li>
        {{-- <li class="{{ checkActive(['admin/add_notification'])}}">
            <a href="{{ url('/admin/add_notification')}}">
                <span>Add Notifications</span>
            </a>
        </li> --}}
        {{-- <li class="{{ checkActive(['admin/import','admin/export'])}}">
            <a href="{{ url('/admin/import')}}">
                <span>Import / Export</span>
            </a>
        </li> --}}
        <li class="treeview {{ checkActive(['admin/reports/candidates','admin/reports/companies','admin/reports/mentors','admin/reports/jobs','admin/reports/applied']) }}">
            <a href="#">
                <span>Reports</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ checkActive(['admin/reports/candidates'])}}"><a href="{{ url('/admin/reports/candidates')}}">Candidate</a></li>
                <li class="{{ checkActive(['admin/reports/companies'])}}"><a href="{{ url('/admin/reports/companies')}}">Companies</a></li>
                <li class="{{ checkActive(['admin/reports/mentors'])}}"><a href="{{ url('/admin/reports/mentors')}}">Mentors</a></li>
                <li class="{{ checkActive(['admin/reports/jobs'])}}"><a href="{{ url('/admin/reports/jobs')}}">Jobs</a></li>
                <li class="{{ checkActive(['admin/reports/applied'])}}"><a href="{{ url('/admin/reports/applied')}}">Applied</a></li>
            </ul>
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