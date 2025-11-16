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
                        {!! Form::label('title',trans('lang.title')) !!}
                        {!! $errors->first('title', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                    </div>
                </div>
                <!-- declare table head Label -->
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
                        {!! Form::label('label',trans('lang.label')) !!}
                        {!! $errors->first('label', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="label" id="label" value="{{ old('label') }}" class="form-control">
                    </div>
                </div>
                <!-- declare table head type -->
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        {!! Form::label('type',trans('lang.type')) !!}
                        {!! $errors->first('type', '<spam class="help-block">:message</spam>') !!}
                        {!!Form::select('type', [''=>'Select a Type','types'=>$type->pluck('type','id')] ,null,['class' => 'form-control'] ) !!}
                    </div>
                </div>
                <!-- declare table head Vissibility -->
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('visibility') ? 'has-error' : '' }}">
                        {!! Form::label('visibility',trans('lang.visibility')) !!}
                        {!! $errors->first('visibility', '<spam class="help-block">:message</spam>') !!}
                        {!!Form::select('visibility', [''=>'Select a Visibility','visibilities' =>$visibility->pluck('visibility','id')],null,['class' => 'form-control'] ) !!}
                    </div>
                </div>
                <!-- declare table head variable -->
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('variable',trans('lang.variable')) !!}
                        <input type="text" name="variable" id="variable" value="{{ old('variable') }}" class="form-control">
                    </div>
                </div>
                <!-- instruction: textarea -->
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('instruction',trans('lang.instruction')) !!}
                        <textarea name="instruction" id="instruction" class="form-control" rows="5">{{ old('instruction') }}</textarea>
                    </div>
                </div>

                <!-- /table -->

                <!-- txt area -->
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('internal_notes',trans('lang.internal_notes')) !!}
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
