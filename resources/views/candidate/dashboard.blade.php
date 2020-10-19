@extends('candidate.candidate_layout')
@section('content')
<style>
    .Agriculture{background: linear-gradient(to right, rgb(30, 138, 1), rgb(6, 23, 0));}
    .Apparel{background: linear-gradient(to right, rgb(92, 126, 152), rgb(9, 0, 27));}
    .Electronics{background: linear-gradient(to right, rgb(232, 3, 3), rgb(103, 5, 0));}
    .Telecom{background: linear-gradient(to right, rgb(234, 102, 24), rgb(237, 143, 3));}
    .Entrepreneurship{background: linear-gradient(to right, rgb(8, 127, 171), rgb(25, 175, 162));}
    .BFSI{background: linear-gradient(to right, rgb(10, 31, 97), rgb(0, 29, 202));}
    .Instrumentation{background: linear-gradient(to right, rgb(0, 198, 255), rgb(0, 114, 255));}
    .Others{background: linear-gradient(to right, rgb(204, 43, 94), rgb(117, 58, 136));}
    .small-box {border: 4px solid white;border-radius: 20px;}
    .small-box .icon{color: rgba(255, 255, 255, 0.36);}
    .bg-gray{color:white;}
    .bg-gray:hover{color:black;}
    .small-box>.inner {padding: 28px;}
    .small-box>.small-box-footer{border-radius:20px;}
</style>
<div class="col-md-12">
    <div class="row">
        @foreach($scheme as $var)
        <div class="col-sm-4" >
            <!-- small box -->
            <a href="{{url('/candidate/scheme/'.$var->idScheme.'/jobs')}}">
                <div class="small-box bg-gray {{ $var->schemeName }}">
                    <div class="inner">
                        <h3 style="font-size:25px;">{{ $var->schemeName }}</h3>
    
                    </div>
                    <div class="icon">
                        <i class="{{$var->schemeIcon}}"></i>
                    </div>
                    <!--Total Count-->
                    <!-- <span class="small-box-footer">Schemes<i class="fa fa-arrow-circle-right"></i></span>-->
                    <span class="small-box-footer"><?php 
                                        $secor_ids = $var->sector->pluck('idSector')->toArray();
                                            $jobrole_ids =\App\JobRole::whereIn('idSector',$secor_ids)->get()->pluck('idJobRole')->toArray();
                                            $jobs = \App\Job::whereIn('idJobRole',$jobrole_ids)->get()->count();
                                            ?>
                                                Jobs :- {{$jobs}}</span>
                    <!--end here total-->
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="col-md-12">
    <div class="block black bg-white">
        <div class="sub_category_view">
            <ul style="padding: 15px 10px 30px;">
                <li class="category_overview" style="padding-left: 0px; text-align: center;">
                    <h1 style="font-size: 30px;font-family: serif;color: #002a5d;font-weight: 900;">Available Links</h1>
                    <div>
                        <h1><a href="{{url('/candidate/jobs')}}" style="padding:30px; text-align:center;">Jobs</a></h1>
                        <h1><a href="{{url('/candidate/jobs')}}" style="padding:30px; text-align:center;">Mentors</a></h1>
                        <h1><a href="http://hsdm.org.in/job_roles.php" style="padding:30px; text-align:center;" target="_blank">Job Roles</a></h1>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop