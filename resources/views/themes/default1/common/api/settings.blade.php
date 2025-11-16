@extends('themes.default1.admin.layout.admin')

@section('API')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ trans('lang.api') }}</h1>
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
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<!-- fail message -->
@if(session()->has('fails'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('fails') }}
</div>
@endif

<form method="POST" action="api" enctype="multipart/form-data">
    @csrf
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('lang.api_settings') }}</h3>     
    </div>
    <div class="card-body">

        <div class="card card-light">
            
            <div class="card-header">
                <h3 class="card-title">{{ trans('lang.api_configurations') }}</h3>
            </div>

            <div class="card-body">        
                <!-- Guest user page Content -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('api_enable') ? 'has-error' : '' }}">
                            <label for="api">{{ trans('lang.api') }}</label>
                            {!! $errors->first('api_enable', '<spam class="help-block">:message</spam>') !!}
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="radio" name="api_enable" value="1" @if($systems->api_enable ==1) checked @endif>&nbsp;{{ trans('lang.enable') }}
                                    <!-- <input type="radio" name="api_enable" value="'1'"> {{ trans('lang.enable') }} -->
                                </div>
                                <div class="col-sm-5">
                                    <input type="radio" name="api_enable" value="0" @if($systems->api_enable == 0) checked @endif>&nbsp;{{ trans('lang.disable') }}
                                    <!-- <input type="radio" name="api_enable" value="'0'"> {{ trans('lang.disable') }} -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('api_key_mandatory') ? 'has-error' : '' }}">
                            <label for="api_key_mandatory">{{ trans('lang.api_key_mandatory') }}</label>
                            {!! $errors->first('api_key_mandatory', '<spam class="help-block">:message</spam>') !!}
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="radio" name="api_key_mandatory" value="1" @if($systems->api_key_mandatory == 1) checked @endif>&nbsp;{{ trans('lang.enable') }}
                                    <!-- <input type="radio" name="api_key_mandatory" value="'1'"> {{ trans('lang.enable') }} -->
                                </div>
                                <div class="col-sm-5">
                                     <input type="radio" name="api_key_mandatory" value="0" @if($systems->api_key_mandatory == 0) checked @endif>&nbsp;{{ trans('lang.disable') }}
                                    <!-- <input type="radio" name="api_key_mandatory" value="'0'"> {{ trans('lang.disable') }} -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Date and Time Format: text: required: eg - 03/25/2015 7:14 am -->
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('api_key') ? 'has-error' : '' }}">
                            <label for="api_key">{{ trans('lang.api_key') }}</label>
                            {!! $errors->first('api_key', '<spam class="help-block">:message</spam>') !!}
                            <input type="text" name="api_key" id="api_key" value="$systems->api_key" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br/>
                        <a class="btn btn-primary" id="generate" href="javascript:;" style="margin-top: 8px;"> <i class="fas fa-sync"> </i> {{ trans('lang.generate_key') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-light">
            
            <div class="card-header">
                
                <h3 class="card-title">{{ trans('lang.webhooks') }}</h3>
            </div>

            <div class="card-body">
                
                <div class="row">
                    
                    <div class="form-group col-md-6 {{ $errors->has('ticket_detail') ? 'has-error' : '' }}">
                        <label for="ticket_detail" class="required">{{ trans('lang.enter_url_to_send_ticket_details') }}</label>
                        <input type="text" name="ticket_detail" id="ticket_detail" value="$ticket_detail" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('lang.update') }}</button> 
    </div>
    </form>   
</div>

<a href="#" id="clickGenerate" data-toggle="modal" data-target="#generateModal"></a>    
<div class="modal fade" id="generateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('lang.api_key') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="messageBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">{{ trans('lang.close') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
jQuery(document).ready(function() {
// Close a ticket
    $('#generate').on('click', function(e) {
        $.ajax({
            type: "GET",
            url: "{!! url('generate-api-key') !!}",
            beforeSend: function() {
                $("#generate").empty();
                var message = "<i class='fas fa-sync fa-spin'> </i>  <?php echo trans('lang.generate_key'); ?>";
                $('#generate').html(message);
            },
            success: function(response) {
                // alert(response);

                $("#messageBody").empty();
                var message = "<div class='alert alert-info mb-0'>Copy and paste in the api to set a different Api key</div> <br/><b>Api key</b> : " + response;
                $('#messageBody').html(message);

                $('#clickGenerate').trigger("click");
                $("#generate").empty();
                var message = "<i class='fas fa-sync'> </i>  <?php echo trans('lang.generate_key'); ?>";
                $('#generate').html(message);
            }
        })
        return false;
    });
});
</script>
@stop
