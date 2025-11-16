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

@section('agents')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.agents') }}</h1>
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
<form method="POST" action="{{ route('agents.store') }}">
    @csrf

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
    @if($errors->first('ext'))
    <li class="error-message-padding">{!! $errors->first('ext', ':message') !!}</li>
    @endif
    @if($errors->first('phone_number'))
    <li class="error-message-padding">{!! $errors->first('phone_number', ':message') !!}</li>
    @endif
    @if($errors->first('country_code'))
    <li class="error-message-padding">{!! $errors->first('country_code', ':message') !!}</li>
    @endif
    @if($errors->first('mobile'))
    <li class="error-message-padding">{!! $errors->first('mobile', ':message') !!}</li>
    @endif
    @if($errors->first('active'))
    <li class="error-message-padding">{!! $errors->first('active', ':message') !!}</li>
    @endif
    @if($errors->first('role'))
    <li class="error-message-padding">{!! $errors->first('role', ':message') !!}</li>
    @endif
    @if($errors->first('group'))
    <li class="error-message-padding">{!! $errors->first('group', ':message') !!}</li>
    @endif
    @if($errors->first('primary_department'))
    <li class="error-message-padding">{!! $errors->first('primary_department', ':message') !!}</li>
    @endif
    @if($errors->first('agent_time_zone'))
    <li class="error-message-padding">{!! $errors->first('agent_time_zone', ':message') !!}</li>
    @endif
    @if($errors->first('team'))
    <li class="error-message-padding">{!! $errors->first('team', ':message') !!}</li>
    @endif
</div>
@endif
@if(session()->has('fails2'))
    <div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>Alert!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
        <li class="error-message-padding">{{ session('fails2') }}</li>
    </div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.create_an_agent') }}</h3>	
    </div>
    <div class="card-body">
        <div class="row">
            <!-- username -->
            <div class="col-sm-4 form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                <label for="user_name">{{ trans('lang.user_name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" class="form-control">
            </div>
            <!-- firstname -->
            <div class="col-sm-4 form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('lang.first_name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control">
            </div>
            <!-- lastname -->
            <div class="col-sm-4 form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name">{{ trans('lang.last_name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control">
            </div>
        </div>
        <div class="row">
            <!-- email address -->
            <div class="col-sm-4 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('lang.email_address') }}</label> <span class="text-red"> *</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
            </div>
            <div class="col-sm-1 form-group {{ $errors->has('ext') ? 'has-error' : '' }}">
                <label for="ext">{{ trans('lang.ext') }}</label>	
                <input type="text" name="ext" id="ext" value="{{ old('ext') }}" class="form-control">
            </div>
            <!--country code-->
            <div class="col-sm-1 form-group {{  $errors->has('country_code') ? 'has-error' : '' }}">

                <label for="country_code">{{ trans('lang.country-code') }}</label> @if($send_otp->status ==1)<span class="text-red"> *</span>@endif
                <input type="text" name="country_code" id="country_code" value="{{ old('country_code') }}" class="form-control">

            </div>
            <!-- phone -->
            <div class="col-sm-3 form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                <label for="phone_number">{{ trans('lang.phone') }}</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control">
            </div>
            <!-- Mobile -->
            <div class="col-sm-3 form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                <label for="mobile">{{ trans('lang.mobile_number') }}</label>@if($send_otp->status ==1)<span class="text-red"> *</span>@endif
                <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control">
            </div>
        </div>
      
        <div class="row">
            <!-- assigned group -->
            <div class="col-sm-4 form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                <label for="assign_group">{{ trans('lang.assigned_group') }}</label> <span class="text-red"> *</span>
                <select name="group" id="group" class="form-control select">
    @foreach([''=>trans('lang.select_a_group'),trans('lang.groups')=>$groups->pluck('name','id')->toArray()] as $key => $value)
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

           <!-- primary department -->
            <div class="col-sm-4 form-group {{ $errors->has('primary_department') ? 'has-error' : '' }}">
                <label for="primary_dpt">{{ trans('lang.primary_department') }}</label> <span class="text-red"> *</span>

                <select name="primary_department" id="primary_department" class="form-control select">
    @foreach([''=>trans('lang.select_a_department'), trans('lang.departments')=>$departments->pluck('name','id')->toArray()] as $key => $value)
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

            <!-- timezone -->
            <div class="col-sm-4 form-group {{ $errors->has('agent_time_zone') ? 'has-error' : '' }}">
                <label for="agent_tzone">{{ trans('lang.agent_time_zone') }}</label> <span class="text-red"> *</span>
                <select name="agent_time_zone" id="agent_time_zone" class="form-control select">
    @foreach([''=>trans('lang.select_a_time_zone'),trans('lang.time_zones')=>$timezones->pluck('name','id')->toArray()] as $key => $value)
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

        <div class="row">
            <div class="col-sm-4">
                <!-- acccount type -->
                <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                    <label for="active">{{ trans('lang.status') }}</label>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="radio" name="active" value="'1'"> {{ trans('lang.active') }}
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="active" value="'0'"> {{ trans('lang.inactive') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- Role -->
                <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                    <label for="role">{{ trans('lang.role') }}</label>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="radio" name="role" value="'admin'"> {{ trans('lang.admin') }}
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="role" value="'agent'"> {{ trans('lang.agent') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <!-- Assign team -->
                <div class="form-group {{ $errors->has('team') ? 'has-error' : '' }}">
                    <label for="agent_tzone">{{ trans('lang.assigned_team') }}</label> <span class="text-red"> *</span>
                    @foreach($teams as $key => $val)
                    <div class="form-group ">
                        <input type="checkbox" name="team[]" value="{!! $val !!}"  > {!! $key !!}<br/>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <label for="agent_signature">{{ trans('lang.agent_signature') }}</label>
            <textarea name="agent_sign" id="agent_sign" class="form-control" rows="5">{{ old('agent_sign') }}</textarea>
        </div>

        <!-- Send email to user about registration password -->
        <div>
            <input type="checkbox" name="send_email" checked> &nbsp;<label> {{ trans('lang.send_password_via_email') }}</label>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('lang.submit') }}</button>
    </div>
</div>
</form>

<script type="text/javascript">
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
    </script>



@stop