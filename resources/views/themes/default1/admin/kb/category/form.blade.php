
<div class="box-body" >
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

		<div class="col-xs-4 form-group {{ $errors->has('name') ? 'has-error' : '' }}">

			<label for="name">'Name'</label>
			{!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">

		</div>

		{{--  --}}

		<div class="col-xs-4 form-group {{ $errors->has('status') ? 'has-error' : '' }}">

			<label for="status">'Status'</label>
			{!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}
			<div class="row">
				<div class="col-xs-3">
					<input type="radio" name="status" value="'1'">Active
				</div>
				<div class="col-xs-3">
					<input type="radio" name="status" value="'0'">Inactive
				</div>
			</div>
		</div>

	</div>
		<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
				<label for="description">'Description'</label>
				{!! $errors->first('description', '<spam class="help-block">:message</spam>') !!}

					<textarea name="description" id="myNicEditor" class="form-control" rows="10">{{ old('description') }}</textarea>
		</div>
</div>

