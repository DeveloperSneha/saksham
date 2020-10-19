<script>
$("#sameas").change(function() {
    if(this.checked) {
        $("#idState").val($("#tempState option:selected").val());
        
        var tmpdis = $("#tempDistrict option:selected").val();
        $("#idDistrict").empty();
        $("#idDistrict").append('<option value="'+tmpdis+'">'+$("#tempdisId"+ $("#tempDistrict option:selected").val()).text()+'</option>');
        
        var tmpsubdis = $("#tempSubDistrict option:selected").val();
        $("#idSubDistrict").empty();
        $("#idSubDistrict").append('<option value="'+tmpsubdis+'">'+$("#tempsubId"+ $("#tempSubDistrict option:selected").val()).text()+'</option>');
      
        $("#address").val($("#tempAddress").val());
        $("#pincode").val($("#tempPincode").val());
        
        // then form will be automatically filled .. 
    }
    else{
        $("#idState").val('');
        $("#address").val('');
        $("#idDistrict").val('');
        $("#idSubDistrict").val('');
        $("#pincode").val('');
    }
});
function getExistingCandidateWithAadhar(element){
    $( '#aadharabc1' ).empty();
    var aadharno = $('#candidate_aadhar').val();
    $.ajax({
            type:"GET",
            url: "{{url('candidate/existaadhar') }}",
            data: {aadhar:aadharno},
            dataType: 'json',
            success:function(data){
                if(data!=null){
                   $( '#aadharrexist' ).empty();
                   errorname = '<span class="help-block"><strong>Aadhar No has Already been Taken.</strong></span>';
                   $( '#aadharrexist' ).html(errorname);
                }else{
                   $( '#aadharrexist' ).empty();
                }
            },
            error: function(data){
                var errors = data.responseJSON.errors;
                console.log(errors);
                if(errors['aadharabc']=== undefined){
                    $( '#aadharabc1' ).empty();
                }else{
                   erroraadhar = '<span class="help-block"><strong>'+errors['aadharabc']+'</strong></span>';
                   $( '#aadharabc1' ).html( erroraadhar );
                }
            }
        });
}
function getExistingCandidateWithMobile(element){
    $( '#mobile1' ).empty();
    $( '#mobilenoexist' ).empty();
    var mobileno = $('#candidate_mobile').val();
    $.ajax({
            type:"GET",
            url: "{{url('candidate/existmobile') }}",
            data: {mobile:mobileno},
            dataType: 'json',
            success:function(data){
                if(data!=null){
                   $( '#mobilenoexist' ).empty();
                   errorname = '<span class="help-block"><strong>Mobile No has Already been Taken</strong></span>';
                   $('#mobilenoexist' ).html(errorname);
                }else{
                   $('#mobilenoexist' ).empty();
                }
            }
        });
}
$(document).ready(function() {
    var v = $('#enrol').validate({
    rules:{
        passord_confirmation: {
                    equalTo:"#password"
                }
    },
    messages:{
        passord_confirmation :{
            equalTo :"Password & Confirm Password is Not Same"
        }
    }
});
$("select").on("select2:close", function (e) {  
    $(this).valid();   
});
$("#next1").click(function() {
    if (v.form()) {
        $("#progressbar li#first").addClass("visited");
        $(".frm").hide("fast");
        $("#sf2").show("slow");
        $("#progressbar li#second").addClass("active");
    }
});

$("#next2").click(function() {
    if (v.form()) {
        $("#progressbar li#second").addClass("visited");
        $(".frm").hide("fast");
        $("#sf3").show("slow");
        $("#progressbar li#third").addClass("active");
    }
});

$("#next3").click(function() {
    if (v.form()) {
        $("#progressbar li#third").addClass("visited");
        $(".frm").hide("fast");
        $("#sf4").show("slow");
        $("#progressbar li#fourth").addClass("active");
    }
});

$(".back2").click(function() {
  $(".frm").hide("fast");
  $("#sf1").show("slow");
  $("#progressbar li#first").removeClass("visited");
  $("#progressbar li#second").removeClass("active");
});

$(".back3").click(function() {
  $(".frm").hide("fast");
  $("#sf2").show("slow");
  $("#progressbar li#second").removeClass("visited");
  $("#progressbar li#third").removeClass("active");
});

$(".back4").click(function() {
  $(".frm").hide("fast");
  $("#sf3").show("slow");
  $("#progressbar li#third").removeClass("visited");
  $("#progressbar li#fourth").removeClass("active");
});

$('select[name="tempState"]').on('change', function() {
    var stateID = $(this).val();
    if(stateID) {
        $.ajax({
            url: "{{url('/state/') }}"+'/' +stateID + "/districts",
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="tempDistrict"]').empty();
                $('select[name="tempSubDistrict"]').empty();
                $('select[name="tempDistrict"]').append('<option value="">--- Select District ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="tempDistrict"]').append('<option id="tempdisId'+ key +'" value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    }else{
        $('select[name="tempDistrict"]').empty();
    }
});

$('select[name="idState"]').on('change', function() {
    var stateID = $(this).val();
    if(stateID) {
        $.ajax({
            url: "{{url('/state/') }}"+'/' +stateID + "/districts",
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="idDistrict"]').empty();
                $('select[name="idSubDistrict"]').empty();
                $('select[name="idDistrict"]').append('<option value="">--- Select District ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="idDistrict"]').append('<option  value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else{
        $('select[name="idDistrict"]').empty();
    }
});

$('select[name="tempDistrict"]').on('change', function() {
    var districtID = $(this).val();
    if(districtID) {
        $.ajax({
            url: "{{url('/district/') }}"+'/' +districtID + "/subdistricts",
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="tempSubDistrict"]').empty();
                $('select[name="tempSubDistrict"]').append('<option value="">--- Select Tehsil ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="tempSubDistrict"]').append('<option id="tempsubId'+ key +'" value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    }else{
        $('select[name="tempSubDistrict"]').empty();
    }
});
$('select[name="idDistrict"]').on('change', function() {
    var districtID = $(this).val();
    if(districtID) {
        $.ajax({
            url: "{{url('/district/') }}"+'/' +districtID + "/subdistricts",
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="idSubDistrict"]').empty();
                $('select[name="idSubDistrict"]').append('<option value="">--- Select Tehsil ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="idSubDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    }else{
        $('select[name="idSubDistrict"]').empty();
    }
});

$('select[name="idSector"]').on('change', function() {
    var sectorID = $(this).val();
    if(sectorID) {
        $.ajax({
            url: "{{url('/sector/') }}"+'/' +sectorID + "/jobrole",
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="idJobRole"]').empty();
                $('select[name="idJobRole"]').append('<option value="">--- Select Job Role ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="idJobRole"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    }else{
        $('select[name="idJobRole"]').empty();
    }
});
    // Qualification Row
    var i = 1;
    $(".add-edu-row").click(function(){
        i++;  
        var markup = '<tr><td class="sno">'+i+'</td>\
            <td style="width:150px;"><select name="qualifications['+i+'][idQualification]"  class = "form-control col-sm-3 select2">@foreach(getQualifications() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\
            <td style="width:150px;"><select name="qualifications['+i+'][idState]"  class = "form-control col-sm-3 select2" id = "qualstate_'+i+'" onchange="getDistricts('+i+')">@foreach(states() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\n\
            <td style="width:150px;"><select name="qualifications['+i+'][idUniversity]"  class = "form-control col-sm-3 select2" id = "qualuniversity_'+i+'"><option value="">-- Select University / Board--</option></select></td>\n\
            <td style="width:150px;"><select name="qualifications['+i+'][idDistrict]"  class = "form-control col-sm-3 select2" id = "qualdistrict_'+i+'"><option value="">-- Select District--</option></select></td>\n\
            <td style="width:60px;"><input type="text" name="qualifications['+i+'][passedYear]" class = "form-control col-sm-3 datepicker" id="passedYear"></td>\n\
            <td style="width:100px;"><select name="qualifications['+i+'][idMedium]"  class = "form-control col-sm-3 select2">@foreach(getMedium() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\n\
            <td style="width:65px;"><input type="text" name="qualifications['+i+'][percentage]" class="form-control" style="width:65px;"></td>\n\
            <td style="text-align:right;vertical-align: middle;"><input type="button" required="required" class="btn btn-xs btn-danger" value="Delete" id="remove_row"></td></tr>';
            setTimeout(function(){
                $('.select2').select2();
            }, 100);
            setTimeout(function(){                
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayBtn:true,
                    todayHighlight:true,
                    orientation: 'auto'
                  });
                $("#passedYear").datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years",
                    autoclose: true,
                });
            }, 100);
            $("#qual_list").append(markup);
    });
    $('#qual_list').on('click', 'input[type="button"]', function () {
        $(this).closest('tr').remove();
         i = $('.sno:last').text();
         
    });
});

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}

function getDistricts(stateid){
    var state = $('#qualstate_'+stateid).val();
    if(state){
        $.ajax({
                url: "{{url('/state/') }}"+'/' +state + "/districts",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="qualdistrict_'+stateid+'"]').empty();
                    $('select[id="qualdistrict_'+stateid+'"]').append('<option value="">--- Select District ---</option>');
                    $.each(data, function(key, value) {
                        $('select[id="qualdistrict_'+stateid+'"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
        });
    }else{
        $('select[id="qualdistrict_'+stateid+'"]').empty();
    }
    var stateId = $('#qualstate_'+stateid).val();
    if(stateId){
        $.ajax({
                url: "{{url('/state/') }}"+'/' +stateId + "/university",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="qualuniversity_'+stateid+'"]').empty();
                    $('select[id="qualuniversity_'+stateid+'"]').append('<option value="">--- Select University/Board ---</option>');
                    $.each(data, function(key, value) {
                        $('select[id="qualuniversity_'+stateid+'"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
        });
    }else{
        $('select[id="qualuniversity_'+stateid+'"]').empty();
    }
}

$('#enrol').on('submit',function(e){
    $.ajaxSetup({
    header:$('meta[name="_token"]').attr('content')
});
var formData =  new FormData($('#enrol')[0]);
   $.ajax({
       type:"POST",
       url: "{{url('candidate/register') }}",
       processData: false,
       contentType: false,
       data:formData,
       dataType: 'json',
       success:function(data){
          if( data[Object.keys(data)[0]] === 'SUCCESS' ){     //True Case i.e. passed validation
              window.location = "{{url('candidate/login')}}";
          }
          else {                  //False Case: With error msg
            $("#msg").html(data);   //$msg is the id of empty msg
          }
      },

        error: function(data){
                  // e.preventDefault(e);
            if( data.status === 422 ) {
                   var errors = data.responseJSON.errors;
                   var errorHtml = '<div class="alert alert-danger"><ul>';
                   $.each( errors, function( key, value ) {    
                      errorHtml += '<li>' + value + '</li>'; 
                   });
                   errorHtml += '</ul></div>';
                   $('#formerrors').html(errorHtml);
            }
        }
   });
   return false;
});
</script>