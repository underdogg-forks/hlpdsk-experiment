@extends('themes.default1.agent.layout.agent')

@extends('themes.default1.agent.layout.sidebar')    
@section('PageHeader')
<h1>{{ trans('lang.comments') }}</h1>
@stop
@section('comment')
class="nav-link active"
@stop

@section('Tools')
class="nav-link active"
@stop

@section('tool')
class="active"
@stop

@section('kb')
class="nav-link active"
@stop

@section('content')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }} !</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.comments-list') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                {!! Datatable::table()
                ->addColumn(trans('lang.details'), 
                trans('lang.comment'),
                trans('lang.status'),
                trans('lang.action'))       // these are the column headings to be shown
                ->setUrl(route('api.comment'))   // this is the route where data will be retrieved
                ->render() !!}
            </div>
        </div>
    </div>
</div>

@stop