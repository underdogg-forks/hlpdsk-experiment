@extends('themes.default1.admin.layout.admin')

@section('Manage')
class="nav-link active"
@stop

@section('manage-menu-parent')
class="nav-item menu-open"
@stop

@section('manage-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('priority')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.priority') }}</h1>
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

<form action="{!!URL::route('priority.create1')!!}" method="post" role="form">
{{ csrf_field() }}
    @if(session()->has('errors'))
    <?php //dd($errors); ?>
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <b>Alert!</b>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <br/>
        @if($errors->first('priority'))
        <li class="error-message-padding">{!! $errors->first('priority', ':message') !!}</li>
        @endif
        @if($errors->first('priority_desc'))
        <li class="error-message-padding">{!! $errors->first('priority_desc', ':message') !!}</li>
        @endif
        @if($errors->first('priority_color'))
        <li class="error-message-padding">{!! $errors->first('priority_color', ':message') !!}</li>
        @endif
        @if($errors->first('status'))
        <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
        @endif
    </div>
    @endif
    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">{{ trans('lang.create') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('priority') ? 'has-error' : '' }}">
                    {!! Form::label('priority',trans('lang.priority')) !!} <span class="text-red"> *</span>
                    <input type="text" class="form-control" name="priority" value="" >
                </div>
                <!-- Grace Period text form Required -->
                <div class="form-group col-md-6 {{ $errors->has('priority_desc') ? 'has-error' : '' }}">
                    {!! Form::label('priority_desc',trans('lang.priority_desc')) !!}<span class="text-red"> *</span>
                    <input type="text" name="priority_desc" class="form-control">
                </div> 
            </div>
            <!-- Priority Color -->
            <div class="row">
                <div class="form-group col-sm-6 {{ $errors->has('priority_color') ? 'has-error' : '' }}">
                    {!! Form::label('priority_color',trans('lang.priority_color')) !!}<span class="text-red"> *</span>
                    <input class="form-control my-colorpicker1 colorpicker-element" id="colorpicker" type="text" name="priority_color">
                </div>

                <div class="form-group col-sm-3 {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! Form::label('status',trans('lang.status')) !!}&nbsp;<span class="text-red"> *</span><br/>
                    <input type="radio"  name="status" value="1" checked>&nbsp;&nbsp;{{ trans('lang.active') }}&nbsp;&nbsp;
                    <input type="radio"  name="status" value="0" >&nbsp;&nbsp;{{ trans('lang.inactive') }}
                </div> 

                <div class="form-group col-sm-3 {{ $errors->has('ispublic') ? 'has-error' : '' }}">
                    {!! Form::label('ispublic',trans('lang.visibility')) !!}&nbsp;<span class="text-red"> *</span><br/>
                    <input type="radio"  name="ispublic" value="1" checked>{{ trans('lang.public') }}
                    <input type="radio"  name="ispublic" value="0" >&nbsp;&nbsp;{{ trans('lang.private') }}
                </div>
            </div>  
            <!-- Admin Note  : Textarea :  -->
            <div>
                {!! Form::label('admin_note',trans('lang.admin_notes')) !!}
                <textarea name="admin_note" id="admin_note" class="form-control" rows="5">{{ old('admin_note') }}</textarea>        
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
        </div>
    </div>
    <script>
        $(function () {

            $("#colorpicker").colorpicker();
        });
    </script>

    <!-- close form -->
    </form>
    @stop