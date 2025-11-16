@extends('themes.default1.admin.layout.admin')

@section('Emails')
class="nav-link active"
@stop

@section('email-menu-parent')
class="nav-item menu-open"
@stop

@section('email-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('template')
class="nav-link active"
@stop

@section('PageHeader')
<h1>{{ trans('lang.templates') }}</h1>
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
    <b>{{ trans('lang.alert') }}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>{{ session('failed') }}</p>                
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.edit_templates') }}</h3>
    </div><!-- /.box-header -->
    <div class="card-body">
       
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ trans('lang.type') }}</th>
                    <th>{{ trans('lang.description') }}</th>
                    <th>{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($templates as $template)
                <tr>
                    <?php $type = App\Model\Common\TemplateType::where('id','=',$template->type)->first(); ?>
                    <td>{!! $type->name !!}</td>
                    <td>{!! $template->name !!}</td>
                    <td>
                        {!! link_to_route('templates.edit', trans('lang.edit_templates'),[$template->id],['class'=>'btn btn-success btn-sm']) !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div>

<!-- status script -->
<script type="text/javascript">
$(function() {
    $("#example1").dataTable();
    $('#example2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
    });
});
</script>
@stop