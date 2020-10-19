@extends('layouts.app')
@section('content')
<?php
$CANDIDATE_STATUS_WISE =
$CANDIDATE_TYPE_SECTOR_WISE =
$CANDIDATE_STATUS_DISTRICT_WISE =
$CANDIDATE_STATUS_JOB_WISE =
$CANDIDATE_TYPE_DISTRICT_WISE = array();
$CANDIDATE_TYPE_JOB_WISE = array();
$CANDIDATE_TYPE_JOB_WISE_SECTORS = array();
$DISTRICT_DETAILS = array();
$JOB_DETAILS = array();
$JOB_SECTOR_DETAILS = array();

$sector_wise_graphs_script_data = '';
$district_wise_graphs_script_data = '';
$job_wise_graphs_script_data = '';

foreach ($DARPAN_SECTOR_WISE as $SECTOR_WISE) {

    foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {
        $MALE_FEMALE_SUM = 0;
        foreach ($DARPAN_CANDIDATE_GENDER as $CANDIDATE_GENDER_KEY => $CANDIDATE_GENDER_TEXT) {
            $MALE_FEMALE_SUM += $SECTOR_WISE[$CANDIDATE_KEY."_".$CANDIDATE_GENDER_KEY];
            $CANDIDATE_STATUS_WISE[$SECTOR_WISE['sector_id']][$CANDIDATE_KEY][$CANDIDATE_GENDER_KEY] = $SECTOR_WISE[$CANDIDATE_KEY."_".$CANDIDATE_GENDER_KEY];
        }
        $CANDIDATE_STATUS_WISE[$SECTOR_WISE['sector_id']][$CANDIDATE_KEY]['total'] = $MALE_FEMALE_SUM;
        $CANDIDATE_TYPE_SECTOR_WISE[$CANDIDATE_KEY] = (isset($CANDIDATE_TYPE_SECTOR_WISE[$CANDIDATE_KEY]) ? $CANDIDATE_TYPE_SECTOR_WISE[$CANDIDATE_KEY] : 0)  + $MALE_FEMALE_SUM;
    }
}

foreach ($DARPAN_DISTRICT_WISE as $DISTRICT_WISE) {

    $DISTRICT_DETAILS[$DISTRICT_WISE['district_id']] = $DISTRICT_WISE;
    foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {
        $MALE_FEMALE_SUM = 0;
        foreach ($DARPAN_CANDIDATE_GENDER as $CANDIDATE_GENDER_KEY => $CANDIDATE_GENDER_TEXT) {
            $MALE_FEMALE_SUM += $DISTRICT_WISE[$CANDIDATE_KEY."_".$CANDIDATE_GENDER_KEY];
            $CANDIDATE_STATUS_DISTRICT_WISE[$DISTRICT_WISE['district_id']][$CANDIDATE_KEY][$CANDIDATE_GENDER_KEY] = $DISTRICT_WISE[$CANDIDATE_KEY."_".$CANDIDATE_GENDER_KEY];
        }
        $CANDIDATE_STATUS_DISTRICT_WISE[$DISTRICT_WISE['district_id']][$CANDIDATE_KEY]['total'] = $MALE_FEMALE_SUM;
        $CANDIDATE_TYPE_DISTRICT_WISE[$CANDIDATE_KEY] = (isset($CANDIDATE_TYPE_DISTRICT_WISE[$CANDIDATE_KEY]) ? $CANDIDATE_TYPE_DISTRICT_WISE[$CANDIDATE_KEY] : 0)  + $MALE_FEMALE_SUM;
    }
}
foreach ($DARPAN_JOB_ROLE_WISE as $JOB_WISE) {

    $JOB_DETAILS[$JOB_WISE['job_role_id']]['job_role_id'] = $JOB_WISE['job_role_id'];
    $JOB_DETAILS[$JOB_WISE['job_role_id']]['job_role_name'] = $JOB_WISE['job_role'];
    $JOB_SECTOR_DETAILS[$JOB_WISE['sector_id']]['sector_id'] = $JOB_WISE['sector_id'];
    $JOB_SECTOR_DETAILS[$JOB_WISE['sector_id']]['sector_name'] = $JOB_WISE['sector'];

    foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {
        $MALE_FEMALE_SUM = 0;
        foreach ($DARPAN_CANDIDATE_GENDER as $CANDIDATE_GENDER_KEY => $CANDIDATE_GENDER_TEXT) {
            $MALE_FEMALE_SUM += $JOB_WISE[$CANDIDATE_KEY."_".$CANDIDATE_GENDER_KEY];
            $CANDIDATE_STATUS_JOB_WISE[$JOB_WISE['sector_id']][$JOB_WISE['job_role_id']][$CANDIDATE_KEY][$CANDIDATE_GENDER_KEY] = $JOB_WISE[$CANDIDATE_KEY."_".$CANDIDATE_GENDER_KEY];
        }
        $CANDIDATE_STATUS_JOB_WISE[$JOB_WISE['sector_id']][$JOB_WISE['job_role_id']][$CANDIDATE_KEY]['total'] = $MALE_FEMALE_SUM;
        $CANDIDATE_TYPE_JOB_WISE[$CANDIDATE_KEY] = (isset($CANDIDATE_TYPE_JOB_WISE[$CANDIDATE_KEY]) ? $CANDIDATE_TYPE_JOB_WISE[$CANDIDATE_KEY] : 0)  + $MALE_FEMALE_SUM;
    }
}

?>
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
<div class="Admin_dashboard">
    <div class="dashboard_div" style="background:#e3e3e3;border-top-right-radius:35px;border-bottom-right-radius:35px;padding:20px 0 0px">
        <div class="head_slide"><span class="first_letter">S</span>aksham <span class="first_letter">D</span>arpan</div>
        <div class="dashboard_container" style="padding:20px;padding-bottom:15px">

            <div class="dashboard_values" style="text-align:center;">
                <!--<ul>-->
                    <?php
                    // foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {
                        
                    //     echo '
                    //         <li style="background: linear-gradient(to right, rgb(54, 52, 130), rgb(0, 180, 197));box-shadow: 0 6px 44px -4px rgb(10, 23, 25);">
                    //             <div class="dash_sector_left"><i class="fas '.$CANDIDATE_TEXT['icon'].'"></i></div>
                    //             <div class="dash_sector_right" style="padding-top: 0px;">
                    //                 <span style="color: white;font-size: 20px;">'.$CANDIDATE_TEXT['name'].'</span> 
                    //                 <span>'.$CANDIDATE_TYPE_SECTOR_WISE[$CANDIDATE_KEY].'</span>
                    //             </div>
                    //         </li>
                    //     ';
                    // }
                    ?>
                <!--</ul>-->
                <ul>
                    
                            <li style="background: linear-gradient(to right, rgb(54, 52, 130), rgb(0, 180, 197));box-shadow: 0 6px 44px -4px rgb(10, 23, 25);">
                                <div class="dash_sector_left"><i class="fas fa-users-cog"></i></div>
                                <div class="dash_sector_right" style="padding-top: 0px;">
                                    <span style="color: white;font-size: 20px;">Enrolled</span> 
                                    <span>3860</span>
                                </div>
                            </li>
                        
                            <li style="background: linear-gradient(to right, rgb(54, 52, 130), rgb(0, 180, 197));box-shadow: 0 6px 44px -4px rgb(10, 23, 25);">
                                <div class="dash_sector_left"><i class="fas fa-user-check"></i></div>
                                <div class="dash_sector_right" style="padding-top: 0px;">
                                    <span style="color: white;font-size: 20px;">Trained</span> 
                                    <span>3860</span>
                                </div>
                            </li>
                        
                            <li style="background: linear-gradient(to right, rgb(54, 52, 130), rgb(0, 180, 197));box-shadow: 0 6px 44px -4px rgb(10, 23, 25);">
                                <div class="dash_sector_left"><i class="fas fa-file-signature"></i></div>
                                <div class="dash_sector_right" style="padding-top: 0px;">
                                    <span style="color: white;font-size: 20px;">Assessed</span> 
                                    <span>2723</span>
                                </div>
                            </li>
                        
                            <li style="background: linear-gradient(to right, rgb(54, 52, 130), rgb(0, 180, 197));box-shadow: 0 6px 44px -4px rgb(10, 23, 25);">
                                <div class="dash_sector_left"><i class="fas fa-graduation-cap"></i></div>
                                <div class="dash_sector_right" style="padding-top: 0px;">
                                    <span style="color: white;font-size: 20px;">Certified</span> 
                                    <span>2417</span>
                                </div>
                            </li>
                                        </ul>
            </div>

            <div class="analytics_div">
                <center><h2>Statistics Of Candidate By Sector Wise</h2></center>
                <div class="sectorwise_list" >
                    <ul style="text-align:center;">
                        <?php
                        $counter = 1;
                        foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {

                            $checked = '';
                            if($counter == 1) {
                                $checked = 'checked';
                            }
                            echo '
                                <li>
                                    <input type="radio" id="sectorwise_'.$CANDIDATE_KEY.'" name="sectorwise_list" value="'.$counter.'" '.$checked.'>
                                    <label for="sectorwise_'.$CANDIDATE_KEY.'">'.$CANDIDATE_TEXT['name'].'</label>
                                </li>
                                ';
                            $counter++;
                        }
                        ?>
                    </ul>
                </div>

                <?php

                $counter = 1;
                foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {

                    $active = '';
                    if($counter == 1) {
                        $active = ' active ';
                    }
                    ?>
                    <div class="sector_training sector_data_div <?=$active?>" id="sectorwise_<?=$counter?>">
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
                                    <?php
                                    $GRAPH_DATA_POINTS = array();

                                    foreach ($COURSES as $SECTOR_ID => $SECTOR) {
                                        echo '  <tr>
                                                    <td style="width: 40%;">' . $SECTOR['schemeName'] . '</td>';


                                    if(isset($CANDIDATE_STATUS_WISE[$SECTOR_ID])) {
                                    $TOTAL = $CANDIDATE_STATUS_WISE[$SECTOR_ID][$CANDIDATE_KEY]['total'];
                                    $MALE = $CANDIDATE_STATUS_WISE[$SECTOR_ID][$CANDIDATE_KEY]['male'];
                                    $FEMALE = $CANDIDATE_STATUS_WISE[$SECTOR_ID][$CANDIDATE_KEY]['female'];

                                    } else {
                                        $TOTAL = $MALE = $FEMALE = 0;
                                    }
                                    echo '<td>'. $MALE.'</td>';
                                    echo '<td>'. $FEMALE.'</td>';
                                    echo '<td>'. $TOTAL.'</td>';
    
                                    $GRAPH_DATA_POINTS[] = array(
                                        'label' =>  $SECTOR['schemeName'],
                                        'y' => array((int)$MALE, (int)$FEMALE)
                                    );
    
                                    echo '</tr>
                                                ';
                                }
                                ?>
                                </tbody>
                            </table>
                            <!--<ul class="data_head">-->
                            <!--    <li>Sector</li>-->
                            <!--    <li>Male</li>-->
                            <!--    <li>Female</li>-->
                            <!--    <li>Total</li>-->
                            <!--</ul>-->
                            <?php
                            // $GRAPH_DATA_POINTS = array();

                            // foreach ($COURSES as $SECTOR_ID => $SECTOR) {
                            //     echo '  <ul class="data_values">
                            //                         <li>' . $SECTOR['course_name'] . '</li>';


                            //     if(isset($CANDIDATE_STATUS_WISE[$SECTOR_ID])) {
                            //         $TOTAL = $CANDIDATE_STATUS_WISE[$SECTOR_ID][$CANDIDATE_KEY]['total'];
                            //         $MALE = $CANDIDATE_STATUS_WISE[$SECTOR_ID][$CANDIDATE_KEY]['male'];
                            //         $FEMALE = $CANDIDATE_STATUS_WISE[$SECTOR_ID][$CANDIDATE_KEY]['female'];

                            //     } else {
                            //         $TOTAL = $MALE = $FEMALE = 0;
                            //     }
                            //     echo '<li>'. $MALE.'</li>';
                            //     echo '<li>'. $FEMALE.'</li>';
                            //     echo '<li>'. $TOTAL.'</li>';

                            //     $GRAPH_DATA_POINTS[] = array(
                            //         'label' =>  $SECTOR['course_name'],
                            //         'y' => array((int)$MALE, (int)$FEMALE)
                            //     );

                            //     echo '</ul>
                            //                 ';
                            // }
                            ?>
                        </div>
                        <div class="analytics_chart">
                            <div id="chartContainer<?=$counter?>" style="height: 370px; max-width: 900px; margin: 0px auto;"></div>
                        </div>
                    </div>
                    <?php

                    $sector_wise_graphs_script_data .= '
                              var sector_'.$CANDIDATE_KEY.' = {
                                animationEnabled: true,
                                toolTip: {
                                    content : "{label} <br> Male: {y[0]} <br> Female: {y[1]}"
                                },
                                title: {
                                    text: "'.$CANDIDATE_TEXT['name'].'"
                                },
                                axisY: {
                                    title: "Male & Female",
                                    suffix: "",
                                    includeZero: false
                                },
                                axisX: {
                                    title: "Sectors"
                                },
                                data: [{
                                    type: "rangeSplineArea",
                                    yValueFormatString: "#####",
                                    dataPoints: '.json_encode($GRAPH_DATA_POINTS).'
                                }]
                            };
                        ';
                    $counter++;
                }
                ?>
            </div>

            <div class="analytics_div" >
                <center><h2>Statistics Of Candidate By District Wise</h2></center>
                <div class="districtwise_list">
                    <ul style="text-align:center;">
                        <?php
                        $counter = 1;
                        foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {

                            $checked = '';
                            if($counter == 1) {
                                $checked = 'checked';
                            }
                            echo '
                                <li>
                                    <input type="radio" id="districtwise_'.$CANDIDATE_KEY.'" name="districtwise_list" value="'.$counter.'" '.$checked.'>
                                    <label for="districtwise_'.$CANDIDATE_KEY.'">'.$CANDIDATE_TEXT['name'].'</label>
                                </li>
                                ';
                            $counter++;
                        }
                        ?>
                    </ul>
                </div>

                <?php

                $counter = 1;
                foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {

                    $active = '';
                    if($counter == 1) {
                        $active = ' active ';
                    }
                    ?>
                    <div class="district_training district_data_div <?=$active?>" id="Districtwise_<?=$counter?>">
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
                                    <?php
                                    $MALE_GRAPH_DATA_POINTS = $FEMALE_GRAPH_DATA_POINTS = array();

                                    foreach ($CANDIDATE_STATUS_DISTRICT_WISE as $DISTRICT_ID => $DISTRICT_DATA) {
                                    echo'  <tr>
                                            <td>' . $DISTRICT_DETAILS[$DISTRICT_ID]['district'] . '</td>';

                                        if(isset($CANDIDATE_STATUS_DISTRICT_WISE[$DISTRICT_ID])) {
                                        $TOTAL = $CANDIDATE_STATUS_DISTRICT_WISE[$DISTRICT_ID][$CANDIDATE_KEY]['total'];
                                        $MALE = $CANDIDATE_STATUS_DISTRICT_WISE[$DISTRICT_ID][$CANDIDATE_KEY]['male'];
                                        $FEMALE = $CANDIDATE_STATUS_DISTRICT_WISE[$DISTRICT_ID][$CANDIDATE_KEY]['female'];
                                        } else {
                                        $TOTAL = $MALE = $FEMALE = 0;
                                    }
                                    echo '<td>'. $MALE.'</td>';
                                    echo '<td>'. $FEMALE.'</td>';
                                    echo '<td>'. $TOTAL.'</td>';
    
                                    $MALE_GRAPH_DATA_POINTS[] = array(
                                        'label' => $DISTRICT_DETAILS[$DISTRICT_ID]['district'],
                                        'y' => (int)$MALE,
                                        'male_count' => (int)$MALE,
                                        'female_count' => (int)$FEMALE
                                    );
                                    $FEMALE_GRAPH_DATA_POINTS[] = array(
                                        'label' => $DISTRICT_DETAILS[$DISTRICT_ID]['district'],
                                        'y' => (int)$FEMALE,
                                        'male_count' => (int)$MALE,
                                        'female_count' => (int)$FEMALE
                                    );
                                    echo '</tr>
                                                ';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="analytics_chart">
                            <div id="DistrictContainer<?=$counter?>" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                        </div>
                    </div>
                    <?php

                    $district_wise_graphs_script_data .= '
                              var district_'.$CANDIDATE_KEY.' = {
                                animationEnabled: true,
                                toolTip: {
                                    content : "{label} <br> Male: {male_count} <br> Female: {female_count}"
                                },
                                title: {
                                    text: "'.$CANDIDATE_TEXT['name'].'"
                                },
                                axisY: {
                                    title: "Male & Female",
                                    suffix: "",
                                    includeZero: false
                                },
                                axisX: {
                                    title: "Districts"
                                },
                                data: [{
                                    type: "line",
                                    yValueFormatString: "#,##0.0#"% "",
                                    dataPoints: '.json_encode($MALE_GRAPH_DATA_POINTS).'
                                },
                                {
                                    type: "line",
                                    yValueFormatString: "#,##0.0#"% "",
                                    dataPoints: '.json_encode($FEMALE_GRAPH_DATA_POINTS).'
                                }]
                            };
                        ';
                    $counter++;
                }
                ?>
            </div>
            
            
            <div class="main_div_job_role" style="padding:0;">
                <div class="analytics_div" style="padding:0;margin-bottom:15px;    position: relative;">
                <ul class="selecting_role" style="padding:5px;">
                    <li style="color:black;">Select Sector</li>
                    <li>
                        <Select id="colorselector">
                            <?php
                            $sec_counter = 1;
                            foreach ($JOB_SECTOR_DETAILS as $J_SECTOR) {
                                $selected = '';
                                if($sec_counter == 1) {
                                    $sec_counter++;
                                    $selected = 'selected';
                                }
                                echo '<option '.$selected.' value="'.$J_SECTOR['sector_name'].'" >'.$J_SECTOR['sector_name'].'</option>';
                            }
                            ?>
                        </Select>
                    </li>
                </ul>
                </div>
                <?php
                $default_graph_counter = 1;

                foreach ($JOB_SECTOR_DETAILS as $J_SECTOR) {
                    $active = '';
                    if($default_graph_counter == 1) {
                        $default_graph_counter++;
                        $active = 'active';
                    }
                    ?>
                    <div class="analytics_div Job_by_role <?=$active?>" id="<?=$J_SECTOR['sector_name']?>" style="position: relative;">
                        <center><h2>Statistics Of Candidate By Job Roles in <?=$J_SECTOR['sector_name']?></h2></center>
                        <div class="<?=$J_SECTOR['sector_name']?>jobwise_list">
                            <ul>
                                <?php
                                $counter = 1;
                                foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {

                                    $checked = '';
                                    if($counter == 1) {
                                        $checked = 'checked';
                                    }
                                    echo '
                                    <li>
                                        <input type="radio" id="'.$J_SECTOR['sector_name'].'jobwise_'.$CANDIDATE_KEY.'" name="'.$J_SECTOR['sector_name'].'jobwise_list" value="'.$counter.'" '.$checked.'>
                                        <label for="'.$J_SECTOR['sector_name'].'jobwise_'.$CANDIDATE_KEY.'">'.$CANDIDATE_TEXT['name'].'</label>
                                    </li>
                                    ';
                                    $counter++;
                                }
                                ?>
                            </ul>
                        </div>

                        <?php
                        $counter = 1;
                        foreach ($DARPAN_CANDIDATE_STATUS as $CANDIDATE_KEY => $CANDIDATE_TEXT) {

                            $active = '';
                            if ($counter == 1) {
                                $active = ' active ';
                            }
                            ?>
                            <div class="<?=$J_SECTOR['sector_name']?>job_training <?=$J_SECTOR['sector_name']?>job_data_div <?= $active ?>" id=<?=$J_SECTOR['sector_name']?>jobwise_<?= $counter ?> >
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
                                        <tbody><?php
                                        $MALE_GRAPH_DATA_POINTS = $FEMALE_GRAPH_DATA_POINTS = array();

                                        foreach ($CANDIDATE_STATUS_JOB_WISE[$J_SECTOR['sector_id']] as $JOB_ROLE_ID => $JOB_ROLE_DATA) {
                                        echo '  <tr>
                                                    <td>' . $JOB_DETAILS[$JOB_ROLE_ID]['job_role_name'] . '</td>';

                                        if (isset($JOB_ROLE_DATA)) {
                                            $TOTAL = $JOB_ROLE_DATA[$CANDIDATE_KEY]['total'];
                                            $MALE = $JOB_ROLE_DATA[$CANDIDATE_KEY]['male'];
                                            $FEMALE = $JOB_ROLE_DATA[$CANDIDATE_KEY]['female'];
                                        } else {
                                            $TOTAL = $MALE = $FEMALE = 0;
                                        }
                                        echo '<td>' . $MALE . '</td>';
                                        echo '<td>' . $FEMALE . '</td>';
                                        echo '<td>' . $TOTAL . '</td>';

                                        $MALE_GRAPH_DATA_POINTS[] = array(
                                            'label' => $JOB_DETAILS[$JOB_ROLE_ID]['job_role_name'],
                                            'y' => (int)$MALE,
                                            'male_count' => (int)$MALE,
                                            'female_count' => (int)$FEMALE
                                        );
                                        $FEMALE_GRAPH_DATA_POINTS[] = array(
                                            'label' => $JOB_DETAILS[$JOB_ROLE_ID]['job_role_name'],
                                            'y' => (int)$FEMALE,
                                            'male_count' => (int)$MALE,
                                            'female_count' => (int)$FEMALE
                                        );
                                        echo '</tr>
                                                    ';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                </div>
                                <div class="analytics_chart">
                                    <div id="<?=$J_SECTOR['sector_name'] ?>Container<?= $counter ?>"
                                         style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                                </div>
                            </div>
                            <?php
                            $job_wise_graphs_script_data .= '
                                      var '.$J_SECTOR['sector_name'].'_' . $CANDIDATE_KEY . ' = {
                                        animationEnabled: true,
                                        toolTip: {
                                            content : "{label} <br> Male: {male_count} <br> Female: {female_count}"
                                        },
                                        title: {
                                            text: "' . $CANDIDATE_TEXT['name'] . '"
                                        },
                                        axisY: {
                                            title: "Male & Female",
                                            suffix: "",
                                            includeZero: false
                                        },
                                        axisX: {
                                            title: "Job Roles"
                                        },
                                        data: [{
                                            type: "column",
                                            yValueFormatString: "#,##0.0#"% "",
                                            dataPoints: ' . json_encode($MALE_GRAPH_DATA_POINTS) . '
                                        },
                                        {
                                            type: "column",
                                            yValueFormatString: "#,##0.0#"% "",
                                            dataPoints: ' . json_encode($FEMALE_GRAPH_DATA_POINTS) . '
                                        }
                                        ]
                                    };
                                ';
                            $counter++;
                        }
                        ?>
                    </div>

                    <?php
                }
                ?>
            </div>
            <!--</div>-->

        </div>
    </div>
</div>

@stop
@section('script')
<script>
    window.onload = function () {

        <?php
        echo $sector_wise_graphs_script_data;
        ?>

        <?php
        echo $district_wise_graphs_script_data;
        ?>

        <?php
        echo $job_wise_graphs_script_data;
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