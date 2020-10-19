@extends('company.company_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Change Jobs Location: <span class="font-semibold">{{ $job_details->company->companyName}}</span></div>
    <div class="panel-body" style="margin-top: 10px!important;">
        {!! Form::open(['method' => 'POST',  'action' => ['Company\JobController@updateLoc',$job_details->idJob], 'class' => 'form-horizontal']) !!}
            <div class="row">
                <strong><legend><center style="margin-top: 25px;margin-bottom: 5px;font-size: 25px;">Change Jobs Location</center></legend></strong>
                <table class="table table-bordered" id='location'>
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>State</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sn = 1; ?>
                        @foreach($jobloc as $loc)
                        <tr>
                            <td class="sno">{{$sn}}<input type="hidden" name='idJobLocation' value="{{$loc->idJobLocation}}"></td>
                            <td>
                                {!! Form::select('joblocation['.$sn.'][idState]',states(),isset($loc) ? $loc->idState: null, ['class' => 'form-control','id'=>'idState'.$sn.'','onchange'=>'getDistricts('.$sn.')']) !!}
                                <span class="help-block">
                                    <strong>
                                        @if($errors->has('idState'))
                                        <p>{{ $errors->first('idState') }}</p>
                                        @endif
                                    </strong>
                                </span>
                            </td>
                            <td>
                                {!! Form::select('joblocation['.$sn.'][idDistrict]',districts(),isset($loc) ? $loc->idDistrict: null, ['class' => 'form-control','id'=>'idDistrict'.$sn.'']) !!}
                                <span class="help-block">
                                    <strong>
                                        @if($errors->has('idDistrict'))
                                        <p>{{ $errors->first('idDistrict') }}</p>
                                        @endif
                                    </strong>
                                </span>
                            </td>
                        </tr>
                        <?php $sn++; ?>
                        @endforeach
                    </tbody>
                </table>
                <div style="text-align: right;margin-bottom: 20px;margin-right: 16%;float: right;"><input type="button" class="add-row btn btn-primary" value="Add Row"></div>
                <div class="col-sm-12" style="text-align: center;">
                    <button class="post_new_job_button" type="submit" style="width:300px">Update Job</button>
                </div>
            </div>
        {!! Form::close() !!}    
    </div>
</div>
@stop
@section('script')
<script>
    function getDistricts(stateid){
            var state = $('#idState'+stateid).val();
            if(state){
                $.ajax({
                        url: "{{url('/states/') }}"+'/' +state + "/districts",
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[id="idDistrict'+stateid+'"]').empty();
                            $('select[id="idDistrict'+stateid+'"]').append('<option value="">--- Select District ---</option>');
                            $.each(data, function(key, value) {
                                $('select[id="idDistrict'+stateid+'"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                });
            }else{
                $('select[id="idDistrict'+stateid+'"]').empty();
            }
        } 
    $(document).ready(function(){    
        $(".add-row").click(function(){
            // console.log($('.sno').length);
            var i =$('.sno').length;
                i++;  
                var markup = '<tr><td class="sno">'+i+'<input type="hidden" name="idJobLocation" value="{{$loc->idJobLocation}}"></td>\
                        <td><select name="joblocation['+i+'][idState]"  id="idState'+i+'" class = "form-control col-sm-3 select2" onchange="getDistricts('+i+')">@foreach(states() as $key=>$value)<option value="{{$key}}">{{$value}}</option>@endforeach</select></td>\
                        <td><select name="joblocation['+i+'][idDistrict]"  class = "form-control col-sm-3 select2" id="idDistrict'+i+'"></select><span id="idDistrict'+i+'"></span></td>\n\
                        <td style="text-align:right;"><button class="btn  btn-xs btn-danger" id="remove_row" style="border-radius:50%;"><i class="fa fa-close"></i></button></td>';
                $("#location tbody").append(markup);
        });
        $('#location').on('click', '#remove_row', function () {
            $(this).closest('tr').remove();
            i = $('.sno:last').text();                 
        });  
             
    });
</script>
@stop
