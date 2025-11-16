@extends('themes.default1.agent.layout.agent')
@extends('themes.default1.agent.layout.sidebar')    

@section('Tools')
class="nav-link active"
@stop

@section('tool')
class="active"
@stop

@section('kb')
class="nav-link active"
@stop

@section('all-pages')
class="nav-link active"
@stop

@section('pages')
class="nav-link active"
@stop

@section('page-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('page-menu-parent')
class="nav-item menu-open"
@stop

@section('PageHeader')
<h1>{{ trans('lang.pages') }}</h1>
@stop

@section('content')

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
    @if($errors->first('slug'))
    <li class="error-message-padding">{!! $errors->first('slug', ':message') !!}</li>
    @endif
    @if($errors->first('description'))
    <li class="error-message-padding">{!! $errors->first('description', ':message') !!}</li>
    @endif
    @if($errors->first('status'))
    <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
    @endif
    @if($errors->first('visibility'))
    <li class="error-message-padding">{!! $errors->first('visibility', ':message') !!}</li>
    @endif
</div>
@endif

<div class="row">
    
    <div class="col-sm-9">
        
        <div class="card card-light">

            <div class="card-header">  
                <h3 class="card-title">{{ trans('lang.editpage') }}</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name',trans('lang.name')) !!}<span class="text-red"> *</span>

                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    
                    <div class="col-sm-12 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        {!! Form::label('description',trans('lang.description')) !!}

                        <div class="form-group" style="background-color:white">
                            <textarea name="description" id="myNicEditor" class="form-control color" rows="15">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        
        <div class="card card-light">

            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.publish') }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! Form::label('status',trans('lang.status')) !!}

                    <div class="row">
                        <div class="col-sm-5">
                            <input type="radio" name="status" value="1"> {{ trans('lang.published') }}
                        </div>
                        <div class="col-sm-5">
                            <input type="radio" name="status" value="0"> {{ trans('lang.draft') }}
                        </div>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('visibility') ? 'has-error' : '' }}">
                    {!! Form::label('visibility',trans('lang.visibility')) !!}

                    <div class="row">
                        <div class="col-sm-5">
                            <input type="radio" name="visibility" value="'1'"> {{ trans('lang.public') }}
                        </div>
                        <div class="col-sm-5">
                            <input type="radio" name="visibility" value="'0'"> {{ trans('lang.private') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">

                {!! Form::submit(trans('lang.publish'),['class'=>'btn btn-primary'])!!}
            </div>
        </div>
    </div>    
</div>

<script type="text/javascript">
    $(function() {
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
