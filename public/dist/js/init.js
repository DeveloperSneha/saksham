$(function () {

    $("#leaders_messages").click(function() {
        $('html, body').animate({
            scrollTop: $("#leaders").offset().top - 130
        }, 600);
    });

    /*************Main navigation hover slide down*********/
    $(".nav_main ul li.has-child").hover(function(e){
        e.preventDefault();
        $(this).children("ul").slideDown("fast");
    }, function(){
        $(this).children("ul").slideUp("fast");
    });

    /************ Dashboard Counter increment animation***********/
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    /****************Select Box***************/
    $(".select_box").click(function(){
        $(this).next("ul").slideToggle();
    });
    $(".post_new_course_main li").click(function(){
        $(this).parent().slideUp();
    });

    $(".couses_list .main_course").click(function(){
        $(this).next(".sub_course_div").slideToggle();
    });
    $(".sub_course_div .sub_course").click(function(){
        $(this).parent().slideUp();
    });

    if(($(window).width())>750){
        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();
            var height = $(".banner_wrap").innerHeight();
            if(scroll > height){
                $(".breadcrumbs-wrap").addClass("bread_fixed animated moveup");
            }
            else{
                $(".breadcrumbs-wrap").removeClass("bread_fixed animated moveup");
            }

        });
    }
     if(($(window).width())<900){
        $('.peoples_wrap .peoples_right .cm_content.modi').insertAfter('.peoples_wrap .peoples_left ul li#modi img');
        $('.peoples_wrap .peoples_right .cm_content.kattar').insertAfter('.peoples_wrap .peoples_left ul li#kattar img');
        $('.peoples_wrap .peoples_right .cm_content.vipul_goyal').insertAfter('.peoples_wrap .peoples_left ul li#vipul_goyal img');
        $('.peoples_wrap .peoples_right .cm_content.tcgupta').insertAfter('.peoples_wrap .peoples_left ul li#tcgupta img');
        $('.peoples_wrap .peoples_right .cm_content.nehru').insertAfter('.peoples_wrap .peoples_left ul li#nehru img');
        $('body > div.whole_content_wrap > div:nth-child(5) > div > div.placement_right').insertBefore('body > div.whole_content_wrap > div:nth-child(5) > div > div.placement_left');
    }
    $(".peoples_left ul li").hover(function(){
        $(".peoples_left ul li").removeClass("active");
        $(this).addClass("active");
        var id = $(this).attr("id");
        $(".peoples_right .cm_content").removeClass("active");
        $(".peoples_right .cm_content."+id).addClass("active");
        if($(".peoples_left ul li:nth-child(5)").hasClass("active")){
            $(".peoples_left ul li:nth-child(3)").addClass("zindex2");
        }
        else{
            $(".peoples_left ul li:nth-child(3)").removeClass("zindex2");
        }
        if($(".peoples_left ul li:nth-child(1)").hasClass("active")){
            $(".peoples_left ul li:nth-child(2)").addClass("zindex4");
        }
        else{
            $(".peoples_left ul li:nth-child(2)").removeClass("zindex4");
        }
    });

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        var height = $(".banner_wrap").innerHeight();
        if(scroll > height){
            $(".breadcrumbs-wrap").addClass("bread_fixed animated moveup ");
        }
        else{
            $(".breadcrumbs-wrap").removeClass("bread_fixed animated moveup");
        }
    });

    $('.back-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1200);
        return false;
    });

    function scrollToStart(){
        $("#scrollToStart").click(function (){
            $('html, body').animate({
                scrollTop: $("#startHere").offset().top
            }, 2000);

        });
    };
    /**************popup**********/

    $(".video_pop").click(function(){
        $(".modal_box").fadeIn(function(){
            $(this).addClass("fadein");
        });
    });
    
    $(".close").click(function(){
        $(".modal_box,.modal_box1").fadeOut(function(){
            $(this).removeClass("fadein");
        });
        $('.modal_box iframe').attr('src', $('.modal_box iframe').attr('src'));
    });

    /**************End of popup**********/

    /**************Mobile menu**********/
    // $('.nav_main, #mobile_menu').on('click touchstart', function(event){
    //   event.stopPropagation();
    // });
    $("#mobile_menu").click(function(){
        $(".nav_main").addClass("right_slide");
    });

    $(".close_menu").click(function(){
        $(".nav_main").removeClass("right_slide");
    });

    // $(document).on('click touchstart', function () {
    //     $(".nav_main").removeClass("right_slide");
    // }


    $(window).on('load',function() {
        setTimeout(function(){ $('.logo_load').fadeOut() }, 800);
        // $('input[type="text"]').focus();
        $('input[type="email"]').focus();
        // $('input[type="date"]').focus();
        $('input[type="url"]').focus();
        // $('input[type="date"]').focus();
    });

    // $(".names li").click(function(){
    //     $(".names li").removeClass("active");
    //     $(this).addClass("active");
    //     var id = $(this).attr("id");
    //     $(".search_inputs_cn").removeClass("active");
    //     $(".search_inputs_cn."+id).addClass("active");
    // });

    $(".candidate_form_div input:not([type=radio]), .mentor_form_div input:not([type=radio]), .mentor_form_div input:not([type=checkbox]), .mentor_form_div textarea, .post_new_job_div input, .post_new_job_div textarea").focus(function(){
        $(this).parent().find("label").addClass('add');
        $(this).addClass('border');
      }).blur(function(){
        if($(this).val().trim()==""){
            $(this).parent().find("label").removeClass('add');
            $(this).removeClass('border');
        }
        else{
            $(this).parent().find("label").addClass('add');
            $(this).addClass('border');
        }
    });

    $(".sectors_list_main .sliding").click(function(){
        $(this).next("ul").slideToggle();
    });
      
    $(".search_sectorinput").focus(function(){
        $(".search_sector").slideDown();
      }).blur(function(){
        $(".search_sector").slideUp();
    });

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
       }
   }
    $(function(){
        $(".addClass").click(function () {
            $('#animate').addClass('popup-box-on');
        });

        $(".removeClass").click(function () {
            $('#animate').removeClass('popup-box-on');
        });
    })
    function myMap() {
        var mapOptions = {
            center: new google.maps.LatLng(51.5, -0.12),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.HYBRID
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    }
    // scroll body to 0px on click
    $('.back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1200);
        return false;
    });

    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop(); 
        if (scrollTop > 550) {
            $(".back-to-top").addClass("back-slide");
        }
        else if(scrollTop < 500){
            $(".back-to-top").removeClass("back-slide");
        }
    });

    // Admin Dashboard graph hide and show
    $(".sectorwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".sector_data_div").removeClass("active");
        $("#sectorwise_" + test).addClass("active");
    });

    $(".districtwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".district_data_div").removeClass("active");
        $("#Districtwise_" + test).addClass("active");
    });

    $(".malewise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".male_data_div").removeClass("active");
        $("#malewise_" + test).addClass("active");
    });

    $(".femalewise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".female_data_div").removeClass("active");
        $("#femalewise_" + test).addClass("active");
    });
    $(".Agriculturejobwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".Agriculturejob_data_div").removeClass("active");
        $("#Agriculturejobwise_" + test).addClass("active");
    });
    $(".BFSIjobwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".BFSIjob_data_div").removeClass("active");
        $("#BFSIjobwise_" + test).addClass("active");
    });
    $(".Electronicsjobwise_list li input").click(function() {
        var test = $(this).val();
        console.log("#Electronicsjobwise_" + test);
        $(".Electronicsjob_data_div").removeClass("active");
        $("#Electronicsjobwise_" + test).addClass("active");
    });
    $(".Telecomjobwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".Telecomjob_data_div").removeClass("active");
        $("#Telecomjobwise_" + test).addClass("active");
    });
    $(".Entrepreneurshipjobwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".Entrepreneurshipjob_data_div").removeClass("active");
        $("#Entrepreneurshipjobwise_" + test).addClass("active");
    });
    $(".Instrumentationjobwise_list li input").click(function() {
        var test = $(this).val();
        console.log(test);
        $(".Instrumentationjob_data_div").removeClass("active");
        $("#Instrumentationjobwise_" + test).addClass("active");
    });

    $('#colorselector').change(function(){
        $('.Job_by_role').removeClass("active");
        // $('#' + $(this).val()).addClass("active");
        $('#' + $(this).val()).addClass("active");
    });

    $('.sliderimg li img, .video_img li img').click(function() {
        var image = $(this).attr("alt");
        console.log(image);
        $(".image_load").html("<img src='/assets/images/popup/" + image + ".jpg' alt="+ image +" />");
        $(".modal_box1").fadeIn(function(){
            $(this).addClass("fadein");
        });
        // $(".image_load").load("/assets/images/carousel/" + image + ".jpg");
    });

});


