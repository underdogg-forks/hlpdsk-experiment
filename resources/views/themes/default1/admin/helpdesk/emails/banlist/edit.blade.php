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
<form method="POST">
    @csrf
    @method('PATCH')
@if(session()->has('errors'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('ban'))
    <li class="error-message-padding">{!! $errors->first('ban', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit_banned_email') }}</h3>
    </div>
    <!-- Ban Status : Radio form : Required -->
    <div class="card-body">
        
        <div class="row">
            <!-- email Address : Text form : Required -->
            <div class="form-group col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email',trans('lang.email_address')) !!} <span class="text-red"> *</span>
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
            </div>
            <div class="form-group col-sm-6 {{ $errors->has('ban') ? 'has-error' : '' }}">
                {!! Form::label('ban',trans('lang.ban_status')) !!} <span class="text-red"> *</span>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="radio" name="ban" value="1) !!} {{ trans('lang.active') }}
                    </div>
                    <div class="col-sm-2">
                        {!! Form::radio('ban'"> {{ trans('lang.inactive') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- intrnal Notes : Textarea :  -->
        <div class="form-group">
            {!! Form::label('internal_note',trans('lang.internal_notes')) !!}
            <textarea name="internal_note" id="internal_note" class="form-control">{{ old('internal_note') }}</textarea>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.update'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
@stop