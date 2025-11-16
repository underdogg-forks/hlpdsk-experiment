@extends('themes.default1.agent.layout.agent')
@extends('themes.default1.agent.layout.sidebar')    

@section('widget')
    active
@stop
@section('side1')
    class="active"
@stop

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
        <b>Success</b>
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
    <div class="box-header">
        <h3 class="box-title">{{ trans('lang.sidewidget1') }}</h3>  {!! Form::submit(trans('lang.save'),['class'=>'form-group btn btn-primary pull-right'])!!}
    </div>

    <div class="box-body">

    <div class="row">


    <div class="col-md-10">

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

            {!! Form::label('title',trans('lang.title')) !!}
            {!! $errors->first('title', '<spam class="help-block">:message</spam>') !!}
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">

        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            {!! Form::label('content',trans('lang.content')) !!}
            {!! $errors->first('content', '<spam class="help-block">:message</spam>') !!}
            <textarea name="content" id="footer" class="form-control" rows="10">{{ old('content') }}</textarea>
        </div>

    </div>

    </div>

    </div>
<script type="text/javascript">
        $(function () {
            $("textarea").wysihtml5();
        });
</script>
@stop
@section('FooterInclude')

@stop
