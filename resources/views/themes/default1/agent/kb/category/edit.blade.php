@extends('themes.default1.agent.layout.agent')

@extends('themes.default1.agent.layout.sidebar')    

@section('category-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('category-menu-parent')
class="nav-item menu-open"
@stop

@section('Tools')
class="nav-link active"
@stop

@section('tool')
class="active"
@stop

@section('kb')
class="nav-link active"
@stop

@section('all-category')
class="nav-link active"
@stop

@section('category')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.category') }}</h1>
@stop

@section('content')
{!! Form::model($category,['url' => 'category/'.$category->id , 'method' => 'PATCH'] )!!}
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="far fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
@if(session()->has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('name'))
    <li class="error-message-padding">{!! $errors->first('name', ':message') !!}</li>
    @endif
    @if($errors->first('slug'))
    <li class="error-message-padding">{!! $errors->first('slug', ':message') !!}</li>
    @endif
    @if($errors->first('parent'))
    <li class="error-message-padding">{!! $errors->first('parent', ':message') !!}</li>
    @endif
    @if($errors->first('status'))
    <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
    @endif
    @if($errors->first('description'))
    <li class="error-message-padding">{!! $errors->first('description', ':message') !!}</li>
    @endif          
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name',trans('lang.name')) !!}<span class="text-red"> *</span>

                {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-3 {{ $errors->has('parent') ? 'has-error' : '' }}">
                {!! Form::label('parent',trans('lang.parent')) !!}

                {!!Form::select('parent',[''=>'Select a Group','Categorys'=>$categories],null,['class' => 'form-control select']) !!}
            </div>
            <div class="col-sm-3 {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('status',trans('lang.status')) !!}

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::radio('status','1',true) !!} {{ trans('lang.active') }}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::radio('status','0',null) !!} {{ trans('lang.inactive') }}
                    </div>
                </div>
            </div>
            <div class="col-md-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                {!! Form::label('description',trans('lang.description')) !!}<span class="text-red"> *</span>

                {!! Form::textarea('description',null,['class' => 'form-control','size' => '128x10','id'=>'description','placeholder'=>'Enter the description']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.update'),['class'=>'btn btn-primary'])!!}
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