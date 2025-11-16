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

@section('forms')
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
<ol class="breadcrumb">
</ol>
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.forms') }}</h3>
        <div class="card-tools">
            <a href="{!! url('forms/create') !!}" class="btn btn-default btn-tool">
                <span class="fas fa-plus"></span>&nbsp;{{ trans('lang.create_form') }}
            </a>
        </div>
    </div>

    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ trans('lang.form_name') }}</th>
                    <th>{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $forms = App\Model\helpdesk\Form\Forms::all();
                ?>
                @foreach($forms as $form)
                <tr>
                    <td>{!! $form->formname !!}</td>
                    <td>
                        <div class="btn-group">
                            {!! link_to_route('forms.edit', trans('lang.edit') ,[$form->id],['id'=>'View','class'=>'btn btn-primary btn-sm']) !!}
                        </div>
                        <div class="btn-group">
                            {!! link_to_route('forms.show', trans('lang.view_this_form') ,[$form->id],['id'=>'View','class'=>'btn btn-primary btn-sm']) !!}
                        </div>
                        <div class="btn-group">
                            {!! link_to_route('forms.add.child', trans('lang.add-child') ,[$form->id],['id'=>'add-child','class'=>'btn btn-primary btn-sm']) !!}
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$form->id}}">{{ trans('lang.delete_from') }}
                            </button>
                        </div>
                        <div class="modal fade" id="delete{{$form->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('lang.delete') }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>{{ trans('lang.are_you_sure_you_want_to_delete') }} ?</span>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('lang.close') }}</button>
                                        {!! link_to_route('forms.delete', trans('lang.delete'),[$form->id],['id'=>'delete','class'=>'btn btn-danger']) !!}
                                    </div>
                                </div> 
                            </div> 
                        </div> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
</div>
@stop