@extends('themes.default1.admin.layout.admin')

@section('Themes')
class="active"
@stop

@section('theme-bar')
active
@stop

@section('footer3')
class="active"
@stop

@section('content')
<!-- open a form -->
	<form method="POST">
    @csrf
    @method('PATCH')
<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">{{ trans('lang.footer3') }}</h4>{!! Form::submit(trans('lang.save'),['class'=>'form-group btn btn-primary pull-right'])!!}
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissable">
            <i class="fa  fa-check-circle"></i>
            <b>Success!</b>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- failure message -->
    @if(session()->has('fails'))
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <b>Fail!</b>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('fails') }}
        </div>
    @endif
		<!-- Name text form Required -->
 		<div class="box-body table-responsive">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title',trans('lang.title') ) !!}
                {!! $errors->first('title', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
            </div>
            <div class="form-group {{ $errors->has('footer') ? 'has-error' : '' }}">
                {!! Form::label('footer', trans('lang.footer') ) !!}
                {!! $errors->first('footer', '<spam class="help-block">:message</spam>') !!}
                <textarea name="footer" id="footer" class="form-control" rows="5">{{ old('footer') }}</textarea>
            </div>
        </div>
        <div class="box-footer">
        </div>
    </div>
</div>
@stop
