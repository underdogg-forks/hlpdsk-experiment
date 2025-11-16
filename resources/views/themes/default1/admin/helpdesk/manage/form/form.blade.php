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
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif
@if(session()->has('warn'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('warn') }}
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.create') }}</h3>
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('forms.store') }}">
    @csrf

        <div class="row">
            <div class="form-group col-sm-6">
                <label>{{ trans('lang.form_name') }}: <span class="text-red"> *</span></label>
                <input type="text" name="formname" class="form-control">
            </div>
        </div>
        
        <div class="callout callout-default" style="font-style: oblique;">{{ trans('lang.instructions_on_creating_form') }}.</div>

        <div class="callout callout-default"> {{ trans('lang.click_add_fields_button_to_add_fields') }} </div>

        <div class="card card-light">
            
            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.adding_fields') }}</h3>
                <div class="card-tools"> 
                    <button type="button" class="btn btn-default btn-tool addField" value="Show Div" onclick="showDiv()" >
                        <i class="fas fa-plus"></i>&nbsp; {{ trans('lang.add_fields') }}
                    </button>
                </div>
            </div>

             <div class="card-body" id="welcomeDiv">
                <table id="example2" class="table table-bordered">
                    <thead>
                    <th>{{ trans('lang.label') }} </th>
                    <th>{{ trans('lang.name') }} </th>
                    <th>{{ trans('lang.type') }} </th>
                    <th>{!! trans('lang.values(selected_fields)') !!} </th>
                    <th>{{ trans('lang.required') }} </th>
                    <th>{{ trans('lang.action') }} </th>
                    </thead>
                    <tbody class="inputField">
                        
                        <tr>
                            <td><input type="text" class="form-control" name="label[]"></td>
                            <td><input type="text" class="form-control" name="name[]"></td>
                            <td>
                                <select name="type[]" class="form-control">
                                    <option>text</option>
                                    <option>email</option>
                                    <option>password</option>
                                    <option>textarea</option>
                                    <option>select</option>
                                    <option>radio</option>
                                    <option>checkbox</option>
                                    <option>hidden</option>
                                </select>
                            </td>
                            <td><input type="text" name="value[]" class="form-control"></td>
                            <td><input type=radio name="required[0]" value=1 checked>&nbsp;&nbsp;{{ trans("lang.yes") }}&nbsp;&nbsp;<input type=radio name="required[0]" value=0>&nbsp;&nbsp;{{ trans("lang.no") }}</td>
                            <td><button type="button" class="remove_field btn btn-danger"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div> 
        </div> 
    </div>
    <div class="card-footer">
        <input type="submit" class="btn btn-primary" value="{{ trans('lang.save_form') }}">
    </div>
</div>
</form>
<script>
    function showDiv() {
        document.getElementById('welcomeDiv').style.display = "block";
    }
    $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".inputField");
        var add_button = $(".addField");
        var x = 0;
        $(add_button).click(function(e)
        {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<tr><td><input type="text" class="form-control" name="label[]"></td><td><input type="text" class="form-control" name="name[]"></td><td><select name="type[]" class="form-control"><option>text</option><option>email</option><option>password</option><option>textarea</option><option>select</option><option>radio</option><option>checkbox</option><option>hidden</option></select></td><td><input type="text" name="value[]" class="form-control"></td><td><input type=radio name="required['+x+']" value=1 checked>&nbsp;&nbsp;{{ trans("lang.yes") }}&nbsp;&nbsp;<input type=radio name="required['+x+']" value=0>&nbsp;&nbsp;{{ trans("lang.no") }}</td><td><button type="button" class="remove_field btn btn-danger"><i class="fas fa-trash"></i></button></td></tr>');
            }
        });
        $(wrapper).on("click", ".remove_field", function(e)
        {
            e.preventDefault();
            $(this).closest('tr').remove();
            x--;
        });
    });
</script>
@stop

