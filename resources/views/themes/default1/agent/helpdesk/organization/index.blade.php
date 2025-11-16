    @extends('themes.default1.agent.layout.agent')

@section('Users')
class="nav-link active"
@stop

@section('user-bar')
active
@stop

@section('user')
class="active"
@stop

@section('organizations')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.organizations') }}</h1>
@stop
<!-- content -->
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

        <h3 class="card-title">{{ trans('lang.organization_list') }}</h3>

        <div class="card-tools">

            <a href="{{route('organizations.create')}}" class="btn btn-default btn-tool"><i class="fas fa-plus"> </i> {{ trans('lang.create_organization') }}</a>
        </div>

    </div>

    <div class="card-body">

        {!! Datatable::table()
        ->addColumn(trans('lang.name'),
        trans('lang.website'),
        trans('lang.phone'),
        trans('lang.action'))  // these are the column headings to be shown
        ->setUrl(route('org.list'))  // this is the route where data will be retrieved
        ->render() !!}
    </div>
</div>
@stop