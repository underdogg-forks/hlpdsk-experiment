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

@section('alert')
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
    <b>{!! lang::get('lang.alert') !!}!</b><br/>
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.alert_notices_setitngs') }}</h3> 
    </div>

    <div class="card-body">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('lang.new_ticket_alert') }}</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <!-- Status:     Enable   Disable     -->
                            {!! Form::label('ticket_status',trans('lang.status').":") !!}&nbsp;&nbsp;
                            <input type="radio" name="ticket_status" value="1) !!} {{ trans('lang.enable') }} &nbsp;&nbsp; {!! Form::radio('ticket_status'">  {{ trans('lang.disable') }}
                        </div>
                        <div class="form-group">
                            <!-- Admin Email -->
                            <input type="checkbox" name="ticket_admin_email" value="1">
                            <label for="ticket_admin_email">{{ trans('lang.admin_email_2') }}</label>
                        </div>
                        <!-- Department Members -->
                        <div class="form-group">
                            <input type="checkbox" name="ticket_department_member" value="1">
                            <label for="ticket_department_member">{{ trans('lang.department_members') }}</label>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <!-- /.box -->
            </div><!--/.col (left) -->
            <div class="col-md-6">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('lang.ticket_assignment_alert') }}</h3>
                    </div><!-- /.box-header -->
                    <div class="card-body">
                        <!-- Status:     Enable      Disable      -->
                        <div class="form-group">
                            {!! Form::label('assignment_status',trans('lang.status').":") !!}
                            <input type="radio" name="assignment_status" value="1) !!} {{ trans('lang.enable') }} &nbsp;&nbsp; {!! Form::radio('assignment_status'">  {{ trans('lang.disable') }}
                        </div>
                        <!-- Assigned Agent / Team -->
                        <div class="form-group">
                            <input type="checkbox" name="assignment_assigned_agent" value="1">
                            <label for="assignment_assigned_agent">{{ trans('lang.agent') }}</label>
                        </div>
                        <!-- Team Members -->
                        <div class="form-group">
                            <input type="checkbox" name="assignment_team_member" value="1">
                            <label for="assignment_team_member">{{ trans('lang.team_members') }}</label>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>
    </div>

    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>' btn btn-primary'])!!}
    </div>
</div>
@stop
