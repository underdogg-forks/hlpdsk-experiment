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

<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.forms') }}</h1>
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
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
@if(session()->has('fails'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>{{ trans('lang.alert') }} !</b> <br>
    <li class="error-message-padding">{{ session('fails') }}</li>
</div>
@endif
<!-- -->    
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.form_name') }} : {!! $form->formname !!}</h3>
    </div>
    <div class="card-body">
        @foreach($fields as $field)
        <?php
        $form = App\Http\Controllers\Admin\helpdesk\FormController::getForm($field);
        ?>

        {!! $form !!}
          
        @endforeach         
    </div>
</div>
@stop
@section('FooterInclude')

@stop
