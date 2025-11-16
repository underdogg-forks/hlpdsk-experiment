@extends('themes.default1.admin.layout.admin')

@section('Tickets')
class="nav-link active"
@stop

@section('ticket-menu-parent')
class="nav-item menu-open"
@stop

@section('ticket-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('auto-response')
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
    <i class="fas fa-ban"></i>
    <b>{!! lang::get('lang.alert') !!}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.auto_responce-settings') }}</h3> 
    </div>
    <!-- New Ticket: CHECKBOX	 Ticket Owner   -->
    <div class="card-body">
        
        <div class="form-group">
            <input type="checkbox" name="new_ticket" value="1"> &nbsp;
            <label for="new_ticket">{{ trans('lang.new_ticket') }}</label>
        </div>
        <!-- New Ticket by Agent: CHECKBOX	 Ticket Owner   -->
        <div>
            <input type="checkbox" name="agent_new_ticket" value="1">&nbsp;
            <label for="agent_new_ticket">{{ trans('lang.new_ticket_by_agent') }}</label>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
@stop
