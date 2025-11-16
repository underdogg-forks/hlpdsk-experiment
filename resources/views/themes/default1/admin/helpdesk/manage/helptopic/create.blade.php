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

@section('help')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.help_topic') }}</h1>
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
<form method="POST" action="{{ route('helptopic.store') }}">
    @csrf
@if(session()->has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>Alert!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('status'))
    <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
    @endif
    @if($errors->first('type'))
    <li class="error-message-padding">{!! $errors->first('type', ':message') !!}</li>
    @endif
    @if($errors->first('topic'))
    <li class="error-message-padding">{!! $errors->first('topic', ':message') !!}</li>
    @endif
    @if($errors->first('parent_topic'))
    <li class="error-message-padding">{!! $errors->first('parent_topic', ':message') !!}</li>
    @endif
    @if($errors->first('custom_form'))
    <li class="error-message-padding">{!! $errors->first('custom_form', ':message') !!}</li>
    @endif
    @if($errors->first('department'))
    <li class="error-message-padding">{!! $errors->first('department', ':message') !!}</li>
    @endif
    @if($errors->first('priority'))
    <li class="error-message-padding">{!! $errors->first('priority', ':message') !!}</li>
    @endif
    @if($errors->first('sla_plan'))
    <li class="error-message-padding">{!! $errors->first('sla_plan', ':message') !!}</li>
    @endif
    @if($errors->first('auto_assign'))
    <li class="error-message-padding">{!! $errors->first('auto_assign', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.create') }}</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <!-- Topic text form Required -->
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('topic') ? 'has-error' : '' }}">
                    {!! Form::label('topic',trans('lang.topic')) !!} <span class="text-red"> *</span>
                    <input type="text" name="topic" id="topic" value="{{ old('topic') }}" class="form-control">
                </div>
            </div> 
            <!-- status radio: required: Active|Dissable -->
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('ticket_status') ? 'has-error' : '' }}">
                    {!! Form::label('ticket_status',trans('lang.status')) !!}&nbsp;&nbsp;<br/>
                    <input type="radio" name="status" value="'1'"> {{ trans('lang.active') }}&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="'0'"> {{ trans('lang.inactive') }}
                </div>
            </div>
            <!-- Type : Radio : required : Public|private -->
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    {!! Form::label('type',trans('lang.type')) !!}&nbsp;&nbsp;<br/>
                    <input type="radio" name="type" value="'1'"> {{ trans('lang.public') }}&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="type" value="'0'"> {{ trans('lang.private') }}
                </div>
            </div>   
        </div>

        <div class="row">
            <!-- Parent Topic: Drop down: value from helptopic table -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('parent_topic') ? 'has-error' : '' }}">
                    {!! Form::label('parent_topic',trans('lang.parent_topic')) !!}
                    {!!Form::select('parent_topic', [''=>trans('lang.select_a_parent_topic'),trans('lang.help_topic')=>$topics->pluck('topic','topic')->toArray()],1,['class' => 'form-control']) !!}
                </div>
            </div>
            <!-- Custom Form: Drop down: value from form table -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('custom_form') ? 'has-error' : '' }}">
                    {!! Form::label('custom_form',trans('lang.Custom_form')) !!}
                    {!!Form::select('custom_form', [''=>trans('lang.select_a_form'),trans('lang.custom_form')=>$forms->pluck('formname','id')->toArray()],1,['class' => 'form-control']) !!}
                </div>
            </div>
            <!-- Department:    Drop down: value Department form table -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                    {!! Form::label('department',trans('lang.department')) !!}
                    {!!Form::select('department', [''=>trans('lang.select_a_department'),trans('lang.departments')=>$departments->pluck('name','id')->toArray()],1,['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <!-- Priority:	Drop down: value from Priority  table -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                    {!! Form::label('priority',trans('lang.priority')) !!} <span class="text-red"> *</span>
                    {!!Form::select('priority', [''=>trans('lang.select_a_priority'),trans('lang.priorities')=>$priority->pluck('priority_desc','priority_id')->toArray()],null,['class' => 'form-control']) !!}
                </div>
            </div>
            <!-- SLA Plan:	 Drop down: value SLA Plan  table-->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('sla_plan') ? 'has-error' : '' }}">
                    {!! Form::label('sla_plan',trans('lang.SLA_plan')) !!}
                    {!!Form::select('sla_plan', [''=>trans('lang.select_a_sla_plan'),trans('lang.sla_plans')=>$slas->pluck('name','id')->toArray()],1,['class' => 'form-control']) !!}
                </div>
            </div>
            <!-- Auto-assign To:	Drop Down: value  from Agent table   -->
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('auto_assign') ? 'has-error' : '' }}">
                    {!! Form::label('auto_assign',trans('lang.auto_assign')) !!}
                    {!!Form::select('auto_assign', [''=>trans('lang.select_an_agent'),trans('lang.agents')=>$agents->pluck('full_name','id')->toArray()],null,['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <!-- Auto-response:	checkbox : Disable new ticket auto-response  -->
        <div class="row">
            <!-- intrnal Notes : Textarea :  -->
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('internal_notes',trans('lang.internal_notes')) !!}
                    <textarea name="internal_notes" id="internal_notes" class="form-control" rows="5">{{ old('internal_notes') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
</form>
@stop
