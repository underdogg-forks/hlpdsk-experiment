@extends('themes.default1.layouts.register')
@section('body')
	
	<!-- openn a form -->

          <body class="login-page">
    <div class="login-box">
      
      <div class="login-box-body">
        <p class="login-box-msg">Registration</p>
        <!-- form open -->
        <form method="POST" action="{{ action('Auth\AuthController@postRegister') }}">
    @csrf
           
          <!-- fullname -->
           <div class="form-group has-feedback {{ $errors->has('full_name') ? 'has-error' : '' }}">
			
			<input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="form-control">
			{!! $errors->first('full_name', '<spam class="help-block">:message</spam>') !!}
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
          
          </div>

          <!-- Email -->
          <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
			
			<input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
			{!! $errors->first('email', '<spam class="help-block">:message</spam>') !!}
			<span class="far fa-envelope text-muted form-control-feedback"></span>
          
          </div>


          <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" name="password" id="password" class="form-control">
			{!! $errors->first('password', '<spam class="help-block">:message</spam>') !!}
            <span class="fa fa-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
			{!! $errors->first('password_confirmation', '<spam class="help-block">:message</spam>') !!}
            <span class="fas fa-sign-in-alt form-control-feedback"></span>
          </div>

          
          
          
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>

        
       
        <a href="{{url('auth/login')}}" class="text-center">I already have a membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    </form>


        
@stop


