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
<form method="POST">
    @csrf
    @method('PATCH')
@if(session()->has('errors'))
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
                <label for="name">{{ trans('lang.name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
            </div>
            <!-- phone : Text : -->
            <div class="col-sm-4 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('lang.phone') }}</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
            </div>
            <!--website : Text :  -->
            <div class="col-sm-4 form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                <label for="website">{{ trans('lang.website') }}</label>
                <input type="text" name="website" id="website" value="{{ old('website') }}" class="form-control">
            </div>
        </div>
        <!-- Internal Notes : Textarea -->
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="address">{{ trans('lang.address') }}</label>
                <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
            </div>
            <div class="col-sm-6 form-group">
                <label for="internal_notes">{{ trans('lang.internal_notes') }}</label>
                <textarea name="internal_notes" id="internal_notes" class="form-control">{{ old('internal_notes') }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('lang.submit') }}</button>
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