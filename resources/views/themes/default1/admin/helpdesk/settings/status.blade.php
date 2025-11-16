@extends('themes.default1.admin.layout.admin')

@section('Tickets')
class="nav-link active"
@stop

@section('ticket-menu-parent')
class="nav-item menu-open"
@stop

@section('ticket-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('status')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.settings') }}</h1>
@stop

@section('breadcrumbs')
<ol class="breadcrumb">
</ol>
@stop

@section('content')
@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
@if(Session::has('failed'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }} !</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>{{ session('failed') }}</p>                
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.list_of_status') }}</h3>
    </div><!-- /.box-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ trans('lang.name') }}</th>
                    <th>{{ trans('lang.display_order') }}</th>
                    <th>{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statuss as $status)
                <?php if ($status->name == 'Deleted') continue; ?>
                <tr>
                    <td>{!! $status->name !!}</td>
                    <td>{!! $status->sort !!}</td>
                    <td>
                        <a href="{!! route('status.edit',$status->id) !!}"><button class="btn btn-primary btn-sm">{{ trans('lang.edit_details') }}</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div>
@stop