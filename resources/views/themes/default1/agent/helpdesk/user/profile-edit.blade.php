@extends('themes.default1.agent.layout.agent')

@section('Dashboard')
class="nav-link active"
@stop

@section('dashboard-bar')
active
@stop

@section('profile')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.edit-profile') }}</h1>
@stop

@section('content')

@if(session()->has('success1'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <b>Success</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success1') }}
</div>
@endif
<!-- fail message -->
@if(session()->has('fails1'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>Fail!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails1') }}
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <b>Success</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- fail message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>Fail!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
@if(session()->has('errors'))
<?php //dd($errors); ?>

<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('first_name'))
    <li class="error-message-padding">{!! $errors->first('first_name', ':message') !!}</li>
    @endif
    @if($errors->first('mobile'))
    <li class="error-message-padding">{!! $errors->first('mobile', ':message') !!}</li>
    @endif
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <form method="POST">
    @csrf
    @method('PATCH')
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">
                    {{ trans('lang.profile') }}
                </h3>
            </div>
            <div class="card-body">
                <!-- first name -->
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    {!! Form::label('first_name',trans('lang.first_name')) !!} <span class="text-red"> *</span>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control">
                </div>
                <!-- last name -->
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    {!! Form::label('last_name',trans('lang.last_name')) !!}
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control">
                </div>
                <!-- gender -->
                <div class="form-group">
                    {!! Form::label('gender',trans('lang.gender')) !!}
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="radio" name="gender" value="'1'"> {{ trans('lang.male') }}
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="gender" value="'0'"> {{ trans('lang.female') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- email address -->
                    {!! Form::label('email',trans('lang.email_address')) !!}
                    <div>
                        {{$user->email}}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                    <!-- company -->
                    {!! Form::label('company',trans('lang.company')) !!}
                    <input type="text" name="company" id="company" value="{{ old('company') }}" class="form-control">
                </div>
                <div class="row">
                    <!-- phone extension -->
                    <div class="col-sm-2 form-group {{ session()->has('country_code_error') ? 'has-error' : '' }}">
                        {!! Form::label('country_code',trans('lang.country-code')) !!}
                        <input type="text" name="country_code" id="code" value="{{ old('country_code') }}" class="form-control">
                    </div>
                    <!-- phone number -->
                    <div class="col-sm-8 form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                        {!! Form::label('phone_number',trans('lang.phone')) !!}
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control">
                    </div>
                    <div class="col-sm-2 form-group {{ $errors->has('ext') ? 'has-error' : '' }}">
                        {!! Form::label('ext',trans('lang.ext')) !!}
                        <input type="text" name="ext" id="ext" value="{{ old('ext') }}" class="form-control">
                    </div>
                </div>
                <!-- mobile -->
                <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                    {!! Form::label('mobile',trans('lang.mobile_number')) !!}
                    {!! Form::input('number', 'mobile',null,['class' => 'form-control', 'id' => 'mobile']) !!}
                </div>
                <div class="form-group {{ $errors->has('agent_sign') ? 'has-error' : '' }}">
                    {!! Form::label('agent_sign',trans('lang.agent_sign')) !!}
                    <textarea name="agent_sign" id="agent_sign" class="form-control">{{ old('agent_sign') }}</textarea>
                </div>
                <div class="form-group {{ $errors->has('profile_pic') ? 'has-error' : '' }}">
                    <!-- profile pic -->
                    <div type="file" class="btn btn-default btn-file" style="color:orange">
                        <i class="fa fa-user"> </i>
                        {!! Form::label('profile_pic',trans('lang.profile_pic'),['style'=>'font-weight:400;margin-bottom:0px;']) !!}
                        <input type="file" name="profile_pic" id="profile_pic" class="form-file">
                    </div>
                </div>
                @csrf
                </form>
            </div>
            <div class="card-footer">
                {!! Form::submit(trans('lang.update'),['class'=>'btn btn-primary'])!!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <form method="POST">
    @csrf
    @method('PATCH')
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.change_password') }}</h3> 
            </div>
            <div class="card-body pb-0">
                <!-- old password -->
                <div class="form-group has-feedback {{ $errors->has('old_password') ? 'has-error' : '' }}">
                    {!! Form::label('old_password',trans('lang.old_password')) !!} <span class="text-red"> *</span>
                    <input type="password" name="old_password" id="old_password" class="form-control">
                    {!! $errors->first('old_password', '<spam class="help-block">:message</spam>') !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback" style="float: right;top: -46px;left: -10px;"></span>
                </div>
                <!-- new password -->
                <div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
                    {!! Form::label('new_password',trans('lang.new_password')) !!} <span class="text-red"> *</span>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                    {!! $errors->first('new_password', '<spam class="help-block">:message</spam>') !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback" style="float: right;top: -46px;left: -10px;"></span>
                </div>
                <!-- confirm password -->
                <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                    {!! Form::label('confirm_password',trans('lang.confirm_password')) !!} <span class="text-red"> *</span>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    {!! $errors->first('confirm_password', '<spam class="help-block">:message</spam>') !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback" style="float: right;top: -46px;left: -10px;"></span>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit(trans('lang.update'),['class'=>'btn btn-primary'])!!}
            </div>
        </div>
    </div>
</div>
</form>
<!-- Modal for last step of setting -->
<div class="modal fade" id="last-modal">
    <div class="modal-dialog" role="document">
        <div class="col-md-2"></div>
        <div class="col-md-12" style="height:40%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('lang.verify-number') }}</h4> 
                    <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div id="custom-alert-body2">
                        <div class="row">
                            <div class="col-md-12">
                            <div id="loader2" style="display:none">
                                <center><img src="{{asset('lb-faveo/media/images/gifloader.gif')}}"></center>
                            </div>
                            <div id="verify-success" style="display:none" class="alert alert-success alert-dismissable">
                                <i class="fa  fa-check-circle"> </i>
                                <span id = "success_message"></span>
                            </div>
                            <div id="verify-fail" style="display:none" class="alert alert-danger alert-dismissable">
                                <i class="fa fa-ban"> </i> <b> {{ trans('lang.alert') }}! </b>
                                <span id = "error_message"></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div id="verify-number-form">
                    <form method="POST">
    @csrf
                        <div class="row">
                            <div class="col-md-8">
                                {{ trans('lang.get-verify-message') }}
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="token" id="otp" value="''" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="close-last" class="btn btn-default closemodal">{{ trans('lang.close') }}</button>
                    <div id="last-submit"><input  type="submit" id="merge-btn" class="btn btn-primary" value="{{ trans('lang.verify') }}"></input></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
<script>
    $(function() {
        $("textarea").wysihtml5();
    });
</script>
@if($verify == 1 || $verify == '1')
<script type="text/javascript">
$('#agent-profile').on('submit', function(e){
    var old_mobile = "<?php echo $user->mobile;?>";
    var email = "<?php echo $user->email;?>";
    var full_name = "<?php echo $user->first_name; ?>";
    var mobile = document.getElementById('mobile').value;
    var code = document.getElementById('code').value;
    if (code == '' || code == null) {
            //do nothingalert
    } else {
        var id = "<?php echo $user->id; ?>";
        if (mobile !== old_mobile) {
            e.preventDefault();
            $('#last-modal').css('display', 'block');
            $.ajax({                    
                url: '{{URL::route("agent-verify-number")}}',     
                type: 'post', // performing a POST request
                data : {
                    mobile : mobile,
                    full_name: full_name,
                    email: email,
                    code: code // will be accessible in $_POST['data1']
                },
                dataType: 'json', 
                beforeSend: function() {
                    $('#loader2').css('display', 'block');
                    $('#verify-number-form').css('display', 'none');
                    $('#verify-fail').css('display', 'none');
                    $('verify-success').css('display', 'none');
                },
                success: function(response) {
                    $('#loader2').css('display', 'none');
                    $('#verify-number-form').css('display', 'block');
                    $('#verify-otp').on('submit', function(e){
                        e.preventDefault();
                        var otp = document.getElementById('otp').value;
                        $.ajax({
                            url: '{{URL::route("post-agent-verify-number")}}',
                            type: 'POST',
                            data: {
                                otp: otp,
                                u_id: id,
                            },
                            dataType: 'html',
                            beforeSend: function(){
                                $('#loader2').css('display', 'block');
                                $('#verify-number-form').css('display', 'none');
                                $('#verify-fail').css('display', 'none');
                                $('verify-success').css('display', 'none');
                            },
                            success: function(response){
                                if( response == 1) {
                                    $('#loader2').css('display', 'none');
                                    var message = "{{ trans('lang.number-verification-sussessfull') }}";
                                    $('#success_message').html(message);
                                    $('#verify-success').css('display', 'block');
                                    $('#agent-profile').unbind('submit').submit();
                                } else {
                                    $('#loader2').css('display', 'none');
                                    $("#error_message").html(response);
                                    $('#verify-fail').css('display', 'block');
                                    $('#verify-number-form').css('display', 'block');
                                }
                            }
                        });
                    });
                },
                complete: function( jqXHR, textStatus) {
                    if (textStatus === "parsererror" || textStatus === "timeout" || textStatus === "abort" || textStatus === "error") {
                        var message = "{{ trans('lang.otp-not-sent') }}";
                        $('#loader2').css('display', 'none');
                        $("#error_message").html(message);
                        $("#merge-btn").css('display', 'none');
                        $('#verify-fail').css('display', 'block');
                    }
                }
            });
        }
          
    }
});
$('.closemodal').on('click', function(){
    $('#last-modal').css('display', 'none');
});
</script>
@endif
@stop