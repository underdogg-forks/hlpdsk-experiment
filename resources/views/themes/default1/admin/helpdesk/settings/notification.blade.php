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

@section('notification')
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
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b> {{ trans('lang.alert') }} ! </b>
    <li class="error-message-padding">{{ session('fails') }}</li>
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.notification_settings') }}</h3>
    </div>
    <!-- check whether success or not -->
    <div class="card-body">

        <div class="row">
            <div class="col-md-3 no-padding">
                <div class="form-group">
                    <label for="del_noti">{{ trans('lang.delete_noti') }}</label>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{ url('delete-read-notification') }}" class="btn btn-danger">{{ trans('lang.del_all_read') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 no-padding">
                <div class="form-group">
                    <label for="del_noti">{{ trans('lang.noti_msg1') }}</label><span class="text-red"> *</span>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ url('delete-notification-log') }}" method="post">
                {{ csrf_field() }}
                    <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.noti_msg2') }}</div>
                    <input type="number" class="form-control" name='no_of_days' placeholder="{!! lang::get('lang.enter_no_of_days') !!}" min='1'>
                    <button type="submit" class="btn btn-primary">{{ trans('lang.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop