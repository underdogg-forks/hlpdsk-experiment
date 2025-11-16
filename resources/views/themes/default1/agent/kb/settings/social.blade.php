@extends('themes.default1.agent.layout.agent')
@extends('themes.default1.agent.layout.sidebar')    

@section('widget')
    active
@stop
@section('social')
    class="active"
@stop
@section('content')
<!-- open a form -->

	<form method="POST">
    @csrf
    @method('PATCH')

<!-- <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}"> -->
	<!-- table  -->

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
	<div class="box-header">
        <h3 class="box-title">{{ trans('lang.social') }}</h3>  <button type="submit" class="form-group btn btn-primary pull-right">{{ trans('lang.save') }}</button>
    </div>

    <!-- check whether success or not -->

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

		<!-- Name text form Required -->
 		<div class="box-body table-responsive"style="overflow:hidden;">

            <div class="row">

                <div class=" col-xs-4 form-group {{ $errors->has('google') ? 'has-error' : '' }}">

                    <label for="google">'google'</label>
                    {!! $errors->first('google', '<spam class="help-block">:message</spam>') !!}
			        <input type="text" name="google" id="google" value="{{ old('google') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">

                    <label for="twitter">'twitter'</label>
                    {!! $errors->first('twitter', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="twitter" id="twitter" value="{{ old('twitter') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">

                    <label for="facebook">'facebook'</label>
                    {!! $errors->first('facebook', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="facebook" id="facebook" value="{{ old('facebook') }}" class="form-control">

                </div>

        </div>

        <div class="row">

                <div class=" col-xs-4 form-group {{ $errors->has('linkedin') ? 'has-error' : '' }}">

                    <label for="linkedin">'linkedin'</label>
                    {!! $errors->first('linkedin', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('stumble') ? 'has-error' : '' }}">

                    <label for="stumble">'stumble'</label>
                    {!! $errors->first('stumble', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="stumble" id="stumble" value="{{ old('stumble') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('deviantart') ? 'has-error' : '' }}">

                    <label for="deviantart">'deviantart'</label>
                    {!! $errors->first('deviantart', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="deviantart" id="deviantart" value="{{ old('deviantart') }}" class="form-control">

                </div>

        </div>

        <div class="row">

                <div class=" col-xs-4 form-group {{ $errors->has('flickr') ? 'has-error' : '' }}">

                    <label for="flickr">'flickr'</label>
                    {!! $errors->first('flickr', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="flickr" id="flickr" value="{{ old('flickr') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('skype') ? 'has-error' : '' }}">

                    <label for="skype">'skype'</label>
                    {!! $errors->first('skype', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="skype" id="skype" value="{{ old('skype') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('rss') ? 'has-error' : '' }}">

                    <label for="rss">'rss'</label>
                    {!! $errors->first('rss', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="rss" id="rss" value="{{ old('rss') }}" class="form-control">

                </div>

        </div>

         <div class="row">

                <div class=" col-xs-4 form-group {{ $errors->has('youtube') ? 'has-error' : '' }}">

                    <label for="youtube">'youtube'</label>
                    {!! $errors->first('youtube', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="youtube" id="youtube" value="{{ old('youtube') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('vimeo') ? 'has-error' : '' }}">

                    <label for="vimeo">'vimeo'</label>
                    {!! $errors->first('vimeo', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="vimeo" id="vimeo" value="{{ old('vimeo') }}" class="form-control">

                </div>

                <div class=" col-xs-4 form-group {{ $errors->has('pinterest') ? 'has-error' : '' }}">

                    <label for="pinterest">'pinterest'</label>
                    {!! $errors->first('pinterest', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="pinterest" id="pinterest" value="{{ old('pinterest') }}" class="form-control">

                </div>

        </div>

        <div class="row">

                <div class=" col-xs-6 form-group {{ $errors->has('dribbble') ? 'has-error' : '' }}">

                    <label for="dribbble">'dribbble'</label>
                    {!! $errors->first('dribbble', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="dribbble" id="dribbble" value="{{ old('dribbble') }}" class="form-control">

                </div>

                <div class=" col-xs-6 form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">

                    <label for="instagram">'instagram'</label>
                    {!! $errors->first('instagram', '<spam class="help-block">:message</spam>') !!}
                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}" class="form-control">

                </div>


        </div>

</div>
</div>
</div></div>
@stop
