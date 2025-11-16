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

@section('teams')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.teams') }}</h1>
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
<form method="POST" action="{{ route('teams.store') }}">
    @csrf

@if(session()->has('errors'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <b>Alert!</b>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <br/>
        @if($errors->first('name'))
        <li class="error-message-padding">{!! $errors->first('name', ':message') !!}</li>
        @endif
        @if($errors->first('team_lead'))
        <li class="error-message-padding">{!! $errors->first('team_lead', ':message') !!}</li>
        @endif
        @if($errors->first('status'))
        <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
        @endif
    </div>
@endif

<div class="card card-light">
    
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.create_a_team') }}	</h3>
    </div>

    <div class="card-body">

        <div class="row">
            <!-- name -->
            <div class="col-sm-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('lang.name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
            </div>
            <!-- team lead -->
            <div class="col-sm-4 form-group {{ $errors->has('team_lead') ? 'has-error' : '' }}">
                <label for="team_lead">{{ trans('lang.team_lead') }}</label> 
                <select name="team_lead" id="team_lead" class="form-control">
    @foreach([''=>trans('lang.select_a_team_lead'), trans('lang.members')=>$user->pluck('full_name','id')->toArray()] as $key => $value)
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

            <div class="col-sm-3">
                <!-- status -->
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status">{{ trans('lang.status') }}</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="radio" name="status" value="'1'"> {{ trans('lang.active') }}
                        </div>
                        <div class="col-sm-6">
                            <input type="radio" name="status" value="'0'"> {{ trans('lang.inactive') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- admin notes -->
        <div>
            <label for="admin_notes">{{ trans('lang.admin_notes') }}</label>
            <textarea name="admin_notes" id="admin_notes" class="form-control" rows="5">{{ old('admin_notes') }}</textarea>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
</form>
@stop