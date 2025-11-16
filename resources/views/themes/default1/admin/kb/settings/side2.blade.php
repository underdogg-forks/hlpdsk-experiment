@extends('themes.default1.admin.layout.kb')

@section('widget')
    active
@stop
@section('side2')
    class="active"
@stop
<script type="text/javascript" src="{{asset('dist/js/SetnicEdit.js')}}"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

@section('content')

	<form method="POST">
    @csrf
    @method('PATCH')

<!-- <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}"> -->
	<!-- table  -->

<div class="box box-primary">
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable">
        <i class="fa  fa-check-circle"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
    </div>
    @endif
    <!-- failure message -->
    @if(session()->has('fails'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('fails') }}
    </div>
    @endif
    <div class="box-header">
        <h3 class="box-title">{{ trans('lang.sidewidget2') }}</h3>  <button type="submit" class="form-group btn btn-primary pull-right">{{ trans('lang.save') }}</button>
    </div>
    <div class="box-body">

    <div class="row">


    <div class="col-md-10">

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

            <label for="title">{{ trans('lang.title') }}</label>
            {!! $errors->first('title', '<spam class="help-block">:message</spam>') !!}
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">

        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            <label for="content">{{ trans('lang.content') }}</label>
            {!! $errors->first('content', '<spam class="help-block">:message</spam>') !!}
            <textarea name="content" id="footer" class="form-control" rows="10">{{ old('content') }}</textarea>
        </div>

    </div>

    </div>

    </div>

@stop
@section('FooterInclude')

@stop

<!-- /content -->
