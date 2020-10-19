<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>News</title>

<base target="_parent">

<style>


/* EMBEDDED NEWS PAGE BODY */

#NewsDiv    { position: absolute; left: 0; top: 0px; width: 100%; }

body.news-scroll {
        margin: 0;
        padding: 0;
        border: 0;
        }



/* EMBEDDED NEWS PAGE LINK COLORS */

.news-scroll a:link { color: #ff6e00; text-decoration: none;font-family: serif;     font-size: 19px;}

.news-scroll a:visited  { color: #ff6e00; text-decoration: none;font-family: serif; font-size: 19px;}

.news-scroll a:active   { color: #f00; text-decoration: none; font-family: serif;font-size: 19px;}

.news-scroll a:hover    { color: #f00; text-decoration: underline; font-family: serif;font-size: 19px;}

ul {
 list-style-type: square;
 list-style-position: outside;
 list-style-image: none;
}
li {
    padding-left: 0px;
    font-size: 14px;
    line-height: 18px;
    text-align: justify;
    border-bottom: dotted 1px #D3D3D3;
    /*height: 20px;*/
    padding: 2px 6px 3px 3px;
    display: block;
    overflow: hidden;
    font-family: Trebuchet MS, Lucida Sans Unicode,Arial,sans-serif;
}


</style>

</head>

<!--<body class="news-scroll" onMouseover="scrollspeed=0" onMouseout="scrollspeed=current" OnLoad="NewsScrollStart();">-->

<body class="news-scroll">
 <!--START NEWS FEED -->
<div id="NewsDiv">
    <div class="">
        <!--SCROLLER CONTENT STARTS HERE -->
        <ol style="padding: 0px;">
            <li><b>Company Name: AXIS BANK</b><br>
Job location: Panchkula, Pinjore, Kalka, Zirakpur <br>
Job profile: Sales Officer (Field Job)<br>
Salary: Rs. 1.8 LPA+Incentives<br>
Qualification: Graduate/PG<br>
Date of placement drive: 7th September, 2019 (1:00 pm)<br>
Contact number: 7417711108</li>
 
<li><b>Company Name: Exicom Tele Systems Ltd.</b><br>
Job location: Gurugram <br>
Job profile: Telecom <br>
Salary: Rs. 11600/-<br>
Qualification: ITI<br>
Contact number: 8130292442 </li>
 
<li><b>Company Name: Metal and Wood Crafts</b><br>
Job location: Ambala<br>
Job profile: Workshop helpers<br>
Salary: Rs. 7000/-<br>
Contact number: 9034236263</li>
 
 
 
<li><b>Company Name: Paramount Industries</b><br>
Job location: Ambala<br>
Job profile: Fitter<br>
Salary: Rs. 8000/-<br>
Contact number: 9466157556</li>
 
 
<li><b>Company Name: Satiate Research & ANatech Pvt Ltd</b><br>
Job location: Panchkula<br>
Qualification: BSc/MSc/B.Pharma/M.Pharma<br>
Salary: Rs. 10000/-<br>
Contact number: 8818001830</li>
 
 
<li><b>Company Name: Superwell Services Pvt. Ltd.</b><br>
Job location: Delhi<br>
Job Profile: Tr. Technical Support<br>
Qualification: B.Tech<br>
Salary: Rs. 19800/-<br>
Contact number: 9999381829</li>

            <li>
                <b>Urgent Requirement For Fresher in Palwal</b>
                Designation:Post Sales Executive in Muthoot Finance<br>
                Salary: 12-15 Thousand<br>
                Interview location: Delhi (nearby Kalka Jj Mandir)<br>
                Contact:
                Arun Bhardwaj
                9050515551
                Shri Bala Ji Consultancy, Hodal
            </li><br>
         <!--   <li>
                <span class=""> TCS hiring 2018 and 2019 graduates <br>Click to know the registration process of TCS<br><br>
Go to: https://careers.tcs.com => Click on TCS Off Campus  - for the batch of 2018 and 2019 banner => Click On Register Now<br><br><a href="https://careers.tcs.com" target="_blank" ><b> (Click to apply)</b><img src="{{asset('/dist/img/new.gif')}}"></a>
                </span>
            </li><br>-->
            <br>
            <li>
                <span class=""><a href="{{asset('dist/img/Learn_to_introduce__yourself.png')}}" target="_blank" > <b>Learn to introduce youself</b> <img src="{{asset('/dist/img/new.gif')}}"></a>
                </span>
            </li>
        </ul>
        
        
    
     <!--END SCROLLER CONTENT -->
    </div>
</div>
 <!--END NEWS FEED -->




 <!--YOU DO NOT NEED TO EDIT BELOW THIS LINE -->

<script type="text/javascript">


var startdelay 		= 10; 		// START SCROLLING DELAY IN SECONDS
var scrollspeed		= 1.4;		// ADJUST SCROLL SPEED
var scrollwind		= 1;		// FRAME START ADJUST
var speedjump		= 20;		// ADJUST SCROLL JUMPING = RANGE 20 TO 40
var nextdelay		= 0; 		// SECOND SCROLL DELAY IN SECONDS 0 = QUICKEST
var topspace		= "20px";	// TOP SPACING FIRST TIME SCROLLING
var frameheight		= 176;		// IF YOU RESIZE THE CSS HEIGHT, EDIT THIS HEIGHT TO MATCH


current = (scrollspeed);


function HeightData(){
AreaHeight=dataobj.offsetHeight
if (AreaHeight===0){
setTimeout("HeightData()",( startdelay * 1000 ))
}
else {
ScrollNewsDiv()
}}

function NewsScrollStart(){
dataobj=document.all? document.all.NewsDiv : document.getElementById("NewsDiv")
dataobj.style.top=topspace
setTimeout("HeightData()",( startdelay * 1000 ))
}

function ScrollNewsDiv(){
dataobj.style.top=scrollwind+'px';
scrollwind-=scrollspeed;
if (parseInt(dataobj.style.top)<AreaHeight*(-1)) {
dataobj.style.top=frameheight+'px';
scrollwind=frameheight;
setTimeout("ScrollNewsDiv()",( nextdelay * 100 ))
}
else {
setTimeout("ScrollNewsDiv()",speedjump)
}}


</script>


</body>
</html>
