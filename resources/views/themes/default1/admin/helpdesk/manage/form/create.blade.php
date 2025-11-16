@extends('themes.default1.admin.layout.admin')

@section('Manage')
active
@stop

@section('manage-bar')
active
@stop

@section('forms')
class="active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')

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
<form method="POST" action="{{ action('Admin\helpdesk\FormController@store') }}">
    @csrf
<div class="box box-primary">
    <div class="box-header">
        
        <h2 class="box-title"style="margin-left:-10px">{{ trans('lang.create') }}</h2>{!! Form::submit(trans('lang.save'),['class'=>'pull-right btn btn-primary'])!!}
    </div>
    <div class="box-body">
        
        <!-- title: text -->
        <div class="box-body table-responsive no-padding"style="overflow:hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">{{ trans('lang.title') }}</label>
                        {!! $errors->first('title', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                    </div>
                </div>
                <!-- declare table head Label -->
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
                        <label for="label">{{ trans('lang.label') }}</label>
                        {!! $errors->first('label', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="label" id="label" value="{{ old('label') }}" class="form-control">
                    </div>
                </div>
                <!-- declare table head type -->
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="type">{{ trans('lang.type') }}</label>
                        {!! $errors->first('type', '<spam class="help-block">:message</spam>') !!}
                        <select name="type" id="type" class="form-control">
    @foreach([''=>'Select a Type','types'=>$type->pluck('type','id')] as $key => $value)
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
                <!-- declare table head Vissibility -->
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('visibility') ? 'has-error' : '' }}">
                        <label for="visibility">{{ trans('lang.visibility') }}</label>
                        {!! $errors->first('visibility', '<spam class="help-block">:message</spam>') !!}
                        <select name="visibility" id="visibility" class="form-control">
    @foreach([''=>'Select a Visibility','visibilities' =>$visibility->pluck('visibility','id')] as $key => $value)
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
                <!-- declare table head variable -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="variable">{{ trans('lang.variable') }}</label>
                        <input type="text" name="variable" id="variable" value="{{ old('variable') }}" class="form-control">
                    </div>
                </div>
                <!-- instruction: textarea -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="instruction">{{ trans('lang.instruction') }}</label>
                        <textarea name="instruction" id="instruction" class="form-control" rows="5">{{ old('instruction') }}</textarea>
                    </div>
                </div>

                <!-- /table -->

                <!-- txt area -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="internal_notes">{{ trans('lang.internal_notes') }}</label>
                        <textarea name="internal_notes" id="internal_notes" class="form-control" rows="5">{{ old('internal_notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@stop
