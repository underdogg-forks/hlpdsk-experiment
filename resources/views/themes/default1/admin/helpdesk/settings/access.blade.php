@extends('themes.default1.admin.layout.admin')

@section('Settings')
class="active"
@stop

@section('settings-bar')
active
@stop

@section('access')
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

<!-- open a form -->

	<form method="POST">
    @csrf
    @method('PATCH')


	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
                <h3 class="box-title">{{ trans('lang.access') }}</h3> <div class="pull-right">
                {!! Form::submit(trans('lang.save'),['class'=>'btn btn-primary'])!!}
              </div>
            </div>


<!-- check whether success or not -->

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable">
        <i class="fa  fa-check-circle"></i>
        <b>Success!</b>
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


		<!-- Password Expiration Policy: DROPDOWN	  -->
          <div class="box-body table-responsive"style="overflow:hidden;">
             <div class="row">
               <div class="col-md-4">
               <div class="form-group">
                {!! Form::label('password_expire',trans('lang.expiration_policy')) !!}
				{!!Form::select('password_expire',['1 month','2 month','3 month'],null,['class' => 'form-control select']) !!}

			</div>
		</div>



		<!-- Reset Token Expiration: TEXT- minutes    -->
			<div class="col-md-4">
             <div class="form-group">
				{!! Form::label('reset_ticket_expire',trans('lang.reset_token_expiration')) !!}
				<input type="text" name="reset_ticket_expire" id="reset_ticket_expire" value="$accesses->reset_ticket_expire" class="form-control">

			</div>
			</div>

		<!-- Agent Excessive Logins:	TEXT failed login attempt(s) allowed before a lock-out is enforced

		 								TEXT minutes locked out -->

		 		<!-- *************************    TODO    ************************** -->



		<!-- Agent Session Timeout: TEXT - minutes (0 to disable).  -->


			<div class="col-md-4">
			    <div class="form-group">
				{!! Form::label('agent_session',trans('lang.agent_session_timeout')) !!}
				<input type="text" name="agent_session" id="agent_session" value="$accesses->agent_session" class="form-control">

			</div>
			</div>
			</div>
			<!-- Allow Password Resets:	 CHECKBOX  -->
			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				{!! Form::label('password_reset',trans('lang.allow_password_resets')) !!}
				<input type="checkbox" name="password_reset" value="1">

			</div>
			</div>
            </div>

		<!-- Registration Method:	DROPDOWN  -->

			<div class="row">
			<div class="col-md-6">
                <div class="form-group">
				{!! Form::label('reg_method',trans('lang.registration_method')) !!}
				{!!Form::select('reg_method',['public','private','dissabled'],null,['class' => 'form-control select']) !!}

			</div>
			</div>


		<!-- User Excessive Logins:	TEXT failed login attempt(s) allowed before a lock-out is enforced

								TEXT	minutes locked out -->

		<!--*************************************    TODO   ******************************************  -->



		<!-- User Session Timeout:	TEXT  -->


			<div class="col-md-6">
                 <div class="form-group">
				{!! Form::label('user_session',trans('lang.user_session_timeout')) !!}
				<input type="text" name="user_session" id="user_session" value="$accesses->user_session" class="form-control">

			</div>
			</div>
			</div>
			        <!-- Bind Agent Session to IP:	CHECKBOX  -->

			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				<input type="checkbox" name="bind_agent_ip" value="1"> &nbsp;
				{!! Form::label('bind_agent_ip',trans('lang.bind_agent_session_IP')) !!}


			</div>
			</div>
			</div>
			<!-- Registration Required:	CHECKBOX- Require registration and login to create tickets  -->

			<div class="row">
			<div class="col-md-4">
                  <div class="form-group">
                  <input type="checkbox" name="reg_require" value="1" class="form-control">&nbsp;
				{!! Form::label('reg_require',trans('lang.registration_required')) !!}


			</div>
			</div>
          </div>


		<!-- Client Quick Access: CHECKBOX -->

			<div class="row">
			<div class="col-md-4">
			<div class="form-group">
			<input type="checkbox" name="quick_access" value="1">&nbsp;
				{!! Form::label('quick_access',trans('lang.client_quick_access')) !!}


			</div>
			</div>
          </div>



		</div>
		</div>
	</div>
	</div>

@stop
