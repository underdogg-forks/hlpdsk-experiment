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
<form action="{!!URL::route('priority.edit1')!!}" method="post" role="form">
{{ csrf_field() }}
    <input type="hidden" name="priority_id" value="{{$tk_priority->priority_id}}">
    @if(session()->has('errors'))
    <?php //dd($errors); ?>
    <div class="alert alert-danger alert-dismissable">
        <i class="fas fa-ban"></i>
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
        @if($errors->first('ispublic'))
        <li class="error-message-padding">{!! $errors->first('ispublic', ':message') !!}</li>
        @endif
    </div>
    @endif
    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">{{ trans('lang.edit') }}</h3>
        </div>
        <div class="card-body">
            
            <div class="row">

                 <div class="form-group col-md-6 {{ $errors->has('priority') ? 'has-error' : '' }}">
                    <label for="priority">{{ trans('lang.priority') }}</label><span class="text-red"> *</span>
                    <input type="text" class="form-control" name="priority" value="{{ ($tk_priority->priority) }}" >
                </div>

                <div class="form-group col-md-6 {{ $errors->has('priority_desc') ? 'has-error' : '' }}">
                    <label for="priority_desc">{{ trans('lang.priority_desc') }}</label> <span class="text-red"> *</span>
                    <input type="text" class="form-control" name="priority_desc" value="{{ ($tk_priority->priority_desc) }}">
                </div>
            </div>
            <!-- Priority Color -->
            <div class="row">

                <div class="form-group col-sm-6 {{ $errors->has('priority_color') ? 'has-error' : '' }}">
                    <label for="priority_color">{{ trans('lang.priority_color') }}</label><span class="text-red"> *</span>
                    <input class="form-control my-colorpicker1 colorpicker-element" id="colorpicker" value="{{ ($tk_priority->priority_color) }}" type="text" name="priority_color">
                </div>

                <div class="form-group col-sm-3 {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status">{{ trans('lang.status') }}</label><span class="text-red"> *</span><br/>
                    <input type="radio"  name="status" value="1" {{$tk_priority->status == '1' ? 'checked' : ''}}>&nbsp;&nbsp;{{ trans('lang.active') }}&nbsp;&nbsp;
                    <input type="radio"  name="status"  value="0" {{$tk_priority->status == '0' ? 'checked' : ''}}>&nbsp;&nbsp;{{ trans('lang.inactive') }}
                </div>

                <div class="form-group col-sm-3 {{ $errors->has('ispublic') ? 'has-error' : '' }}">
                    <label for="visibility">{{ trans('lang.visibility') }}</label>&nbsp;<span class="text-red"> *</span><br/>
                    <input type="radio"  name="ispublic" value="1" {{$tk_priority->ispublic == '1' ? 'checked' : ''}} >&nbsp;&nbsp;{{ trans('lang.public') }}&nbsp;&nbsp;
                    <input type="radio"  name="ispublic"  value="0" {{$tk_priority->ispublic == '0' ? 'checked' : ''}}>&nbsp;&nbsp;{{ trans('lang.private') }}
                </div>
            </div>  
            <!-- Admin Note : Textarea : -->
            <div>
                <label for="admin_note">{{ trans('lang.admin_notes') }}</label>
                <textarea name="admin_note" id="admin_note" class="form-control" rows="5">{{ old('admin_note') }}</textarea>
            </div>

            <div>
                <input type="checkbox" name="default_priority" @if($tk_priority->is_default == $tk_priority->priority_id) checked disabled @endif> {{ trans('lang.make-default-priority') }}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(trans('lang.update'),['class'=>'btn btn-primary'])!!}
        </div>
    </div>
    <!-- close form -->
    </form>
    <script>
        $(function () {

            $("#colorpicker").colorpicker();
        });
    </script>

    @stop
