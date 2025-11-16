@extends('themes.default1.admin.layout.admin')

@section('Tickets')
active
@stop

@section('manage-bar')
active
@stop

@section('labels')
class="active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>Labels</h1>
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

@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
@if(session()->has('errors'))
        <br><br>
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <b>{{ trans('lang.alert') }}!</b>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <br/>
            @if($errors->first('title'))
            <li class="error-message-padding">{!! $errors->first('title', ':message') !!}</li>
            @endif
            @if($errors->first('color'))
            <li class="error-message-padding">{!! $errors->first('color', ':message') !!}</li>
            @endif
            @if($errors->first('order'))
            <li class="error-message-padding">{!! $errors->first('order', ':message') !!}</li>
            @endif
        </div>
        @endif
@if(session()->has('warn'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('warn') }}
</div>
@endif
<div class="box">
    <link rel="stylesheet" href="{{asset('lb-faveo/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
    <div class="box-header">
        <div class="box-title">
            {!! $label->titleWithColor() !!}
        </div>
        <form method="POST">
    @csrf
    @method('PATCH')
    </div>
    <div class="box-body">
        <table class="table table-borderless">
            
           <tr>
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <td><label for="title">'Title'</label><span class="text-red"> *</span></td>
                <td>
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                    </div>
                </td>
                </div>
            </tr>
             <tr>
                <td><label for="color">'Color'</label><span class="text-red"> *</span></td>
                <td>
                    <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                    <input type="text" name="color" id="color" value="{{ old('color') }}" class="form-control my-colorpicker1 colorpicker-element">
                    </div>
                </td>
            </tr>
            
             <tr>
                <td><label for="order">'Order'</label><span class="text-red"> *</span></td>
                <td>
                    <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
                    {!! Form::input('number', 'order', null, array('class' => 'form-control')) !!}
                    </div>
                </td>
            </tr>
            
             <tr>
                <td><label for="status">'Status'</label></td>
                <td><p>{!! Form::checkbox('status') !!}  {{ trans('lang.enable') }}</p></td>
            </tr>
            
        </table>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-success">'Save'</button>
        </form>
    </div>
</div>
@stop
@section('FooterInclude')
<script src="{{asset('lb-faveo/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script>
//Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();
</script>
<script type="text/javascript">
    $("#label-form").on('submit', function(e){
        if(document.getElementById('status').checked) {
            checked = 1;
        } else {
            checked = 0;
        }
        $('<input />')
          .attr('type', 'hidden')
          .attr('name', "status")
          .attr('value', checked)
          .appendTo('#label-form');
    })
</script>
@stop