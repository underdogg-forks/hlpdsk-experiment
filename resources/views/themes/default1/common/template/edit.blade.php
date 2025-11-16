@extends('themes.default1.admin.layout.admin')

@section('Emails')
class="nav-link active"
@stop

@section('email-menu-parent')
class="nav-item menu-open"
@stop

@section('email-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('template')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.templates') }}</h1>
@stop

@section('content')
<form method="POST">
    @csrf
    @method('PATCH')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <i class="fa fa-ban"></i>  
    <strong>{{ trans('lang.alert') }} !</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-check-circle"></i>  
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- fail lang -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">
    <div class="card-header">

        <h3 class="card-title">{{ trans('lang.edit_template') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <!-- first name -->
                <p class="lead mb-0">{!! $template->name !!}</p>
            </div>
            <div class="col-md-4 form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                <!-- last name -->
                {!! Form::label('type',trans('lang.template-types'),['class'=>'required']) !!}<span style="color:red;">*</span>
                <select name="type" id="type" class="form-control">
    @foreach([''=>'Select','Type'=>$type] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                <label for="subject">{{ trans('lang.subject') }}</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control">
            </div>
            <div class="col-md-3 form-group" id = "use-subject" style="margin-top: 15px;">
                <br/>
                <input type="hidden" name="variable" value="'0'">
                <input type="checkbox" name="variable" value="'1'">
                <label for="subject">{{ trans('lang.use_subject') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                {!! Form::label('message',trans('lang.content'),['class'=>'required']) !!}<span style="color:red;">*</span>
                <textarea name="message" id="textarea" class="form-control">{{ old('message') }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.update'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
</form>

<script>
    $(document).ready(function() {
        $("#subject").keyup(function() {
            var subject = document.getElementById('subject').value;
            if (subject) {
                $("#use-subject").show();
            } else {
                $("#use-subject").hide();
            }
        });
    });
</script>
@stop