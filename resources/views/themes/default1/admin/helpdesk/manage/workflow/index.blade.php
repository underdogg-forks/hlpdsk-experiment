@extends('themes.default1.admin.layout.admin')

@section('Manage')
class="nav-link active"
@stop

@section('manage-menu-parent')
class="nav-item menu-open"
@stop

@section('manage-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('workflow')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.manage') }}</h1>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')
<!-- check whether success or not -->
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa  fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- failure message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{{ trans('lang.alert') }} !</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.ticket_workflow') }}</h3>
        <div class="card-tools">
            <a href="{!! URL::route('workflow.create') !!}" class="btn btn-default btn-tool">
                <span class="fas fa-plus"></span>&nbsp;{{ trans('lang.create') }}
            </a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="card-body">
        {!! Datatable::table()
        ->addColumn(trans('lang.name'),
        trans('lang.status'),
        trans('lang.order'),
        trans('lang.rules'),
        trans('lang.target_channel'),
        trans('lang.created'),
        trans('lang.updated'),
        trans('lang.action')) // these are the column headings to be shown
        ->setUrl(route('workflow.list'))   // this is the route where data will be retrieved
        ->render() !!}
    </div>
    <!-- </div> -->
</div>
<!-- /.box -->

<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
@stop
