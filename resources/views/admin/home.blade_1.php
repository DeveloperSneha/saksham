@extends('layouts.app')
@section('content')
<style>
.main_div_job_role .Job_by_role.active {
   background: linear-gradient(to right, rgb(205, 197, 251), rgb(190, 228, 245)); 
}
.main_div_job_role{
   background: linear-gradient(to right, rgb(205, 197, 251), rgb(190, 228, 245)); 
}
    .analytics_div {
    padding: 30px 30px 0px;
    background: linear-gradient(to right, rgb(205, 197, 251), rgb(190, 228, 245));
}
[type="radio"]:checked + label, [type="radio"]:not(:checked) + label {
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #ca0101;
}
</style>
<div class="row" style="width:100%; padding:10px;">
    @if(Auth::guard('web')->check())
    <div class="col-sm-2 sidebar" style="height:2093px">
        <ul class="sidebar_menu">
            <li><a href="{{url('admin/home')}}">{{ Auth::user()->name }}</a></li>
            <li><a href="{{url('admin/home')}}" class="active">Dashboard</a></li>
            <li><a href="{{url('admin/companies')}}">Companies</a></li>
            <li><a href="{{url('admin/candidates')}}">Candidates</a></li>
            <li><a href="{{url('admin/mentors')}}">Mentors</a></li>
            <li><a href="{{url('admin/add_notification')}}">Add Notification</a></li>
            <li><a href="{{url('admin/import')}}">Import Data</a></li>
            <li><a href="{{url('admin/export')}}" >Export Data</a></li>
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
        </ul>
    </div>
    @endif
    <div class="col-sm-10 main_content">
        <div class="Admin_dashboard">
            <div class="dashboard_div" style="background:#e3e3e3;border-top-right-radius:35px;border-bottom-right-radius:35px;padding:20px 0 0px">
                <div class="head_slide"><span class="first_letter">S</span>aksham <span class="first_letter">D</span>arpan</div>
                <div class="dashboard_container" style="padding:20px;padding-bottom:15px">

                    <div class="dashboard_values" style="text-align:center;">
                        <ul>
                            <li style="background: linear-gradient(to right, rgb(54, 52, 130), rgb(0, 180, 197));box-shadow: 0 6px 44px -4px rgb(10, 23, 25);">
                                <div class="dash_sector_left">
                                    <i class=""></i>
                                </div>
                                <div class="dash_sector_right" style="padding-top: 0px;">
                                    <span style="color: white;font-size: 20px;"></span> 
                                    <span></span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="analytics_div">
                        <center><h2>Statistics Of Candidate By Sector Wise</h2></center>
                        <div class="sectorwise_list" >
                            <ul style="text-align:center;">
                                <li>
                                    <input type="radio" id="" name="sectorwise_list" value="">
                                    <label for="sectorwise_''"></label>
                                </li>
                            </ul>
                        </div>
                        <div class="sector_training sector_data_div" id="sectorwise_">
                            <div class="analytics_data">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sector</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 40%;"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="analytics_chart">
                                <div id="chartContainer" style="height: 370px; max-width: 900px; margin: 0px auto;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="analytics_div" >
                        <center><h2>Statistics Of Candidate By District Wise</h2></center>
                        <div class="districtwise_list">
                            <ul style="text-align:center;">
                                <li>
                                    <input type="radio" id="districtwise_" name="districtwise_list" value="">
                                    <label for="districtwise_"></label>
                                </li>
                            </ul>
                        </div>
                        <div class="district_training district_data_div" id="Districtwise_">
                            <div class="analytics_data">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>District</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="analytics_chart">
                                <div id="DistrictContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main_div_job_role" style="padding:0;">
                        <div class="analytics_div" style="padding:0;margin-bottom:15px;    position: relative;">
                            <ul class="selecting_role" style="padding:5px;">
                                <li style="color:black;">Select Sector</li>
                                <li>
                                    <Select id="colorselector">

                                    </Select>
                                </li>
                            </ul>
                        </div>
                        <div class="analytics_div Job_by_role" id="" style="position: relative;">
                            <center><h2>Statistics Of Candidate By Job Roles in </h2></center>
                            <div class="">
                                <ul>

                                </ul>
                            </div>


                            <div class="" id="">
                                <div class="analytics_data">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Job Role</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="analytics_chart">
                                    <div id=""
                                         style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--</div>-->

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function () {

        <?php
     //   echo $sector_wise_graphs_script_data;
        ?>

        <?php
       // echo $district_wise_graphs_script_data;
        ?>

        <?php
        // echo $job_wise_graphs_script_data;
        ?>

        $("#chartContainer1").CanvasJSChart(sector_training);
        $("#chartContainer2").CanvasJSChart(sector_trained);
        $("#chartContainer3").CanvasJSChart(sector_assessed);
        $("#chartContainer4").CanvasJSChart(sector_certified);
        // $("#chartContainer5").CanvasJSChart(sector_placed);

        $("#DistrictContainer1").CanvasJSChart(district_training);
        $("#DistrictContainer2").CanvasJSChart(district_trained);
        $("#DistrictContainer3").CanvasJSChart(district_assessed);
        $("#DistrictContainer4").CanvasJSChart(district_certified);
        // $("#DistrictContainer5").CanvasJSChart(district_placed);

        $("#AgricultureContainer1").CanvasJSChart(Agriculture_training);
        $("#AgricultureContainer2").CanvasJSChart(Agriculture_trained);
        $("#AgricultureContainer3").CanvasJSChart(Agriculture_assessed);
        $("#AgricultureContainer4").CanvasJSChart(Agriculture_certified);
        // $("#AgricultureContainer5").CanvasJSChart(Agriculture_placed);

        $("#BFSIContainer1").CanvasJSChart(BFSI_training);
        $("#BFSIContainer2").CanvasJSChart(BFSI_trained);
        $("#BFSIContainer3").CanvasJSChart(BFSI_assessed);
        $("#BFSIContainer4").CanvasJSChart(BFSI_certified);
        // $("#BFSIContainer5").CanvasJSChart(BFSI_placed);

        $("#ElectronicsContainer1").CanvasJSChart(Electronics_training);
        $("#ElectronicsContainer2").CanvasJSChart(Electronics_trained);
        $("#ElectronicsContainer3").CanvasJSChart(Electronics_assessed);
        $("#ElectronicsContainer4").CanvasJSChart(Electronics_certified);
        // $("#ElectronicsContainer5").CanvasJSChart(Electronics_placed);

        $("#EntrepreneurshipContainer1").CanvasJSChart(Entrepreneurship_training);
        $("#EntrepreneurshipContainer2").CanvasJSChart(Entrepreneurship_trained);
        $("#EntrepreneurshipContainer3").CanvasJSChart(Entrepreneurship_assessed);
        $("#EntrepreneurshipContainer4").CanvasJSChart(Entrepreneurship_certified);
        // $("#EntrepreneurshipContainer5").CanvasJSChart(Entrepreneurship_placed);

        $("#InstrumentationContainer1").CanvasJSChart(Instrumentation_training);
        $("#InstrumentationContainer2").CanvasJSChart(Instrumentation_trained);
        $("#InstrumentationContainer3").CanvasJSChart(Instrumentation_assessed);
        $("#InstrumentationContainer4").CanvasJSChart(Instrumentation_certified);
        // $("#InstrumentationContainer5").CanvasJSChart(Instrumentation_placed);

        $("#TelecomContainer1").CanvasJSChart(Telecom_training);
        $("#TelecomContainer2").CanvasJSChart(Telecom_trained);
        $("#TelecomContainer3").CanvasJSChart(Telecom_assessed);
        $("#TelecomContainer4").CanvasJSChart(Telecom_certified);
        // $("#TelecomContainer5").CanvasJSChart(Telecom_placed);
    }
</script>
@stop