@extends('themes.default1.client.layout.client')
<!-- breadcrumbs -->
@section('breadcrumb')
    <div class="site-hero clearfix">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="text">You are here: </li>

            <li><a href="#">Home</a></li>
            <li>Submit Ticket</a></li>
        </ol>
    </div>
@stop
<!-- /breadcrumbs -->
@section('check')
	<div class="banner-wrapper text-center clearfix">
		<h3 class="banner-title text-info h4">Have a Ticket?</h3>
        <div class="banner-content">
        <form method="POST" action="checkmyticket">
    @csrf

            <label for="email">{{ trans('lang.email') }}</label>
    		{!! $errors->first('email', '<spam class="help-block">:message</spam>') !!}
    		<input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">

            {!! Form::label('ticket_number',trans('lang.ticket_number'),['style' => 'display: block']) !!}
    		{!! $errors->first('ticket_number', '<spam class="help-block">:message</spam>') !!}
    		<input type="text" name="ticket_number" id="ticket_number" value="{{ old('ticket_number') }}" class="form-control">
            <br/><input type="submit" value="Check Ticket Status" class="btn btn-info">

        </form>
		</div>
	</div>
@stop
<!-- content -->
@section('content')
<div id="content" class="site-content col-md-9">
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissable">
        <i class="fa  fa-check-circle"></i>
        <b>Success!</b>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('message') }}
    </div>
    @endif

<!-- open a form -->
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> --}}
<script src="{{asset("lb-faveo/dist/js/jquery2.0.2.min.js")}}" type="text/javascript"></script>

<!--
|====================================================
| SELECT FROM
|====================================================
 -->
<?php
    $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
 ?>
<input id="token" type="hidden" value="{{$encrypted_token}}">
<form method="POST" action="{{ route('client.form.post') }}">
    @csrf
<div>
    <div class="content-header">
        <h4>Ticket <button type="submit" class="form-group btn btn-info pull-right">{{ trans('lang.send') }}</button></h4>
    </div>
    <br/>
    <div>
        @if($errors != null)
        <div class="alert alert-danger alert-dismissable">
            <i class="fa  fa-check-circle"></i>
            <b>Alert!</b>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! $errors->first('Name', '<p>:message</p>') !!}
            {!! $errors->first('Email', '<p>:message</p>') !!}
            {!! $errors->first('Phone', '<p>:message</p>') !!}
            {!! $errors->first('Subject', '<p>:message</p>') !!}
            {!! $errors->first('Details', '<p>:message</p>') !!}
        </div>
        @endif

		<div class="form-group {{ $errors->has('help_topic') ? 'has-error' : '' }}">
			<label for="help_topic">'Choose a Help Topic'</label>
			{!! $errors->first('help_topic', '<spam class="help-block">:message</spam>') !!}
            <select name="help_topic" class="form-control" id="selectid">
                <option>--Select--</option>
                <option value="1">Default Help Topic</option>
            </select>
		</div>


<!-- <label>data</label> -->
<!-- <input name="stack" id="stack"/> -->

    <div id="ss" class="xs-md-6 form-group {{ $errors->has('') ? 'has-error' : '' }}">

    </div>
</div>
</div>
</form>
</div>
<!--
|====================================================
| SELECTED FORM STORED IN SCRIPT
|====================================================
 -->
<script type="text/javascript">
jQuery(document).ready(function() {

    $('select').on('change', function (e) {

        var value = $('#selectid').val();
        var select = $('#selectid');
        var $_token = $('#token').val();
        var data1 = $(this).children('option:selected').data('id');
        $.ajax({
            type        :   "POST",
            headers		: 	{ 'X-XSRF-TOKEN' : $_token },
            url         :   "postform/"+ value,
            dataType    :   'html',
            data        :   ({data2:data1}) ,

            success : function(response) {

                    var data  = response;
                    var splited = data.split(',').slice(1);
        $.each(splited, function (index, value)
        {
        	var splited = data.split(',').slice(1);
            $("#ss").html("");
        		for (var j = 0 ; j<splited.length; j++)
        		{
                    var sli = splited[j].split('-');
                    if(sli[0]=='textarea')
                    {
                        $("#ss").append(sli[1]+"<div class="+'"form-group"'+">"
                        +"<textarea id="+sli[1]+" class="+
                        'form-control'+" name="+sli[1]+"/></textarea>"+"</div>");
                        var wysihtml5Editor = $('textarea').wysihtml5().data("wysihtml5").editor;
                    } else {
                        $("#ss").append(sli[1]+"<div class="+'"form-group"'+">"
                        +"<input type="+sli[0]+" id="+sli[1]+" class="+
                        'form-control'+" name="+sli[1]+">"+"</div>");
        	        }
                }
        		return false;
            });
        }
        })
        return false;
    });
});
</script>

@stop

