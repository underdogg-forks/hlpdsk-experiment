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

@section('ratings')
class="nav-link active"
@stop

@section('HeadInclude')
@stop

<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.ratings') }}</h1>
@stop

<!-- content -->
@section('content')
<form method="POST">
    @csrf
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
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
    @if($errors->first('display_order'))
    <li class="error-message-padding">{!! $errors->first('display_order', ':message') !!}</li>
    @endif
    @if($errors->first('rating_scale'))
    <li class="error-message-padding">{!! $errors->first('rating_scale', ':message') !!}</li>
    @endif
    @if($errors->first('rating_area'))
    <li class="error-message-padding">{!! $errors->first('rating_area', ':message') !!}</li>
    @endif
    @if($errors->first('restrict'))
    <li class="error-message-padding">{!! $errors->first('restrict', ':message') !!}</li>
    @endif
    @if($errors->first('allow_modification'))
    <li class="error-message-padding">{!! $errors->first('allow_modification', ':message') !!}</li>
    @endif
</div>
@endif 
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('lang.rating_label') }}</label><span style="color:red;">*</span>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
            </div>
            <div class="col-md-6 form-group {{ $errors->has('display_order') ? 'has-error' : '' }}">
                <label for="display_order">{{ trans('lang.display_order') }}</label><span style="color:red;">*</span>
                <input type="text" name="display_order" id="display_order" value="{{ old('display_order') }}" class="form-control">
            </div>
        </div>
        <div class="form-group {{ $errors->has('rating_scale') ? 'has-error' : '' }}">
            <label for="rating_scale">{{ trans('lang.rating_scale') }}</label><span style="color:red;">*</span>
            <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.rating-msg1') }}</div>
            <select name="rating_scale" id="rating_scale" class="form-control">
    @foreach(['1' => '1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'] as $key => $value)
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
        <div class="form-group {{ $errors->has('rating_area') ? 'has-error' : '' }}">
            <label for="rating_area">{{ trans('lang.rating_area') }}</label><span style="color:red;">*</span>
            <select name="rating_area" id="rating_area" class="form-control">
    @foreach(['Helpdesk Area' => 'Helpdesk Area','Comment Area'=>'Comment Area'] as $key => $value)
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
        <div class="form-group {{ $errors->has('restrict') ? 'has-error' : '' }}">
            <!-- gender -->
            <label for="gender">{{ trans('lang.rating_restrict') }}</label><span style="color:red;">*</span>
            <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.rating-msg2') }}</div>
            <select name="restrict" id="restrict" class="form-control">
    @foreach(['General' => 'general','Support'=>'support'] as $key => $value)
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
        <div class="form-group {{ $errors->has('allow_modification') ? 'has-error' : '' }}">
            <!-- Email user -->
            <label for="allow_modification">{{ trans('lang.rating_change') }}</label><span style="color:red;">*</span>
            <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.rating-msg3') }}</div>
            <div class="row">
                <div class="col-sm-2">
                    <input type="radio" name="allow_modification" value="'1') !!} {{ trans('lang.yes') }}
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="allow_modification'"> {{ trans('lang.no') }}
                </div>
            </div>        
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(trans('lang.update')" value="['class'=>'btn btn-primary']">
    </div>
</div>
</form>
@stop