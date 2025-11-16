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

@section('security')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.settings') }}</h1>
@stop

@section('header')
@stop

@section('content')
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
@if(session()->has('failed'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang/alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>{{ session('failed') }}</p>                
</div>
@endif
@if(session()->has('errors'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('lockout_message'))
    <li class="error-message-padding">{!! $errors->first('lockout_message', ':message') !!}</li>
    @endif
    @if($errors->first('backlist_threshold'))
    <li class="error-message-padding">{!! $errors->first('backlist_threshold', ':message') !!}</li>
    @endif
    @if($errors->first('lockout_period'))
    <li class="error-message-padding">{!! $errors->first('lockout_period', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.security_settings') }}</h3>
    </div><!-- /.card-header -->
    <div class="card-body">
        {!! Form::model($security,['route'=>['securitys.update', $security->id],'method'=>'PATCH','files' => true]) !!}
        <div class="form-group {{ $errors->has('lockout_message') ? 'has-error' : '' }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="title">{{trans('lang.Lockout_Message:')}}<span class="text-red"> *</span></label>
                </div>
                <div  class="col-md-9">
                    <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.security_msg1') }}</div>
                    <textarea name="lockout_message" id="lockout_message" class="form-control">{{ old('lockout_message') }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('backlist_threshold') ? 'has-error' : '' }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="title">{{ trans('lang.max_attempt') }}: <span class="text-red"> *</span></label>
                </div>
                <div class="col-md-9">
                    <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.security_msg2') }}</div>
                    <span><input type="text" name="backlist_threshold" id="backlist_threshold" value="{{ old('backlist_threshold') }}" class="form-control"> {{ trans('lang.lockouts') }}</span>
                </div>     
            </div>
        </div>
        <div class="form-group {{ $errors->has('lockout_period') ? 'has-error' : '' }}"> 
            <div class="row">
                <div class="col-md-3">
                    <label for="title">{{trans('lang.lockout_period:')}}<span class="text-red"> *</span></label>
                </div>
                <div class="col-md-8">
                    <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.security_msg3') }}</div>
                    <span> <input type="text" name="lockout_period" id="lockout_period" value="{{ old('lockout_period') }}" class="form-control"> {{ trans('lang.minutes') }}</span>
                </div>
            </div>
        </div>
    </div><!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{!! lang::get('lang.submit') !!}</button>
    </div>
    </form>
</div>
@stop
