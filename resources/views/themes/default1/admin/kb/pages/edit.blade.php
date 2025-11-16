@extends('themes.default1.admin.layout.kb')

@section('pages')
    active
@stop
@section('all-pages')
    class="active"
@stop
<script type="text/javascript" src="{{asset('dist/js/EditnicEdit.js')}}"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

@section('content')

	<form method="POST">
    @csrf
    @method('PATCH')

<!-- <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}"> -->
	<!-- table  -->

<div class="box-body">

    <div class="row">

    <div class="col-md-9">

    <div class="row">
        <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">

            <label for="name">{{ trans('lang.name') }}</label>
            {!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">

        </div>

        <div class="col-md-6 form-group {{ $errors->has('slug') ? 'has-error' : '' }}">

            <label for="slug">{{ trans('lang.slug') }}</label>
            {!! $errors->first('slug', '<spam class="help-block">:message</spam>') !!}
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">

        </div>
    </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">{{ trans('lang.description') }}</label>
                    {!! $errors->first('description', '<spam class="help-block">:message</spam>') !!}

                    <div class="form-group" style="background-color:white">
                    <textarea name="description" id="myNicEditor" class="form-control color" rows="15">{{ old('description') }}</textarea>
                </div>
                </div>

            </div>

            <div class="col-md-3">
    <div class="box box-default">
    <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('lang.publish') }}</h3>
    </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">

                        <label for="status">{{ trans('lang.status') }}</label>
                        {!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}
                        <div class="row">
                            <div class="col-xs-4">
                                <input type="radio" name="status" value="1">{{ trans('lang.published') }}
                            </div>
                            <div class="col-xs-3">
                                <input type="radio" name="status" value="0">{{ trans('lang.draft') }}
                            </div>
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('visibility') ? 'has-error' : '' }}">

                        <label for="visibility">{{ trans('lang.visibility') }}</label>
                        {!! $errors->first('visibility', '<spam class="help-block">:message</spam>') !!}
                        <div class="row">
                            <div class="col-xs-3">
                                <input type="radio" name="visibility" value="'1'">{{ trans('lang.public') }}
                                </div>
                                <div class="row">
                            <div class="col-xs-3">
                                <input type="radio" name="visibility" value="'0'">{{ trans('lang.private') }}
                                </div>
                    </div>

                </div>

            </div>
       </div>

        <div class="box-footer" style="background-color:#f5f5f5;">
        <div style="margin-left:140px;">

                <button type="submit" class="btn btn-primary">{{ trans('lang.publish') }}</button>
        </div>

        </div>

    </div>
</div>
</div>
</div>
@stop
@section('FooterInclude')

@stop

<!-- /content -->
