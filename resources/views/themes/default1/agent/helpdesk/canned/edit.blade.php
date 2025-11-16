
@extends('themes.default1.agent.layout.agent')

@section('Tools')
class="nav-link active"
@stop

@section('tools-bar')
active
@stop

@section('tool')
class="active"
@stop

@section('tools')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.canned_response') }}</h1>
@stop
<!-- content -->
@section('content')
<!-- open a form -->
<form method="POST">
    @csrf
    @method('PATCH')
@if(session()->has('errors'))
        <?php //dd($errors); ?>
        <div class="alert alert-danger alert-dismissable">
            <i class="fas fa-ban"></i>
            <b>{{ trans('lang.alert') }}!</b>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <br/>
            @if($errors->first('title'))
            <li class="error-message-padding">{!! $errors->first('title', ':message') !!}</li>
            @endif
            @if($errors->first('message'))
            <li class="error-message-padding">{!! $errors->first('message', ':message') !!}</li>
            @endif
        </div>
        @endif
<!-- <section class="content"> -->
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit') }}</h3>
    </div>
    <div class="card-body">
        
        <div class="row">
            <!-- username -->
            <div class="col-sm-6 form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('lang.title') }}</label>         <span class="text-red"> *</span>       
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
            </div>
            <!-- firstname -->
            <div class="col-sm-12 form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                <label for="message">{{ trans('lang.message') }}</label>         <span class="text-red"> *</span>      
                <textarea name="message" id="message" class="form-control">{{ old('message') }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
<script>
    $(function() {
        //Add text editor
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
