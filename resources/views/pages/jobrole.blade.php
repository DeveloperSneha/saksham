@extends('layouts.app')
@section('content')
<div class="banner_wrap" style="background-image: url({{asset('dist/img/images/'.$scheme->schemeImage.'.jpg')}})">
	<div class="banner_container">
		<div class="banner_header">
		</div>
	</div>
	<div class="breadcrumbs-wrap">
		<div class="container-breadcrumbs">
			<ol id="navigationBreadCrumbs">
				<li>
					 <a href="{{url('/')}}">Home</a>
				</li>
				<li class="itemLast">{{$scheme->schemeName}}</li>
			</ol>
		</div>
	</div>
</div>
<div class="main_wrap">
	<div class="main_container">
        <!-- <div class="sub_links_category">
            <h3>Sub Categories</h3>
            <ul>
                <li><a href="">Agriculture</a></li>
                <li><a href="">Electronics</a></li>
                <li><a href="">Apparel</a></li>
                <li><a href="">Telecom</a></li>
            </ul>
        </div> -->
        <div class="sub-categories">
        	<h2>Courses under <span>{{$scheme->schemeName}}</span></h2>
        	<ul>
        		@foreach($job_overview as $var)
        		<li>
        			<figure class="category">
        				<img src="{{asset('dist/img/images/'.$scheme->schemeImage.'/s/'.$var->jobRoleImage.'')}}" alt="sample64" style="height: 164px" />
        				<figcaption>
        					<div class="square">
        						<div></div>
        					</div>
        					<h3 style="font-size: 18px">{{ucwords(strtolower($var->jobRoleName))}}</h3>
        					<p>Read More</p>
        				</figcaption>
        				<a href="{{ url('/schemes/'.$scheme->idScheme.'/'.$var->idJobRole.'')}}"></a>
        			</figure>
        		</li>
        		@endforeach
        	</ul>
        </div>
    </div>
</div>
@stop