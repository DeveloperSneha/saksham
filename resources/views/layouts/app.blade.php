<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body>
        <div class="wrapper1">

            @include('layouts.partials.nav')
            <!-- Content Wrapper. Contains page content -->
            <div class="whole_content_wrap">
                <!-- Content Header (Page header) -->
<!--                <section class="content-header">
                    
                </section>-->

                <!-- Main content -->
                <section class="content1">
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
                    @include('flash::message')
                    {{--     @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
<footer id="footer_block" style="postion:absolute;">
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
<!-- ./wrapper -->
@include('layouts.partials.script')
@yield('script')
</body>
</html>
