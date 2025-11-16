@extends('themes.default1.admin.layout.admin')

@section('Settings')
class="nav-link active"
@stop

@section('settings-menu-parent')
class="nav-item menu-open"
@stop

@section('settings-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('languages')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.language') }}</h1>
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
<form method="POST" action="language/add" enctype="multipart/form-data">
    @csrf
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span>{{ session('success') }}</span>
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
    @if(session()->has('link'))
    <a href="{{url(Session::get('link'))}}">{{ trans('lang.enable_lang') }}</a>
    @endif
    @if(session()->has('link2'))
    <a href="{{url(Session::get('link2'))}}" target="blank">{{ trans('lang.read-more') }}</a>
    @endif
</div>
@endif
@if(session()->has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('language-name'))
    <li class="error-message-padding">{!! $errors->first('language-name', ':message') !!}</li>
    @endif
    @if($errors->first('iso-code'))
    <li class="error-message-padding">{!! $errors->first('iso-code', ':message') !!}</li>
    @endif
    @if($errors->first('File'))
    <li class="error-message-padding">{!! $errors->first('File', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.add-lang-package') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- username -->
            <div class="col-sm-4 form-group {{ $errors->has('language-name') ? 'has-error' : '' }}">
                <label for="language-name">{{ trans('lang.language-name') }}</label> <span class="text-red"> *</span>
                <input type="text" name="language-name" id="language-name" value="{{ old('language-name') }}" class="form-control">
            </div>
            <div class="col-sm-4 form-group {{ $errors->has('iso-code') ? 'has-error' : '' }}">
                <label for="iso-code">{{ trans('lang.iso-code') }}</label> <span class="text-red"> *</span>
                <input type="text" name="iso-code" id="iso-code" value="{{ old('iso-code') }}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 form-group {{ $errors->has('File') ? 'has-error' : '' }}">
                <label for="File">{{ trans('lang.file') }}</label> <span class="text-red"> *</span>&nbsp
                <div class="btn bg-olive btn-file" style="color:blue"> {{ trans('lang.upload_file') }}
                    <input type="file" name="File') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit')" id="File') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit')" class="btn btn-primary">
    </div>
</div>
@stop