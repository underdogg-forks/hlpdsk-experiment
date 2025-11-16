@extends('themes.default1.admin.layout.admin')

@section('Staffs')
class="nav-link active"
@stop

@section('staff-menu-parent')
class="nav-item menu-open"
@stop

@section('staff-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('groups')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.staffs') }}</h1>
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
{!! Form::open(array('route' => 'groups.store' , 'method' => 'post') )!!}
@if(session()->has('errors'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b> {{ trans('lang.alert') }}</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('name'))
    <li class="error-message-padding">{!! $errors->first('name', ':message') !!}</li>
    @endif
    @if($errors->first('group_status'))
    <li class="error-message-padding">{!! $errors->first('group_status', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title"> {{ trans('lang.create_a_group') }} </h3> 
    </div>
    <div class="card-body">
        
        <div class="row">
            <!-- name -->
            <div class="col-sm-4 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('lang.name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
            </div>
            <!-- group status -->
            <div class="col-sm-6 form-group {{ $errors->has('group_status') ? 'has-error' : '' }}">
                <label for="group_status">{{ trans('lang.status') }}</label>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="radio" name="group_status" value="'1'"> {{ trans('lang.active') }}
                    </div>
                    <div class="col-sm-3">
                        <input type="radio" name="group_status" value="'0'"> {{ trans('lang.inactive') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-light">
            
            <div class="card-header">
                
                <h3 class="card-title">Permissions</h3>
            </div>

            <div class="card-body">
                <!-- can create ticket -->
                <div class="row">
                    <input type="checkbox" name="can_create_ticket" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_create_ticket',trans('lang.can_create_ticket'),['style' => 'line-height:1;']) !!}
                </div>
                <!-- can_edit_ticket -->
                <div class="row">
                    <input type="checkbox" name="can_edit_ticket" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_edit_ticket',trans('lang.can_edit_ticket'),['style' => 'line-height:1;']) !!}
                </div>
                <!-- can post ticket -->
                <div class="row">
                    <input type="checkbox" name="can_post_ticket" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_post_ticket',trans('lang.can_post_ticket'),['style' => 'line-height:1;']) !!}
                </div>
                <!-- can_close_ticket -->
                <div class="row">
                    <input type="checkbox" name="can_close_ticket" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_close_ticket',trans('lang.can_close_ticket'),['style' => 'line-height:1;']) !!}
                </div>
                <!-- can delete ticket -->
                <div class="row">
                    <input type="checkbox" name="can_delete_ticket" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_delete_ticket',trans('lang.can_delete_ticket'),['style' => 'line-height:1;']) !!}
                </div>
                <!-- can assign ticket -->
                <div class="row">
                    <input type="checkbox" name="can_assign_ticket" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_assign_ticket',trans('lang.can_assign_ticket'),['style' => 'line-height:1;']) !!}
                </div>
                <!-- can ban email -->
                <div class="row">
                    <input type="checkbox" name="can_ban_email" value="1" class="checkbox">
                    &nbsp;{!! Form::label('can_ban_email',trans('lang.can_ban_emails'),['style' => 'line-height:1;']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('lang.submit') }}</button>
    </div>
</div>
</form>
@stop