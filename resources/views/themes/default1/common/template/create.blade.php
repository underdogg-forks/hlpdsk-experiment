@extends('themes.default1.admin.layout.admin')
@section('content')
<div class="box box-primary">

    <div class="content-header">
        <form method="POST" action="{{ route('templates.store') }}">
    @csrf
        <h4>{{ trans('lang.templates') }}	{!! Form::submit(trans('lang.save'),['class'=>'form-group btn btn-primary pull-right'])!!}</h4>

    </div>

    <div class="box-body">

        <div class="row">

            <div class="col-md-12">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <b>{{ trans('lang.alert') }}!</b> {{ trans('lang.success') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
                @endif
                <!-- fail lang -->
                @if(session()->has('fails'))
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <b>{{ trans('lang.alert') }}!</b> {{ trans('lang.failed') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('fails') }}
                </div>
                @endif

                <div class="row">

                    <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <!-- first name -->
                        {!! Form::label('name',trans('lang.name'),['class'=>'required']) !!}
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">

                    </div>

                    <div class="col-md-6 form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <!-- last name -->
                        {!! Form::label('type',trans('lang.template-types'),['class'=>'required']) !!}
                        <select name="type" id="type" class="form-control">
    @foreach([''=>'Select','Type'=>$type] as $key => $value)
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
                                        

                </div>
<!--                <div class="row">
                    <div class="col-md-12 form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
         
                        <label for="subject">{{ trans('lang.subject') }}</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control">

                    </div>
                </div>-->

                <div class="row">
                    <div class="col-md-12 form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                       
                        
                        {!! Form::label('message',trans('lang.content'),['class'=>'required']) !!}
                        <textarea name="message" id="textarea" class="form-control">{{ old('message') }}</textarea>
                       
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


</form>
@stop