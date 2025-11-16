@extends('themes.default1.agent.layout.agent')
@extends('themes.default1.agent.layout.sidebar')    

@section('content')

    <div class="row">
    <div class="col-md-6">

<form method="POST">
    @csrf
    @method('PATCH')

<div class="box box-primary">

	<div class="content-header">

	 	<h4>Profile	<button type="submit" class="form-group btn btn-primary pull-right">'Save'</button></h4>

	</div>

<div class="box-body">
			
					@if(session()->has('success1'))
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Success</b>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success1') }}
                    </div>
                    @endif
                    <!-- fail message -->
                    @if(session()->has('fails1'))
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Fail!</b>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('fails1') }}
                    </div>
                    @endif

    <div class="row">
		<div class="form-group col-md-6 {{ $errors->has('firstname') ? 'has-error' : '' }}">

			{!! Form::label('firstname',trans('lang.firstname')) !!}
			{!! $errors->first('firstname', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" class="form-control">

		</div>
		<div class="form-group col-md-6 {{ $errors->has('lastname') ? 'has-error' : '' }}">

			{!! Form::label('lastname',trans('lang.lastname')) !!}
			{!! $errors->first('lastname', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" class="form-control">

		</div>
	</div>

		<div class="row">

		<div class="form-group col-md-6">
			{!! Form::label('gender',trans('lang.gender')) !!}
			<div class="row">
				<div class="col-xs-6">
					<input type="radio" name="gender" value="'1'">{{ trans('lang.male') }}
				</div>
				<div class="col-xs-6">
					<input type="radio" name="gender" value="'0'">{{ trans('lang.female') }}
				</div>
			</div>
		</div>

		<div class="col-md-6 form-group">

                        {!! Form::label('timezone',trans('lang.timezone')) !!}
                        {!!Form::select('timezone',$time->pluck('location','name') ,null,['class' => 'form-control select']) !!}

                    </div>

		</div>



		<div class="form-group">

			{!! Form::label('email',trans('lang.email')) !!}
			<div>
				{{$user->email}}
			</div>
		</div>

		<div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">

			{!! Form::label('company',trans('lang.company')) !!}
			{!! $errors->first('company', '<spam class="help-block">:message</spam>') !!}
			<input type="text" name="company" id="company" value="{{ old('company') }}" class="form-control">

		</div>

		<div class="row">
			<div class="col-xs-3 form-group {{ $errors->has('ext') ? 'has-error' : '' }}">

				{!! Form::label('ext',trans('lang.ext')) !!}
				{!! $errors->first('ext', '<spam class="help-block">:message</spam>') !!}
				<input type="text" name="ext" id="ext" value="{{ old('ext') }}" class="form-control">

			</div>

			<div class="col-xs-9 form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">

				{!! Form::label('phone_number',trans('lang.phone')) !!}
				{!! $errors->first('phone_number', '<spam class="help-block">:message</spam>') !!}
				<input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control">

			</div>
		</div>

			<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">

				{!! Form::label('mobile',trans('lang.mobile')) !!}
				{!! $errors->first('mobile', '<spam class="help-block">:message</spam>') !!}
				<input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control">

			</div>


	<div class="form-group {{ $errors->has('profile_pic') ? 'has-error' : '' }}">
	<div class="btn btn-default btn-file">
		{!! Form::label('profile_pic',trans('lang.profilepicture')) !!}
		{!! $errors->first('profile_pic', '<spam class="help-block">:message</spam>') !!}
		<input type="file" name="profile_pic') !!}
	</div>
	</div>

	@csrf
	</form>
</div>
</div>
</div>
<div class="col-md-6">

    {!! Form::model($user" id="profile_pic') !!}
	</div>
	</div>

	@csrf
	</form>
</div>
</div>
</div>
<div class="col-md-6">

    {!! Form::model($user">

<div class="box box-primary">

	<div class="content-header">

	 	<h4>Change Password	<button type="submit" class="form-group btn btn-primary pull-right">'Save'</button></h4>

	</div>

<div class="box-body">
					@if(session()->has('success2'))
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Alert!</b> Success.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success2') }}
                    </div>
                    @endif
                    <!-- fail message -->
                    @if(session()->has('fails2'))
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <b>Alert!</b> Failed.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('fails2') }}
                    </div>
                    @endif

	<div class="form-group has-feedback {{ $errors->has('old_password') ? 'has-error' : '' }}">
			{!! Form::label('old_password',trans('lang.oldpassword')) !!}
            <input type="password" name="old_password" id="old_password" class="form-control">
			{!! $errors->first('old_password', '<spam class="help-block">:message</spam>') !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
    		{!! Form::label('new_password',trans('lang.newpassword')) !!}
            <input type="password" name="new_password" id="new_password" class="form-control">
			{!! $errors->first('new_password', '<spam class="help-block">:message</spam>') !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
    		{!! Form::label('confirm_password',trans('lang.confirmpassword')) !!}
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