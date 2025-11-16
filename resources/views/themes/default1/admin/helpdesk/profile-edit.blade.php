@extends('themes.default1.admin.layout.admin')
@section('content')

    <div class="row">
    <div class="col-md-6">

<form method="POST">
    @csrf
    @method('PATCH')

<div class="box box-primary">

	<div class="content-header">

	 	<h4>Profile	{!! Form::submit(trans('lang.save'),['class'=>'form-group btn btn-primary pull-right'])!!}</h4>

	</div>

<div class="box-body">

@if(session()->has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Alert!</b> Success.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                    @endif
                    <!-- fail message -->
                    @if(session()->has('fails'))
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Alert!</b> Failed.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('fails') }}
                    </div>
                    @endif

        <!-- first name -->
		<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">

			<label for="first_name">{{ trans('lang.first_name') }}</label>
			{!! $errors->first('first_name', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control">

		</div>
		<!-- last name -->
		<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">

			<label for="last_name">{{ trans('lang.last_name') }}</label>
			{!! $errors->first('last_name', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control">

		</div>
		<!-- gender -->
		<div class="form-group">
			<label for="gender">{{ trans('lang.gender') }}</label>
			<div class="row">
				<div class="col-xs-3">
					<input type="radio" name="gender" value="'1'">{{ trans('lang.male') }}
				</div>
				<div class="col-xs-3">
					<input type="radio" name="gender" value="'0'">{{ trans('lang.female') }}
				</div>
			</div>
		</div>



		<div class="form-group">

			<label for="email">{{ trans('lang.email_address') }}</label>
			<div>
				{{$user->email}}
			</div>
		</div>
		<!-- company -->
		<div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">

			<label for="company">{{ trans('lang.company') }}</label>
			{!! $errors->first('company', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="company" id="company" value="{{ old('company') }}" class="form-control">

		</div>

		<div class="row">
			<!-- phone extension -->
			<div class="col-xs-3 form-group {{ $errors->has('ext') ? 'has-error' : '' }}">

				<label for="ext">{{ trans('lang.ext') }}</label>
				{!! $errors->first('ext', '<spam class="help-block">:message</spam>') !!}
				<input type="text" name="ext" id="ext" value="{{ old('ext') }}" class="form-control">

			</div>
			<!-- phone number -->
			<div class="col-xs-9 form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">

				<label for="phone_number">{{ trans('lang.phone') }}</label>
				{!! $errors->first('phone_number', '<spam class="help-block">:message</spam>') !!}
				<input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control">

			</div>
		</div>
			<!-- mobile -->
			<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">

				<label for="mobile">{{ trans('lang.mobile_number') }}</label>
				{!! $errors->first('mobile', '<spam class="help-block">:message</spam>') !!}
				<input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control">

			</div>

	<!-- profile pic -->
	<div class="form-group {{ $errors->has('profile_pic') ? 'has-error' : '' }}">

		<label for="profile_pic">{{ trans('lang.profile_pic') }}</label>
		{!! $errors->first('profile_pic', '<spam class="help-block">:message</spam>') !!}
		<input type="file" name="profile_pic') !!}

	</div>

	@csrf
	</form>
</div>
</div>
</div>
<div class="col-md-6">

    <form method="POST">
    @csrf</h4>

	</div>

<div class="box-body">
					@if(session()->has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Alert!</b> Success.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                    @endif
                    <!-- fail message -->
                    @if(session()->has('fails'))
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Alert!</b> Failed.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('fails') }}
                    </div>
                    @endif
	<!-- old password -->
	<div class="form-group has-feedback {{ $errors->has('old_password') ? 'has-error' : '' }}">
			<label for="old_password">{{ trans('lang.old_password') }}</label>
            <input type="password" name="old_password" id="old_password" class="form-control">
			{!! $errors->first('old_password', '<spam class="help-block">:message</spam>') !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <!-- new password -->
    <div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
    		<label for="new_password">{{ trans('lang.new_password') }}</label>
            <input type="password" name="new_password" id="new_password" class="form-control">
			{!! $errors->first('new_password', '<spam class="help-block">:message</spam>') !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <!-- confirm password -->
    <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
    		<label for="confirm_password">{{ trans('lang.confirm_password') }}</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
			{!! $errors->first('confirm_password', '<spam class="help-block">:message</spam>') !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>




</div>
</div>
</div>
</div>


</form>
@stop