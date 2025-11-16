
<div>
	@if(session()->has('success'))
	<div class="alert alert-success alert-dismissable">
	  <i class="fa  fa-check-circle"></i>
	  <b>Success</b>
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  {{ session('success') }}
	</div>
	@endif
	<!-- failure message -->
	@if(session()->has('fails'))
	<div class="alert alert-danger alert-dismissable">
	  <i class="fa fa-ban"></i>
	  <b>Fail!</b>
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  {{ session('fails') }}
	</div>
	@endif

	<div class="row">

		<div class="col-sm-7 form-group {{ $errors->has('name') ? 'has-error' : '' }}">

			{!! Form::label('name',trans('lang.name')) !!}
			{!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
		</div>

		<div class="col-sm-5 form-group {{ $errors->has('status') ? 'has-error' : '' }}">

			{!! Form::label('status',trans('lang.status')) !!}
			{!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}
			
			<div class="row">
				<div class="col-sm-6">
					<input type="radio" name="status" value="'1'">{{ trans('lang.active') }}
				</div>
				<div class="col-sm-6">
					<input type="radio" name="status" value="'0'">{{ trans('lang.inactive') }}
				</div>
		</div>
	</div>

	<div class="form-group col-sm-12 {{ $errors->has('description') ? 'has-error' : '' }}">
		{!! Form::label('description',trans('lang.description')) !!}
		{!! $errors->first('description', '<spam class="help-block">:message</spam>') !!}

		<textarea name="description" id="myNicEditor" class="form-control" rows="10">{{ old('description') }}</textarea>
	</div>
</div>

