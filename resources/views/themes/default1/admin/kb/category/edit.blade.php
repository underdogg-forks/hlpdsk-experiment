@extends('themes.default1.admin.layout.kb')

@section('category')
    active
@stop

<script type="text/javascript" src="{{asset('dist/js/EditnicEdit.js')}}"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

@section('content')
<form method="POST">
    @csrf
    @method('PATCH')


<div class="box box-primary">
	<div class="content-header">

	 	<h4>Edit	<button type="submit" class="form-group btn btn-primary pull-right">'save'</button></h4>

	</div>

	<div class="box-body">
	@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable">
        <i class="fa  fa-check-circle"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
    </div>
    @endif
    <!-- failure message -->
    @if(session()->has('fails'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('fails') }}
    </div>
    @endif

	<div class="row">

		<div class="col-xs-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">

			<label for="name">{{ trans('lang.name') }}</label>
			{!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">

		</div>

		<div class="col-xs-3 form-group {{ $errors->has('slug') ? 'has-error' : '' }}">

			<label for="slug">{{ trans('lang.slug') }}</label>
			{!! $errors->first('slug', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">

		</div>

		<div class="col-xs-3 form-group {{ $errors->has('parent') ? 'has-error' : '' }}">

			<label for="parent">{{ trans('lang.parent') }}</label>
			{!! $errors->first('parent', '<spam class="help-block">:message</spam>') !!}
			<select name="parent" id="parent" class="form-control select">
    @foreach([''=>'Select a Group','Categorys'=>$category->pluck('name','name')] as $key => $value)
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


		<div class="col-xs-3 form-group {{ $errors->has('status') ? 'has-error' : '' }}">

			<label for="status">{{ trans('lang.status') }}</label>
			{!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}
			<div class="row">
				<div class="col-xs-3">
					<input type="radio" name="status" value="'1'">{{ trans('lang.active') }}
				</div>
				<div class="col-xs-3">
					<input type="radio" name="status" value="'0'">{{ trans('lang.inactive') }}
				</div>
			</div>
		</div>

		<div class="col-md-12 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
			<label for="description">{{ trans('lang.description') }}</label>
			{!! $errors->first('description', '<spam class="help-block">:message</spam>') !!}
			<textarea name="description" id="description" class="form-control" rows="10">{{ old('description') }}</textarea>
		</div>

	</div>


</div>
@stop
@section('FooterInclude')

@stop

<!-- /content -->
