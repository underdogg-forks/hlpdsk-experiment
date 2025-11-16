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

@section('ban')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.ban_email') }}</h1>
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
<form method="POST" action="{{ route('banlist.store') }}">
    @csrf

@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa  fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
@if(session()->has('errors'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('ban'))
    <li class="error-message-padding">{!! $errors->first('ban', ':message') !!}</li>
    @endif
    @if($errors->first('email'))
    <li class="error-message-padding">{!! $errors->first('email', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.create_a_banned_email') }}</h3>
    </div>
    <!-- Ban Status : Radio form : Required -->
    <div class="card-body">
        
        <div class="row">
            <!-- email Address : Text form : Required -->
            <div class="form-group col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('lang.email_address') }}</label> <span class="text-red"> *</span>
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">

            </div>

            <div class="form-group col-sm-6 {{ $errors->has('ban') ? 'has-error' : '' }}">
                <label for="ban">{{ trans('lang.ban_status') }}</label> <span class="text-red"> *</span>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="radio" name="ban" value="1) !!} {{ trans('lang.active') }}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::radio('ban'"> {{ trans('lang.inactive') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- intrnal Notes : Textarea :  -->
        <div class="form-group">
            <label for="internal_note">{{ trans('lang.internal_notes') }}</label>
            <textarea name="internal_note" id="internal_note" class="form-control">{{ old('internal_note') }}</textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('lang.submit') }}</button>
    </div>
</div>
@stop
