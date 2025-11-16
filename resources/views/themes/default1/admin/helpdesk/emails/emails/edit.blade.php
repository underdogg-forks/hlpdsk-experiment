@extends('themes.default1.admin.layout.admin')

@section('Emails')
class="nav-link active"
@stop

@section('email-menu-parent')
class="nav-item menu-open"
@stop

@section('email-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('emails')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.edit_an_email') }}</h1>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
<ol class="breadcrumb">
</ol>
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')
<!-- open a form -->
<form method="POST">
    @csrf

<div id="head"></div>
<div id="alert" style="display:none;">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="alert-message"></div>
    </div>
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="card card-light">

    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.email_information_and_settings') }}</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- email address -->
            <div class="col-sm-6 form-group {{ $errors->has('email_address') ? 'has-error' : '' }}" id="email_address_error">
                <label for="email_address">{{ trans('lang.email_address') }}</label> <span class="text-red"> *</span>
                {!! $errors->first('email_address', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="email_address" id="email_address" value="{{ old('email_address') }}" class="form-control">
            </div>
            <!-- user name -->
            <div class="col-sm-6 form-group {{ $errors->has('user_name') ? 'has-error' : '' }}" id="user_name_error">
                <label for="user_name">{{ trans('lang.user_name') }}</label>
                {!! $errors->first('user_name', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" class="form-control">
            </div>
            <!-- Email name -->
            <div class="col-sm-6 form-group {!! $errors->has('email_name') ? 'has-error' : ''!!}" id="email_name_error">
                <label for="email_name">{{ trans('lang.from_name') }}</label> <span class="text-red"> *</span>
                {!! $errors->first('email_name', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="email_name" id="email_name" value="{{ old('email_name') }}" class="form-control">
            </div>
            <!-- password -->
            <div class="col-sm-6 form-group {!! $errors->has('password') ? 'has-error' : ''!!}" id="password_error">
                <label for="password">{{ trans('lang.password') }}</label> <span class="text-red"> *</span>
                {!! $errors->first('password', '<spam class="help-block">:message</spam>') !!}
                <input type="password" name="password" class="form-control" id="password">
            </div>
        </div>

        <div class="card card-light">
            
            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.new_ticket_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- department -->
                    <div class="col-sm-4 form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                        <label for="department">{{ trans('lang.department') }}</label>
                        {!! $errors->first('department', '<spam class="help-block">:message</spam>') !!}
                        <select name="department" id="department" class="form-control select">
    @foreach([''=>'--System Default--','departments'=>$departments->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div>
                    <!-- priority -->
                    <div class="col-sm-4 form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                        <label for="priority">{{ trans('lang.priority') }}</label>
                        {!! $errors->first('priority', '<spam class="help-block">:message</spam>') !!}
                        <select name="priority" id="priority" class="form-control select">
    @foreach([''=>'--System Default--','Priorities'=>$priority->pluck('priority_desc','priority_id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div>
                    <!-- help topic -->
                    <div class="col-sm-4 form-group {{ $errors->has('help_topic') ? 'has-error' : '' }}">
                        <label for="help_topic">{{ trans('lang.help_topic') }}</label>
                        {!! $errors->first('help_topic', '<spam class="help-block">:message</spam>') !!}
                        <select name="help_topic" id="help_topic" class="form-control select">
    @foreach([''=>'--System Default--','Help Topics'=>$helps->pluck('topic','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div>
                    <!-- status -->
                    <div class="col-sm-2 form-group">
                        <label for="auto_response">{{ trans('lang.auto_response') }}</label>
                    </div>
                    <div class="col-sm-3 form-group">
                        <input type="checkbox" name="auto_response" id="auto_response" <?php
                        if ($emails->auto_response == 1) {
                            echo "checked='checked'";
                        }
                        ?>> {{ trans('lang.disable_for_this_email_address') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-light">
            
            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.incoming_email_information') }}</h3>
            </div>
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <!-- status -->

                        <label for="fetching_status">{{ trans('lang.status') }}</label>
                        <input type="checkbox" name="fetching_status" id="fetching_status"  <?php
                            if ($emails->fetching_status == 1) {
                                echo "checked='checked'";
                            }
                            ?>> {{ trans('lang.enable') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 form-group {!! $errors->has('fetching_protocol') ? 'has-error' : ''!!}" id="fetching_protocol_error">
                        <label for="fetching_protocol">{{ trans('lang.fetching_protocol') }}</label>
                        {!! $errors->first('fetching_protocol', '<spam class="help-block">:message</spam>') !!}
                        <select name="fetching_protocol" id="fetching_protocol" class="form-control select">
    @foreach(['imap' => 'IMAP', 'pop' => 'POP3'] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div>
                    <div class="col-sm-2 form-group  {!! $errors->has('fetching_host') ? 'has-error' : ''!!}" id="fetching_host_error">
                        <label for="fetching_host">{{ trans('lang.host_name') }}</label>
                        {!! $errors->first('fetching_host', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="fetching_host" id="fetching_host" value="{{ old('fetching_host') }}" class="form-control">
                    </div>
                    <div class="col-sm-2 form-group {!! $errors->has('fetching_port') ? 'has-error' : ''!!}" id="fetching_port_error">
                        <label for="fetching_port">{{ trans('lang.port_number') }}</label>
                        {!! $errors->first('fetching_port', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="fetching_port" id="fetching_port" value="{{ old('fetching_port') }}" class="form-control">
                    </div>
                    <div class="col-sm-2 form-group {!! $errors->has('fetching_encryption') ? 'has-error' : ''!!}" id="fetching_encryption_error">
                        <label for="fetching_encryption">{{ trans('lang.encryption') }}</label>
                        {!! $errors->first('fetching_encryption', '<spam class="help-block">:message</spam>') !!}
                        <select name="fetching_encryption" class='form-control'  id='fetching_encryption'>
                            <option value=""> -----Select----- </option>
          
                            <option <?php
                            if ($emails->fetching_encryption == 'ssl' || $emails->fetching_encryption === 'ssl') {
                                echo 'selected="selected"';
                            }
                            ?> value="ssl">SSL</option>
                            <option <?php
                            if ($emails->fetching_encryption == 'tls' || $emails->fetching_encryption === 'tls') {
                                echo 'selected="selected"';
                            }
                            ?> value="tls">TLS</option>
                            <option <?php
                            if ($emails->fetching_encryption == 'starttls' || $emails->fetching_encryption === 'starttls') {
                                echo 'selected="selected"';
                            }
                            ?> value="starttls">STARTTLS</option>
                        </select>
                    </div>
                    <div class="col-sm-2 form-group {!! $errors->has('imap_authentication') ? 'has-error' : ''!!}" id="imap_authentication_error">
                        <label for="fetching_authentication">{{ trans('lang.authentication') }}</label>
                        <select name="imap_authentication" id="imap_authentication" class="form-control select">
    @foreach(['normal' => 'Normal Password'] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div>
                    <div class="col-sm-2 form-group">
                        <br>
                        <input type="checkbox" name="imap_validate" id="imap_validate">&nbsp; {{ trans('lang.validate_certificates_from_tls_or_ssl_server') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-light">
                        
            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.outgoing_email_information') }}</h3>
            </div>
            <div class="card-body">
                <div>
                    <!-- status -->
                    <div class="form-group">
                         <label for="sending_status">{{ trans('lang.status') }}</label> 
                         <input type="checkbox" name="sending_status" id="sending_status" <?php
                            if ($emails->sending_status == 1) {
                                echo "checked='checked'";
                            }
                            ?>> {{ trans('lang.enable') }}  
                    </div>
                </div>
                <div class="row">
                    <!-- Encryption -->
                    <div class="col-sm-2 form-group {!! $errors->has('sending_protocol') ? 'has-error' : ''!!}" id="sending_protocol_error">
                        <label for="sending_protocol">{{ trans('lang.transfer_protocol') }}</label>
                        {!! $errors->first('sending_protocol', '<spam class="help-block">:message</spam>') !!} 
                        {!!Form::select('sending_protocol',[''=>'Select','Drives'=>$services],$emails->getCurrentDrive(),['class' => 'form-control select','id'=>'service']) !!}
                    </div> 
                    <!-- sending hoost -->
                    <div class="col-sm-2 form-group {!! $errors->has('sending_host') ? 'has-error' : ''!!}" id="sending_host_error">
                        <label for="sending_host">{{ trans('lang.host_name') }}</label>
                        {!! $errors->first('sending_host', '<spam class="help-block">:message</spam>') !!} 
                        <input type="text" name="sending_host" id="sending_host" value="{{ old('sending_host') }}" class="form-control">
                    </div> 
                    <!-- sending port -->
                    <div class="col-sm-2 form-group {!! $errors->has('sending_port') ? 'has-error' : ''!!}" id="sending_port_error">
                        <label for="sending_port">{{ trans('lang.port_number') }}</label>
                        {!! $errors->first('sending_port', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="sending_port" id="sending_port" value="{{ old('sending_port') }}" class="form-control">
                    </div>
                    <!-- Encryption -->
                    <div class="col-sm-2 form-group {!! $errors->has('sending_encryption') ? 'has-error' : ''!!}" id="sending_encryption_error">
                        <label for="sending_encryption">{{ trans('lang.encryption') }}</label>
                        {!! $errors->first('sending_encryption', '<spam class="help-block">:message</spam>') !!} 
                        <select name="sending_encryption" id="sending_encryption" class="form-control select">
    @foreach([''=>'-----Select-----','ssl' => 'SSL', 'tls' => 'TLS', 'starttls' => 'STARTTLS'] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div> 
                    <div class="col-sm-2 form-group {!! $errors->has('smtp_authentication') ? 'has-error' : ''!!}" id="smtp_authentication_error">
                        <label for="sending_authentication">{{ trans('lang.authentication') }}</label>
                        <select name="smtp_authentication" id="smtp_authentication" class="form-control select">
    @foreach(['normal' => 'Normal Password'] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                    </div>
                    <div class="col-sm-2 form-group">
                        <br>
                        <input type="checkbox" name="smtp_validate" id="smtp_validate">&nbsp; {{ trans('lang.validate_certificates_from_tls_or_ssl_server') }}
                    </div>
                </div>
                <div id="response"></div>
                <!-- Internal notes -->
                <div class="form-group">
                    <label for="internal_notes">{{ trans('lang.internal_notes') }}</label>
                    <textarea name="internal_notes" id="internal_notes" class="form-control" rows="10">{{ old('internal_notes') }}</textarea>
                </div>
            </div>
            <input type="hidden" name="count" value="{{$count}}"> 
        </div>

        <div>
            <input type="checkbox" name="sys_email" @if($sys_email->sys_email == $emails->id) checked  @endif @if($count > 1 && $sys_email->sys_email == $emails->id) disabled @endif">&nbsp;&nbsp;{{ trans('lang.make-system-default-mail') }}
        </div>
    </div>
    
    <div class="card-footer">
        {!! Form::button('<i id="spin" class="fas fa-spinner" style="display:none;"></i> ' . trans("lang.update").'' ,['class'=>'btn btn-primary', 'type' => 'submit'])!!}
    </div>
</div>
</form>
<div class="modal fade" id="loadingpopup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="head" class="text-center">
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close" style="display:none;"><span aria-hidden="true">×</span></button>
                    <img src="{{asset("lb-faveo/media/images/gifloader.gif")}}" >
                    <br/>
                    <br/>
                    <br/>
                    <center><h3 style="color:#80DE02;">Testing incoming & outgoing mail server</h3></center>
                    <br/>
                    <center><h6>Please wait while testing is in progress ...</h6></center>
                    <center><h6>(Please do not use "Refresh" or "Back" button)</h6></center>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
<button style="display:none" data-toggle="modal" data-target="#loadingpopup" id="click"></button>
<script type="text/javascript">
    //submit form
    $('#form').on('submit', function () {
        var form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "{!! route('validating.email.settings.update', $emails->id ) !!}",
            dataType: "json",
            data: form_data,
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function () {
                $('#alert').empty();
                $("#click").trigger("click");
            },
            success: function (json) {
                console.log(json.result);
                $("#close").trigger("click");
                var res = "";
                $.each(json.result, function (idx, topic) {
                    if (idx === "success") {
                        res = "<div class='alert alert-success'>" + topic + "</div>";
                    }
                    if (idx === "fails") {
                        res = "<div class='alert alert-danger'>" + topic + "</div>";
                    }
                });

                $("#head").html(res);
                $('html, body').animate({scrollTop: $("#head").offset().top}, 500);
            },
            error: function (json) {
                $("#close").trigger("click");
                var res = "";
                $.each(json.responseJSON.errors, function (idx, topic) {
                    res += "<li>" + topic + "</li>";
                });
                $("#head").html("<div class='alert alert-danger'><strong>Whoops!</strong> There were some problems with your input.<br><br><ul>" + res + "</ul></div>");
                $('html, body').animate({scrollTop: $("#head").offset().top}, 500);
            }
        });
        return false;
    });

    $(document).ready(function () {
        var serviceid = $("#service").val();
        send(serviceid);
        $("#service").on('change', function () {
            serviceid = $("#service").val();
            send(serviceid);
        });
        function send(serviceid) {
            $.ajax({
                url: "{{url('mail/config/service')}}",
                dataType: "html",
                data: {'service': serviceid,'emailid':{{$emails->id}}},
                success: function (response) {
                    $("#response").html(response);
                },
                error: function (response) {
                    $("#response").html(response);
                }
            });
        }
    });
</script>
@stop
