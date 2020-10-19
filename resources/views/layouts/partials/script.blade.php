<!--<script src="{{ asset('bower_components/jquery/dist/jquery.min.js ')}}"></script>--> 
<script src="{{ asset('dist/js/jquery_min_1_8_2.js ')}}"></script>
<!-- <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js ')}}"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>

<script src="{{ asset('bower_components/datatables.net/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jszip.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/vfs_fonts.js')}}"></script>

<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('dist/js/dataTables.responsive.min.js')}}"></script>
    <!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js ')}}"></script>
<!-- AdminLTE App -->

<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<!--<script src="{{ asset('dist/js/angular_min_1_6_9.js')}}"></script>-->
<script src="{{ asset('dist/js/canvasjs_min.js')}}"></script>
<script src="{{ asset('dist/js/chosen_jquery_min.js')}}"></script>
<!--<script src="{{ asset('dist/js/chosen_proto_min.js')}}"></script>-->
<!--<script src="{{ asset('dist/js/d3_min.js')}}"></script>-->
<script src="{{ asset('dist/js/jquery_cycle2_custom.js')}}"></script>
<script src="{{ asset('dist/js/jquery_flexslider_2_1.js')}}"></script>
<!--<script src="{{ asset('dist/js/jquery_min_1_8_2.js ')}}"></script>-->
<!--<script src="{{ asset('dist/js/ng_file_model.js')}}"></script>-->
<!--<script src="{{ asset('dist/js/notifications.js')}}"></script>-->
<!--<script src="{{ asset('dist/js/small_script.js')}}"></script>-->
<!--<script src="{{ asset('dist/js/main.js')}}"></script>-->
<script src="{{ asset('dist/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('dist/js/additional-methods.min.js')}}"></script>
<script>
$(function () {
    $('.select2').select2();
});
$(window).on('load',function() {
   $('.video_img').cycle({
        next: '#next1',
        prev: '#prev1',
        fx: '',
        timeout: 2000,
        slides: '> li',
        speed: 1000
    });
    
    $('.sliderimg').cycle({
        next: '#next',
        prev: '#prev',
        fx: '',
        timeout: 2000,
        slides: '> li',
        speed: 1000
    });
    
    if ($(window).width() >= 700) {
      $('#interactive').flexslider({
        animation: 'fade',
        directionNav: false,
        controlNav: true,
        slideshowSpeed: 2500,
        animationSpeed: 600
      });
    }
    
    var windowSize = $(window).width();
    if(windowSize > 700){
      $('#interactive-attoney').flexslider({
        animation:"slide", 
        directionNav:true, 
        controlNav:false, 
        slideshowSpeed:3500, 
        animationDuration:900, 
        pauseOnAction:false,
        minItems: 1,
        maxItems: 5,
        itemWidth: 221,
        asNavFor:"", 
        reverse:false, 
        animationLoop:true,
        move: 1
      });
    }
    
    // $('.treadmill').startTreadmill({
    //     runAfterPageLoad: true,
    //     direction: "down",
    //     speed: "medium",
    //     viewable: 4,
    //     pause: false
    // });
    
    $('#table1').DataTable({
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        'scrollCollapse': true,
    });  
});
$("#passedYear").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose: true, 
});
$('.datepicker').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy',
    todayBtn:true,
    todayHighlight:true,
    orientation: 'auto'
});
</script>
<script>
  //  ASCII Codes
function lettersOnly() 
    {
      var charCode = event.keyCode;
       //alert(charCode);
      if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 32)
        return true;
      else
        return false;
    }
function isNumber(evt) 
    {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
function isEmail(evt)
    {
      var status = false;     
      var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
         if (document.myform.email1.value.search(emailRegEx) == -1) {
              alert("Please enter a valid email address.");
         }
         else if (document.myform.email1.value != document.myform.email2.value) {
              alert("Please enter a valid email address.");
         }
         else {
              // alert("Woohoo!  The email address is in the correct format and they are the same.");
              status = true;
         }
         return status;
    }
function onlyNumbersandSpecialChar(evt) 
    {
        var e = window.event || evt;
        var charCode = e.which || e.keyCode;

        if (charCode > 31 && (charCode < 48 || charCode > 57 || charCode > 107 || charCode > 219 || charCode > 221) && charCode != 40 && charCode != 32 && charCode != 41 && (charCode < 43 || charCode > 46)) {
            if (window.event) //IE
                window.event.returnValue = false;
            else //Firefox
                e.preventDefault();
        }
        return true;

    }
function onlylettersandSpecialChar() 
    {
     var charCode = event.keyCode;
      if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 40 || charCode == 41 || charCode == 32 ||charCode ==92 || charCode == 45 || charCode ==124)
          return true;
      else
          return false;
    }
function isAlphaNumeric(e)
    { // Alphanumeric only
      var k;
      document.all ? k=e.keycode : k=e.which;
      return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0);
    }
function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 32 && charCode > 31 && charCode != 45
        && (charCode < 48 || charCode > 57))
         return false;

      return true;
    }
function checkDec(el)
    {
     var ex = /^[0-9]+\.?[0-9]*$/;
     if(ex.test(el.value)==false)
      {
        el.value = el.value.substring(0,el.value.length - 1);
      }
    }
</script>