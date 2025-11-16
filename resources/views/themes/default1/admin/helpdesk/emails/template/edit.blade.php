@extends('themes.default1.admin.layout.admin')

@section('Emails')
active
@stop

@section('emails-bar')
active
@stop

@section('emails')
class="active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')

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

<form method="POST">
    @csrf
    @method('PATCH')

	<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-body">
<div class="box-header">
<h2 class="box-title">{{ trans('lang.create') }}</h2>
<div class="pull-right">
   <button type="submit" class="btn btn-primary">{{ trans('lang.save') }}</button></div>
   </div>

	 <div class="box-body table-responsive no-padding"style="overflow:hidden">
	    <div class="row">

		<!--  Status : Radio form : Required -->
      <div class="col-md-6">
		<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
			<div class="row col-xs-3">
			<label for="status">{{ trans('lang.status') }}</label>
			</div>
			<div class="row">
				<div class="col-xs-3">
					<input type="radio" name="ban_status" value="'active'">{{ trans('lang.active') }}
				</div>
				<div class="col-xs-3">
					<input type="radio" name="ban_status" value="'disabled'">{{ trans('lang.disabled') }}
				</div>
			</div>
			</div>
		</div>
		</div>
		<!-- Name : Text form : Required -->
		<div class="row">
           <div class="col-md-4">
		        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			      <label for="name">{{ trans('lang.name') }}</label>
			      {!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
			       <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
			</div>
		</div>

		<!-- Form for template set to clone From template table : Drop down : required -->
             <div class="col-md-4">
		<div class="form-group {{ $errors->has('template_set_to_clone') ? 'has-error' : '' }}">
			<label for="template_set_to_clone">{{ trans('lang.template_set_to_clone') }}</label>
			{!! $errors->first('template_set_to_clone', '<spam class="help-block">:message</spam>') !!}
			<select name="template_set_to_clone" id="template_set_to_clone" class="form-control">
    @foreach([''=>'Select a Template','Templates'=>$templates->pluck('name','name')] as $key => $value)
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

		<!-- Language field to Set the language in the template -->
           <div class="col-md-4">
		<div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
			<label for="language">{{ trans('lang.language') }}</label>
			{!! $errors->first('language', '<spam class="help-block">:message</spam>') !!}
			<select name="language" id="language" class="form-control">
    @foreach([''=>'Select a Language','Languages'=>$languages->pluck('name','name')] as $key => $value)
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

		<!-- intrnal Notes : Textarea :  -->

             <div class="col-md-12">
		      <div class="form-group">
			     <label for="internal_note">{{ trans('lang.internal_notes') }}</label>
			     <textarea name="internal_note" id="internal_note" class="form-control">{{ old('internal_note') }}</textarea>
		     </div>
           </div>



	</div>
	</div>
	</div>
	</div>


@stop
