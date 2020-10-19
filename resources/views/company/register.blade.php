@extends('layouts.app')
@section('content')
<style>
    .process-model li.active, .process-model li.visited {
        color: #40afff;
    }
    .process-model li.active i, .process-model li.visited i {
        background: #fff;
        border-color: #016a84;
    }
    .process-model li.visited::after {
        background: #016a84;
    }
</style>
<div class="company_login_wrap comp_log" style="background: url({{asset('dist/img/images/building.jpg')}}) no-repeat;">
    <div class="company_login_container">
        <div class="company_login_div" style="max-width: 1214px">
            <div ng-controller="company_registration_controller">
                <div class="login_form_title" style="background: url({{asset('dist/img/images/login-bg.jpg')}}) no-repeat center;">
                    <span class="login100_form_title">
                        Company Registration
                    </span>
                </div>
                <form name="official_login" method="POST" action="{{ route('company.register.submit')}}" class="form-horizontal" id="company_register" enctype="multipart/form-data" style="padding: 30px;font-family: serif;">
                    {{ csrf_field()}}
                        <div class="form-group">
                            {!! Form::label('company Name', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('companyName') ? ' has-error' : ''}}">
                                {!! Form::text('companyName', null, ['class' => 'form-control','maxlength'=>'150','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','autocomplete'=>'off']) !!}
                                <span id="companyName1"></span>
                            </div>
                            {!! Form::label('company Email', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('email') ? ' has-error' : ''}}">
                                {!! Form::email('email', null, ['class' => 'form-control','maxlength'=>'70','minlength'=>'2','autocomplete'=>'off']) !!}
                                <span id="email1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Owner Name', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('ownerName') ? ' has-error' : ''}}">
                                {!! Form::text('ownerName', null, ['class' => 'form-control','pattern'=>'^[^-\s][a-zA-Z_\s-]+$','maxlength'=>'100','minlength'=>'2','onkeypress'=>'return lettersOnly(event)','placeholder'=>'Enter Company Owner Name','autocomplete'=>'off']) !!}
                                <span id="ownerName1"></span>
                            </div>
                            {!! Form::label('Contact No.', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('mobile') ? ' has-error' : ''}}">
                                {!! Form::text('mobile', null, ['class' => 'form-control','placeholder'=>'Enter Company Contact No.','minlength'=>'10','maxlength'=>'10','autocomplete'=>'off']) !!}
                                <span id="mobile1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Website', null, ['class' => 'col-sm-2 search_inputs control-label ']) !!}
                            <div class="col-sm-4 {{ $errors -> has('website') ? ' has-error' : ''}}">
                                {!! Form::text('website', null, ['class' => 'form-control','maxlength'=>'150','placeholder'=>'Enter Company Website','autocomplete'=>'off']) !!}
                                <span id="website1"></span>
                            </div>
                            {!! Form::label('State.', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('idState') ? ' has-error' : ''}}">
                                {!! Form::select('idState', states(),null, ['class' => 'form-control select2','placeholder'=>'Company Location','style'=>'border-radius: 8px;border: 1px solid #307dbd;width:100%']) !!}
                                <span id="state1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Location', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('location') ? ' has-error' : ''}}">
                                {!! Form::text('location', null, ['class' => 'form-control','maxlength'=>'150','placeholder'=>'Enter Company Location','autocomplete'=>'off']) !!}
                                <span id="location1"></span>
                            </div>
                            {!! Form::label('District.', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('idDisrtict') ? ' has-error' : ''}}">
                                {!! Form::select('idDistrict',[''=>'Select District'], null, ['class' => 'form-control select2','style'=>'width:100%']) !!}
                                <span id="district1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Password', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('password') ? ' has-error' : ''}}">
                                {!! Form::password('password', null, ['class' => 'form-control','maxlength'=>'100','minlength'=>'6','placeholder'=>'Enter Password','autocomplete'=>'off']) !!}
                                <span id="password1"></span>
                            </div>
                            {!! Form::label('Confirm Password', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('cpassword') ? ' has-error' : ''}}">
                                {!! Form::password('password_confirmation', null, ['class' => 'form-control','maxlength'=>'100','minlength'=>'6','placeholder'=>'Enter Confirm Password','autocomplete'=>'off']) !!}
                                <span id="cpassword1"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Company Profile', null, ['class' => 'col-sm-2 search_inputs control-label required']) !!}
                            <div class="col-sm-4 {{ $errors -> has('location') ? ' has-error' : ''}}">
                                {!! Form::textarea('companyProfile', null, ['placeholder'=>'Enter Company Profile.','cols'=>'40','rows'=>'8','style'=>'border-radius: 8px;border: 1px solid #307dbd;']) !!}
                                <span id="companyProfile1"></span>
                            </div>
                            {!! Form::label('Company Logo.', null, ['class' => 'col-sm-2 search_inputs control-label']) !!}
                            <div class="col-sm-4 {{ $errors -> has('idDisrtict') ? ' has-error' : ''}}">
                                <a onclick="document.getElementById('logo').click();">
                                    <div class="form-img text-center mgbt-xs-15" style="text-align:center;margin-top:5px"> <img style="border-radius: 8px; border-color:#21d4fd!important;border: 3px solid;width: 343px;height: 175px;" alt="example image" id="uploadPreview" name="logo" src="{{asset('dist/img/images/download.png')}}"> </div>
                                    <div class="form-img-action text-center mgbt-xs-20" style="text-align:center;">
                                        <input type="file" name="logo" id="logo" style="display:none;" onchange="PreviewImage();"> 
                                    </div>
                                </a>
                                <span id="logo1"></span>
                            </div>
                        </div>
                        <div class="company_login_form">
                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button type="submit" class="login100-form-btn">Register</button>
                            </div>
                        </div></div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="idState"]').on('change', function() {
        var stateID = $(this).val();
        if(stateID) {
            $.ajax({
                url: "{{url('/state/') }}"+'/' +stateID + "/districts",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="idDistrict"]').empty();
                    $('select[name="idDistrict"]').append('<option value="">--- Select District ---</option>');
                    $.each(data, function(key, value) {
                        $('select[name="idDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                }
            });
        }else{
            $('select[name="idDistrict"]').empty();
        }
    });
});
$('#company_register').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        });
     var formData =  new FormData($('#company_register')[0]);
        $.ajax({
            type:"POST",
            url: "{{url('company/register') }}",
            processData: false,
            contentType: false,
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){     //True Case i.e. passed validation
                window.location = "{{url('company')}}";
                }
                else {                  //False Case: With error msg
                $("#msg").html(data);   //$msg is the id of empty msg
                }
            },
            error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            console.log(errors);
                            var errorHtml = '<div class="alert alert-danger"><ul>';
                            $.each( errors, function( key, value ) {    
                               errorHtml += '<li>' + value + '</li>'; 
                            });
                            errorHtml += '</ul></div>';
                             $('#formerrors').html(errorHtml);
                            // });
                            // $.each( errors, function( key, value ) {
                            if(errors['companyName']=== undefined){
                                $( '#companyName1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['companyName']+'</strong></span>';
                               $( '#companyName1' ).html( errorname );
                            }
                            if(errors['ownerName']=== undefined){
                                $( '#ownerName1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['ownerName']+'</strong></span>';
                               $( '#ownerName1' ).html( errorname );
                            }
                            if(errors['email']=== undefined){
                                $( '#email1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['email']+'</strong></span>';
                               $( '#email1' ).html( errorname );
                            }
                            if(errors['mobile']=== undefined){
                                $( '#mobile1' ).empty();
                            }else{
                               errorname = '<span class="help-block"><strong>'+errors['mobile']+'</strong></span>';
                               $( '#mobile1' ).html( errorname );
                            }
                            if(errors['password']=== undefined){
                                $( '#password1' ).empty();
                            }else{
                               errorfname = '<span class="help-block"><strong>'+errors['password']+'</strong></span>';
                               $( '#password1' ).html( errorfname );
                            }
                            if(errors['logo']=== undefined){
                               $( '#logo1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['logo']+'</strong></span>';
                              $( '#logo1' ).html( erroraadhar );
                            }
                            if(errors['website']=== undefined){
                               $( '#website1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['website']+'</strong></span>';
                              $( '#website1' ).html( erroraadhar );
                            }
                            if(errors['companyProfile']=== undefined){
                               $( '#companyProfile1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['companyProfile']+'</strong></span>';
                              $( '#companyProfile1' ).html( erroraadhar );
                            }
                            if(errors['cpassword']=== undefined){
                               $( '#cpassword1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['cpassword']+'</strong></span>';
                              $( '#cpassword1' ).html( erroraadhar );
                            }
                            if(errors['location']=== undefined){
                               $( '#location1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['location']+'</strong></span>';
                              $( '#location1' ).html( erroraadhar );
                            }
                            if(errors['idState']=== undefined){
                               $( '#state1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['idState']+'</strong></span>';
                              $( '#state1' ).html( erroraadhar );
                            }
                            if(errors['idDistrict']=== undefined){
                               $( '#district1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['idDistrict']+'</strong></span>';
                              $( '#district1' ).html( erroraadhar );
                            }
                            if(errors['ownerName']=== undefined){
                               $( '#ownerName1' ).empty();
                            }else{
                              erroraadhar = '<span class="help-block"><strong>'+errors['ownerName']+'</strong></span>';
                              $( '#ownerName1' ).html( erroraadhar );
                            }
                        }
                        }
        });
        return false;
});
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("logo").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}

</script>
@stop