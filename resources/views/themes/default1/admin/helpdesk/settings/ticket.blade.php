@extends('themes.default1.admin.layout.admin')

@section('Tickets')
class="nav-link active"
@stop

@section('ticket-menu-parent')
class="nav-item menu-open"
@stop

@section('ticket-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('tickets')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.settings') }}</h1>
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
<!-- check whether success or not -->
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
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
    @if($errors->first('status'))
    <li class="error-message-padding">{!! $errors->first('status', ':message') !!}</li>
    @endif
    @if($errors->first('priority'))
    <li class="error-message-padding">{!! $errors->first('priority', ':message') !!}</li>
    @endif
    @if($errors->first('sla'))
    <li class="error-message-padding">{!! $errors->first('sla', ':message') !!}</li>
    @endif
    @if($errors->first('help_topic'))
    <li class="error-message-padding">{!! $errors->first('help_topic', ':message') !!}</li>
    @endif
    @if($errors->first('collision_avoid'))
    <li class="error-message-padding">{!! $errors->first('collision_avoid', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.ticket-setting') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Default Status: Required : manual: Dropdowm  -->
            <div class="form-group col-md-6 {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">{{ trans('lang.default_status') }}</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" >Open</option>
                </select>
            </div>
            <!-- Default Priority:	Required : manual : Dropdowm  -->
            <div class="form-group col-md-6 {{ $errors->has('priority') ? 'has-error' : '' }}">
                <label for="priority">{{ trans('lang.default_priority') }}</label>
                <select name="priority" id="priority" class="form-control">
    @foreach([''=>trans('lang.select_a_priority'),trans('lang.priorities')=>$priority->pluck('priority_desc','priority_id')->toArray()] as $key => $value)
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
            <!-- Agent Collision Avoidance Duration: text-number   -minutes  -->
            <div class="form-group col-md-6 {{ $errors->has('collision_avoid') ? 'has-error' : '' }}">
                <label for="collision_avoid">{{ trans('lang.agent_collision_avoidance_duration') }}</label> 
                <div class="input-group">
                    <input type="number" class="form-control" name="collision_avoid" min="0"  step="1" value="{{$tickets->collision_avoid}}" placeholder="in minutes">
                    <div class="input-group-append">
                        <span class="btn btn-default"><i class="fas fa-clock"></i> {{ trans('lang.in_minutes') }}</span>
                    </div>
                </div>
            </div> 
            <div class="form-group col-md-6 {{ $errors->has('help_topic') ? 'has-error' : '' }}">
                <label for="help_topic">{{ trans('lang.lock_ticket_frequency') }}</label>
                <select name='lock_ticket_frequency' class="form-control">
                    <option @if($tickets->lock_ticket_frequency == null) selected="true" @endif value="0">{{ trans('lang.no') }}</option>
                    <option @if($tickets->lock_ticket_frequency == 1) selected="true" @endif value="1">{{ trans('lang.only-once') }}</option>
                    <option @if($tickets->lock_ticket_frequency == 2) selected="true" @endif value="2">{{ trans('lang.frequently') }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('num_format') ? 'has-error' : '' }}">
                <label for="num_format">{{ trans('lang.format') }}</label> 
                 <a href="#" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.ticket-number-format') }}"><i class="fa fa-question-circle" style="padding: 0px;"></i></a>
                <input type="text" name="num_format" id="format" value="{{ old('num_format') }}" class="form-control">

                <div id="result"></div>
            </div>

            <div class="form-group col-md-6 {{ $errors->has('num_sequence') ? 'has-error' : '' }}">
                <label for="num_sequence">{{ trans('lang.type') }}</label> 
                <a href="#" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.ticket-number-type') }}"><i class="fa fa-question-circle" style="padding: 0px;"></i></a>
    
                <select name="num_sequence" id="type" class="form-control">
    @foreach([''=>'Select','sequence'=>'Sequence','random'=>'Random'] as $key => $value)
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

                <div id="result"></div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        {!! Form::submit(trans('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
</div>
</form>
@stop
@section('FooterInclude')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    $(document).ready(function () {
        var format = $("#format").val();
        var type = $("#type").val();
        send(format, type);
        $("#format").keyup(function () {
            format = $("#format").val();
            type = $("#type").val();
            send(format, type);
        });
        $("#type").on('change', function () {
            format = $("#format").val();
            type = $("#type").val();
            send(format, type);
        });
        function send(format, type) {
            $.ajax({
                url: "{{url('get-ticket-number')}}",
                type: "GET",
                dataType: "html",
                data: {'format': format, 'type': type},
                success: function (response) {
                    $("#result").html("Number :<b> " + response + "</b>");
                },
                error: function (response) {
                    console.log(response);
                    $("#result").html("<i>Invalid format</i>");
                }
            });
        }
    });
</script>
@stop