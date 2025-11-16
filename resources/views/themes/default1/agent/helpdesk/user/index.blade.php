@extends('themes.default1.agent.layout.agent')

@section('Users')
class="nav-link active"
@stop

@section('user-bar')
class="nav-link active"
@stop

@section('user')
class="active"
@stop

@section('user-directory')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.user_directory') }}</h1>
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

<!-- check whether success or not -->
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa  fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('warning'))
<div class="alert alert-warning alert-dismissable">
    <i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>{{ trans('lang.alert') }} !</b>            
    {{ session('warning') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>{{ trans('lang.alert') }} !</b>            
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">

    <div class="card-header">
        
        <h3 class="card-title">{{ trans('lang.user') }}</h3>

        <div class="card-tools">
            
            <div class="has-feedback" style="display: inline-block;">
                <input type="text" class="form-control input-sm m-0" id="search-text" name="search" placeholder="{{ trans('lang.search') }}">
            </div>

            <div class="btn-group">
        
                <button type="button" class="btn btn-tool btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-eye"> </i> {{ trans('lang.view-option') }}
                </button>
        
                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                    <a href="#" class="dropdown-item all active">{{ trans('lang.all-users') }}</a>
                    <a href="#" class="dropdown-item agents">{{ trans('lang.only-agents') }}</a>
                    <a href="#" class="dropdown-item users">{{ trans('lang.only-users') }}</a>
                    <a href="#" class="dropdown-item active-users">{{ trans('lang.active-users') }}</a>
                    <a href="#" class="dropdown-item inactive">{{ trans('lang.inactive-users') }}</a>
                    <a href="#" class="dropdown-item deleted">{{ trans('lang.deleted-users') }}</a>
                    <a href="#" class="dropdown-item banned">{{ trans('lang.banned-users') }}</a>
                </div>
            </div>
              
            <a href="{{url('user-export')}}" class="btn btn-tool btn-default">Export</a>
            
            <a href="{{route('user.create')}}" class="btn btn-tool btn-default">{{ trans('lang.create_user') }}</a>
        </div>
    </div>
    
    <div class="card-body">

        {!!$table->render('vendor.Chumper.template')!!}

        {!! $table->script('vendor.Chumper.user-javascript') !!}
    </div>
</div>
@stop
<!-- /content -->