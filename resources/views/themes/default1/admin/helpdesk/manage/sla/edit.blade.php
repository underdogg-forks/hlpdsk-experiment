@extends('themes.default1.admin.layout.admin')

@section('Manage')
class="nav-link active"
@stop

@section('manage-menu-parent')
class="nav-item menu-open"
@stop

@section('manage-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('sla')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.sla_plan') }}</h1>
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
@if(session()->has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>Alert!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('name'))
    <li class="error-message-padding">{!! $errors->first('name', ':message') !!}</li>
    @endif
    @if($errors->first('grace_period'))
    <li class="error-message-padding">{!! $errors->first('grace_period', ':message') !!}</li>
    @endif
    @if($errors->first('status'))
    <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit') }}</h3>
    </div>
    <div class="card-body"> 
        <!-- Name text form Required -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">{{ trans('lang.name') }}</label> <span class="text-red"> *</span>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
            </div>
            <!-- Grace Period text form Required -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('grace_period') ? 'has-error' : '' }}">
                    <label for="grace_period">{{ trans('lang.grace_period') }}</label>
                    <select name="grace_period" id="grace_period" class="form-control">
    @foreach(['6 Hours'=>'6 Hours', '12 Hours'=>'12 Hours', '18 Hours'=>'18 Hours', '24 Hours'=>'24 Hours', '36 Hours'=>'36 Hours', '48 Hours'=>'48 Hours'] as $key => $value)
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
            </div>
            <!-- status radio: required: Active|Dissable -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status">{{ trans('lang.status') }}</label>&nbsp;<br/>
                    <input type="radio" name="status" value="'1'"> &nbsp; {{ trans('lang.active') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="'0'"> &nbsp; {{ trans('lang.inactive') }}
                </div>
            </div>
        </div>
        <!-- Admin Note : Textarea : -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="admin_note">{{ trans('lang.admin_notes') }}</label>
                    <textarea name="admin_note" id="admin_note" class="form-control" rows="5">{{ old('admin_note') }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <input type="checkbox" name="sys_sla" @if($slas->id == $sla->sla) checked disabled @endif> {{ trans('lang.make-default-sla') }}
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('lang.update') }}</button>
    </div>
</div>
<!-- close form -->
</form>
@stop
