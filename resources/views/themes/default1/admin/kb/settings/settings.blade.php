@extends('themes.default1.admin.layout.kb')
@section('settings')
    class="active"
@stop
<script type="text/javascript" src="{{asset('dist/js/SetnicEdit.js')}}"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
@section('content')
<!-- open a form -->
    <form method="POST">
    @csrf
    @method('PATCH')

            <div class="box-header">
                <h3 class="box-title">{{ trans('lang.settings') }}</h3>  {!! Form::submit(trans('lang.save'),['class'=>'form-group btn btn-primary pull-right'])!!}
            </div>
            <div class="box-body">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('lang.system') }}</a></li>
                  <li><a href="#tab_2" data-toggle="tab">{{ trans('lang.smtp') }}</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                     {{-- For Form --}}
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
        <b>Alert!</b> Failed.
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('fails') }}
    </div>
    @endif
        <!-- Name text form Required -->
            <div class="row">
                <div class="col-md-3 form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    <label for="company_name">{{ trans('lang.companyname') }}</label>
                    {!! $errors->first('company_name', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="company_name" id="company_name" value="$settings->company_name" class="form-control">
                </div>
                <div class="col-md-3 form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    <label for="website">{{ trans('lang.website') }}</label>
                    {!! $errors->first('website', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="website" id="website" value="$settings->website" class="form-control">
                </div>
                <div class="col-md-3 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone">{{ trans('lang.phone') }}</label>
                    {!! $errors->first('phone', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="phone" id="phone" value="$settings->phone" class="form-control">
                </div>
                {{--  <div class="col-md-3 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="language">{{ trans('lang.language') }}</label>
                        <select name="language" id="language" class="form-control select">
    @foreach(['en'=>'English','ch'=>'Chinese'] as $key => $value)
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
 --}}
                    <div class="col-md-12 form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">{{ trans('lang.address') }}</label>
                {!! $errors->first('address', '<spam class="help-block">:message</spam>') !!}
                    <textarea name="address" id="address" class="form-control" rows="10">{{ old('address') }}</textarea>
                </div>
                    <div class="col-md-3 form-group">
                           <label for="logo">{{ trans('lang.logo') }}</label>
                           <input type="file" name="logo" id="logo">
                        @if($settings->logo)
                           <img src="{{asset('lb-faveo/dist/image/'.$settings->logo)}}" />
                           <a href="{{url('delete-logo/'.$settings->id)}}">{{ trans('lang.delete') }}</a>
                        @endif
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="pagination">{{ trans('lang.numberofelementstodisplay') }}</label>
                        {!! $errors->first('pagination', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="pagination" id="pagination" value="$settings->pagination" class="form-control">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="timezone">{{ trans('lang.timezone') }}</label>
                        {!!Form::select('timezone',$time->pluck('location','location') ,null,['class' => 'form-control select']) !!}
                    </div>
                     </div>
                  </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <div class="row">
                <div class="col-md-4 form-group {{ $errors->has('port') ? 'has-error' : '' }}">
                    <label for="port">{{ trans('lang.portnumber') }}</label>
                    {!! $errors->first('port', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="port" id="port" value="$settings->port" class="form-control">
                </div>
                <div class="col-md-4 form-group {{ $errors->has('host') ? 'has-error' : '' }}">
                    <label for="host">{{ trans('lang.host') }}</label>
                    {!! $errors->first('host', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="host" id="host" value="$settings->host" class="form-control">
                </div>
                <div class="col-md-4 form-group {{ $errors->has('encryption') ? 'has-error' : '' }}">
                    <label for="encryption">{{ trans('lang.encryption') }}</label>
                    {!! $errors->first('encryption', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="encryption" id="encryption" value="$settings->encryption" class="form-control">
                </div>
                <div class="col-md-4 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">{{ trans('lang.settingsemail') }}</label>
                    {!! $errors->first('email', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="email" id="email" value="$settings->email" class="form-control">
                </div>
                <div class="col-md-4 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">{{ trans('lang.password') }}</label>
                    {!! $errors->first('password', '<spam class="help-block">:message</spam>') !!}
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                        <label for="dateformat">{{ trans('lang.dateformat') }}</label>
                        {!!Form::select('dateformat',$date->pluck('format','format') ,null,['class' => 'form-control select']) !!}
                    </div>
            </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
@stop
@section('FooterInclude')

@stop

<!-- /content -->
