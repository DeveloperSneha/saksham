    @extends('layouts.app')
    @section('content')

<div class="slider_banner_wrap">
    <div class="container-banner">
        <div id="interactive" class="interactive">
            <ol id="slides" class="slides">
                <li class="slide slide2" style="background: url({{asset('dist/img/images/about_slide2.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide3" style="background: url({{asset('dist/img/images/about_slide3.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide4" style="background: url({{asset('dist/img/images/about_slide4.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide5" style="background: url({{asset('dist/img/images/about_slide5.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide6" style="background: url({{asset('dist/img/images/about_slide6.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide7" style="background: url({{asset('dist/img/images/about_slide7.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide8" style="background: url({{asset('dist/img/images/about_slide8.jpg')}}) no-repeat top center;"></li>
                <li class="slide slide1" style="background: url({{asset('dist/img/images/about_slide1.jpg')}}) no-repeat top center;"></li>
            </ol>
        </div>
    </div>
</div>

<div class="breadcrumbs-wrap" style="bottom:50px;position: relative;">
    <div class="container-breadcrumbs">
        <ol id="navigationBreadCrumbs">
            <li>
                <a href="/home">Home</a>
            </li>
            <li class="itemLast">About</li>
        </ol>
    </div>
</div>
<div class="main_wrap">
    <div class="main_container">
        <div class="about_sahskam">
            <div class="heading">
                <h2><span class="first_letter">S</span>ectors</h2>
            </div>
            <div class="chart">
                <ul>
                    <li>
                        <a href="{{ url('/about')}}">
                        <img src="{{asset('dist/img/images/nodes/saksham.png')}}" alt="">
                            <span>View</span>
                        </a>
                        <span>Saksham</span>
                    </li>
                    @foreach ($schemes as $scheme)
                    <?php if($scheme->routeName== NULL) {$link = "about";}else { $link = "/schemes/$scheme->idScheme"; }?>
                    <li>
                        <a href="{{ url($link)}}">
                        <img src="{{asset('dist/img/images/nodes/'.$scheme->schemeImage.'.png')}}" alt="">
                            <span>View</span>
                        </a>
                        <span>{{$scheme->schemeName}}</span>
                    </li>
                    @endforeach
                </ul>
            </div> 
       </div>
    </div>
</div>
@stop