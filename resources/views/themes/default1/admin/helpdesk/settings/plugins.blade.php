@extends('themes.default1.admin.layout.admin')

@section('Plugins')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.plugins') }}</h1>
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
<div class="alert alert-info alert-dismissable">
    <i class="fas fa-info-circle"></i>
    <span>{{ trans('lang.plugin-info') }}</span><br/>
    <a href="http://www.faveohelpdesk.com/plugins/" target="_blank">{{ trans('lang.click-here') }}</a>&nbsp;{{ trans('lang.plugin-info-pro') }}
</div>
@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{{ trans('lang.alert') }}!</b><br/>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.plugins-list') }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-default btn-tool" id="Edit_Ticket" data-toggle="modal" data-target="#Edit">
                <i class="fas fa-plus"></i> {{ trans('lang.add_plugin') }}
            </button> 

            <div class="modal fade" id="Edit">
                <div class="modal-dialog">
                    <div class="modal-content">  
                        <div class="modal-header">
                            <h4 class="modal-title">{{ trans('lang.add_plugin') }}</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['url'=>'post-plugin','files'=>true]) !!}
                            <label>{{ trans('lang.plugin') }} :</label> 
                            <div class="btn bg-olive btn-file" style="color:blue">
                                {{ trans('lang.upload_file') }}<input type="file" name="plugin">
                            </div>
                        </div><!-- /.modal-content -->   
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="dismis">{{ trans('lang.close') }}</button>
                            <input type="submit" class="btn btn-primary" value="{{ trans('lang.upload') }}">
                        </div>
                        </form>
                    </div>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->           
        </div>
    </div>
    <div class="card-body">
        
        {!! Datatable::table()
    ->addColumn(
        trans('lang.name'),
        trans('lang.description'), // Translate the 'Description' column heading
        trans('lang.author'),      // Translate the 'Author' column heading
        trans('lang.website'),     // Translate the 'Website' column heading
        trans('lang.version')      // Translate the 'Version' column heading
    )        ->setUrl('getplugin')   // this is the route where data will be retrieved
        ->render() !!}
    </div>
</div>
@stop
