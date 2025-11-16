@extends('themes.default1.admin.layout.admin')

@section('Settings')
class="nav-link active"
@stop

@section('settings-menu-parent')
class="nav-item menu-open"
@stop

@section('settings-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('system')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.settings') }}</h1>
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
    @method('PATCH')
<!-- check whether success or not -->
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>{{ trans('lang.alert') }}!</b><br/>
    <li class="error-message-padding">{{ session('fails') }}</li>
</div>
@endif
@if(session()->has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('user_name'))
    <li class="error-message-padding">{!! $errors->first('user_name', ':message') !!}</li>
    @endif
    @if($errors->first('first_name'))
    <li class="error-message-padding">{!! $errors->first('first_name', ':message') !!}</li>
    @endif
    @if($errors->first('last_name'))
    <li class="error-message-padding">{!! $errors->first('last_name', ':message') !!}</li>
    @endif
    @if($errors->first('email'))
    <li class="error-message-padding">{!! $errors->first('email', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.system-settings') }}</h3> 
    </div>
    <!-- Helpdesk Status: radio Online Offline -->
    <div class="card-body">
        <div class="row">
           
            <!-- Helpdesk Name/Title: text Required   -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name',trans('lang.name/title')) !!}
                    {!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="name" id="name" value="$systems->name" class="form-control">
                </div>
            </div>
             <!-- Helpdesk URL:      text   Required -->
             <div class="col-md-4">
                <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                    {!! Form::label('url',trans('lang.url')) !!}
                    {!! $errors->first('url', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="url" id="url" value="$systems->url" class="form-control">
                </div>
            </div>
            <!-- Default Time Zone: Drop down: timezones table : Required -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('time_zone') ? 'has-error' : '' }}">
                    {!! Form::label('time_zone',trans('lang.timezone')) !!}
                    {!! $errors->first('time_zone', '<spam class="help-block">:message</spam>') !!}
                    {!!Form::select('time_zone',['Time Zones'=>$timezones->pluck('name','id')->toArray()],null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Date and Time Format: text: required: eg - 03/25/2015 7:14 am -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('date_time_format') ? 'has-error' : '' }}">
                    {!! Form::label('date_time_format',trans('lang.date_time')) !!}
                    {!! $errors->first('date_time_format', '<spam class="help-block">:message</spam>') !!}
                    {!! Form::select('date_time_format',['Date Time Formats'=>$date_time->pluck('format','id')->toArray()],null,['class' => 'form-control']) !!}
                </div>
            </div>
           
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('status',trans('lang.status')) !!}
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="radio" name="status" value="'1'"> {{ trans('lang.online') }}
                        </div>
                        <div class="col-sm-6">
                            <input type="radio" name="status" value="'0'"> {{ trans('lang.offline') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('user_set_ticket_status',trans('lang.user_set_ticket_status')) !!}
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="radio" name="user_set_ticket_status" value="0" @if($common_setting->status == '0')checked="true" @endif>&nbsp;{{ trans('lang.no') }}
                        </div>
                        <div class="col-sm-6">
                            <input type="radio" name="user_set_ticket_status" value="1" @if($common_setting->status == '1')checked="true" @endif>&nbsp;{{ trans('lang.yes') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">    
            <div class="col-md-4" data-toggle="tooltip" title="{{ trans('lang.the_rtl_support_is_only_applicable_to_the_outgoing_mails') }}">
                <div class="form-group">
                    {!! Form::label('status',trans('lang.rtl')) !!}
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            $rtl = App\Model\helpdesk\Settings\CommonSettings::where('option_name', '=', 'enable_rtl')->first();
                            ?>
                            <input type="checkbox" name="enable_rtl" @if($rtl->option_value == 1) checked @endif> {{ trans('lang.enable') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-toggle="tooltip" title="{{ trans('lang.otp_usage_info') }}">
                <div class="form-group">
                    {!! Form::label('send_otp',trans('lang.allow_unverified_users_to_create_ticket')) !!}
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="radio" name="send_otp" value="0" @if($send_otp->status == '0')checked="true" @endif>&nbsp;{{ trans('lang.yes') }}
                        </div>
                        <div class="col-sm-6">
                            <input type="radio" name="send_otp" value="1" @if($send_otp->status == '1')checked="true" @endif>&nbsp;{{ trans('lang.no') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-toggle="tooltip" title="{{ trans('lang.email_man_info') }}">
                <div class="form-group">
                    {!! Form::label('email_mandatory',trans('lang.make-email-mandatroy')) !!}
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="radio" name="email_mandatory" value="1" @if($email_mandatory->status == '1')checked="true" @endif>&nbsp;{{ trans('lang.yes') }}
                        </div>
                        <div class="col-sm-6">
                            <input type="radio" name="email_mandatory" value="0" @if($email_mandatory->status == '0')checked="true" @endif>&nbsp;{{ trans('lang.no') }}
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['onclick'=>'sendForm()','class'=>'btn btn-primary'])!!}
    </div>
</div>

@stop
