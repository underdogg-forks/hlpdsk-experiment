@extends('themes.default1.admin.layout.kb')

@section('pages')
    active
@stop
@section('add-pages')
    class="active"
@stop
<script type="text/javascript" src="{{asset('lb-faveo/dist/js/nicEdit.js')}}"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
@section('content')
<form method="POST" action="{{ action('Admin\kb\PageController@store') }}">
    @csrf


    <div class="box-body">
    <div class="row">
    
    <div class="col-md-9">
    <div class="box box-primary">
    <div class="box-header">  
        <h3 class="box-title">Add Pages</h3>
    </div>
    <div class="box-body">  
    <div class="row">
        <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">

            {!! Form::label('name',trans('lang.name')) !!}
            {!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">

        </div>

        <div class="col-md-6 form-group {{ $errors->has('slug') ? 'has-error' : '' }}">

            {!! Form::label('slug',trans('lang.slug')) !!}
            {!! $errors->first('slug', '<spam class="help-block">:message</spam>') !!}
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">

        </div>
    </div>


                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! Form::label('description',trans('lang.description')) !!}
                    {!! $errors->first('description', '<spam class="help-block">:message</spam>') !!}

                    <div class="form-group" style="background-color:white">
                    <textarea name="description" id="myNicEditor" class="form-control color" rows="15">{{ old('description') }}</textarea>
                </div>
                </div>

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

                        {!! Form::label('status',trans('lang.status')) !!}
                        {!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}
                        <div class="row">
                            <div class="col-xs-4">
                                <input type="radio" name="status" value="'1'">{{ trans('lang.published') }}
                            </div>
                            <div class="col-xs-3">
                                <input type="radio" name="status" value="'0'">{{ trans('lang.draft') }}
                            </div>
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('visibility') ? 'has-error' : '' }}">

                        {!! Form::label('visibility',trans('lang.visibility')) !!}
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

                {!! Form::submit(trans('lang.publish'),['class'=>'btn btn-primary'])!!}
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
