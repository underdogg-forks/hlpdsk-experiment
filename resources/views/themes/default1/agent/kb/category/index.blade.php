@extends('themes.default1.agent.layout.agent')

@extends('themes.default1.agent.layout.sidebar')    

@section('PageHeader')
<h1>{{ trans('lang.category') }}</h1>
@stop

@section('category-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('category-menu-parent')
class="nav-item menu-open"
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

@section('all-category')
class="nav-link active"
@stop

@section('category')
class="nav-link active"
@stop

@section('content')
<!-- check whether success or not -->
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
        <h3 class="card-title">{{ trans('lang.allcategory') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                {!! Datatable::table()
                ->addColumn(trans('lang.name'),
                trans('lang.create'),
                trans('lang.action'))       // these are the column headings to be shown
                ->setUrl(route('api.category'))   // this is the route where data will be retrieved
                ->render() !!}
            </div>
        </div>
    </div>
</div>
@stop