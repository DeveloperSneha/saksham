<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <style>
        #footer_block .footer-copyright p {
            margin: 10px;
            color: #fff;
            float: left;
            width: 68%;
            text-align: center;
        }
    </style>
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper" style="overflow-y: hidden;">
            @include('mentor.mentor_nav')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content1" style="padding-top:20px; padding-left: 15px;padding-right: 15px;">
                    @if(session()->has('message'))
                    <div class="alert alert-info">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    <!-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{-- $error --}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif -->
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            
            <footer id="footer_block" style="">
                <div class="footer-copyright">
                    <div class="container-footer">
                    <p>&copy; 2018 by Haryana Skill Development Mission. All rights reserved. &nbsp;&nbsp;Powered By <a href="http://hkcl.in/" target="_blank"><b>(HKCL)</b></a></p>
                        <div class="social-networks">
                            <a href="https://twitter.com/HaryanaSkill" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.youtube.com/channel/UCzhf_eIQadUZKJq_r0gLQRw" class="twitter" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.facebook.com/Haryana-Skill-Development-Mission-173225030019509/" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
            <a href="javascript:void(0)" class="back-to-top">
                <span> <i class="fas fa-angle-up"></i></span>
                <span class="backtop">Top</span>
            </a>

</div>
        </div>
        <!-- ./wrapper -->
        @include('layouts.partials.script')
        @yield('script')
    </body>
</html>
