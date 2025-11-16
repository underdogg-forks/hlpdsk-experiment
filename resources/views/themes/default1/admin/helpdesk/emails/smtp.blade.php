@extends('themes.default1.admin.layout.admin')

@section('Emails')
class="active"
@stop

@section('emails-bar')
active
@stop

@section('smtp')
class="active"
@stop

@section('HeadInclude')
@stop

<!-- /breadcrumbs -->
<!-- content -->
@section('content')
<form method="POST">
    @csrf
    @method('PATCH')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">{{ trans('lang.outgoing_emails') }}</h3>
    </div>
    <!-- Ban Status : Radio form : Required -->
    <div class="box-body">
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
            <b>Alert!</b> Failed.
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('fails') }}
        </div>
        @endif
        <div class="row">
            <!-- email Address : Text form : Required -->
            <div class="col-md-3 form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                <label for="driver">{{ trans('lang.driver') }}</label>
                {!! $errors->first('driver', '<spam class="help-block">:message</spam>') !!}
                <select name="driver" class="form-control">
                    <option <?php if ($settings->driver == "mail") {
    echo "selected='selected'";
} ?> value="mail">mail</option>
                    <option <?php if ($settings->driver == "smtp") {
    echo "selected='selected'";
} ?>  value="smtp">smtp</option>
                </select>
            </div>

            <div class="col-md-3 form-group {{ $errors->has('host') ? 'has-error' : '' }}">
                <label for="host">{{ trans('lang.host') }}</label>
                {!! $errors->first('host', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="host" id="host" value="{{ old('host') }}" class="form-control">
            </div>

            <div class="col-md-3 form-group {{ $errors->has('port') ? 'has-error' : '' }}">
                <label for="port">{{ trans('lang.port') }}</label>
                {!! $errors->first('port', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="port" id="port" value="{{ old('port') }}" class="form-control">
            </div>

            <div class="col-md-3 form-group {{ $errors->has('encryption') ? 'has-error' : '' }}">
                <label for="encryption">{{ trans('lang.encryption') }}</label>
                {!! $errors->first('encryption', '<spam class="help-block">:message</spam>') !!}
                <select name="encryption" class="form-control">
                    <option <?php if ($settings->encryption == "ssl") {
    echo "selected='selected'";
} ?>  value="ssl">SSL</option>
                    <option <?php if ($settings->encryption == "tls") {
    echo "selected='selected'";
} ?> value="tls">TLS</option>
                </select>
            </div>

            <div class="col-md-4 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('lang.name') }}</label>
                {!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
            </div>

            <div class="col-md-4 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('lang.email') }}</label>
                {!! $errors->first('email', '<spam class="help-block">:message</spam>') !!}
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="col-md-4 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('lang.password') }}</label>
                {!! $errors->first('password', '<spam class="help-block">:message</spam>') !!}
                @if($settings->password)
                <input type="password" name="password" class="form-control" value="{!! Crypt::decrypt($settings->password) !!}">
                @else
                <input type="password" name="password" class="form-control">
                @endif
            </div>
        </div>

    </div>
</div>
@stop