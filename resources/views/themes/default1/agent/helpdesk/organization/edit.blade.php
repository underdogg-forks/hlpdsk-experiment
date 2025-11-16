@extends('themes.default1.agent.layout.agent')

@section('Users')
class="nav-link active"
@stop

@section('user-bar')
class="nav-link active"
@stop

@section('user')
class="active"
@stop

@section('organizations')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.organization') }}</h1>
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
{!! Form::model($orgs,['url'=>'organizations/'.$orgs->id,'method'=>'PATCH']) !!}
@if(Session::has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('name'))
    <li class="error-message-padding">{!! $errors->first('name', ':message') !!}</li>
    @endif
    @if($errors->first('phone'))
    <li class="error-message-padding">{!! $errors->first('phone', ':message') !!}</li>
    @endif
    @if($errors->first('website'))
    <li class="error-message-padding">{!! $errors->first('website', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit') }}</h3>
    </div>
    <div class="card-body">
        <!-- name : text : Required -->
        <div class="row">
            <div class="col-sm-4 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name',trans('lang.name')) !!} <span class="text-red"> *</span>
                {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>
            <!-- phone : Text : -->
            <div class="col-sm-4 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                {!! Form::label('phone',trans('lang.phone')) !!}
                {!! Form::text('phone',null,['class' => 'form-control']) !!}
            </div>
            <!--website : Text :  -->
            <div class="col-sm-4 form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                {!! Form::label('website',trans('lang.website')) !!}
                {!! Form::text('website',null,['class' => 'form-control']) !!}
            </div>
        </div>
        <!-- Internal Notes : Textarea -->
        <div class="row">
            <div class="col-sm-6 form-group">
                {!! Form::label('address',trans('lang.address')) !!}
                {!! Form::textarea('address',null,['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-6 form-group">
                {!! Form::label('internal_notes',trans('lang.internal_notes')) !!}
                {!! Form::textarea('internal_notes',null,['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("textarea").summernote({
            height: 300,
            tabsize: 2,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });
</script>
@stop