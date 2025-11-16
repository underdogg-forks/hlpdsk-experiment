@extends('themes.default1.layouts.front.master')
@section('title')
pricing
@stop
@section('page-header')
Pricing
@stop
@section('breadcrumb')
<li><a href="{{url('home')}}">Home</a></li>
<li class="active">Pricing</li>
@stop
@section('main-class') 
main
@stop


@section('content')


<div class="row">
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
                    <b>{{ trans('message.alert') }}!</b> {{ trans('message.success') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
                @endif
                <!-- fail message -->
                @if(session()->has('fails'))
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <b>{{ trans('message.alert') }}!</b> {{ trans('message.failed') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('fails') }}
                </div>
                @endif
    
    <div class="col-md-12 col-md-offset-3">
        <div class="pricing-table princig-table-flat">
        {!! html_entity_decode($template) !!}
        </div>
    </div>

</div>

@stop

