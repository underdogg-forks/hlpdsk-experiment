@extends('themes.default1.admin.layout.kb')
@section('content')
<!-- open a form -->

	<form method="POST">
    @csrf
    @method('PATCH')

<!-- <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}"> -->
	<!-- table  -->

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
	<div class="content-header">

		<div>
        	<h4>Faqs <button type="submit" class="form-group btn btn-primary pull-right">'save'</button></h4>
    	</div>

    </div>

    <!-- check whether success or not -->

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable">
        <i class="fa  fa-check-circle"></i>
        <b>Success!</b>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
    </div>
    @endif
    <!-- failure message -->
    @if(session()->has('fails'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <b>Alert!</b> Failed.
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('fails') }}
    </div>
    @endif

		<!-- Name text form Required -->
 		<div class="box-body table-responsive"style="overflow:hidden;">

            <div class="row">

        <div class="col-md-10 form-group {{ $errors->has('faq') ? 'has-error' : '' }}">
        <label for="faq">'Description'</label>
        {!! $errors->first('faq', '<spam class="help-block">:message</spam>') !!}

            <textarea name="faq" id="faq" class="form-control" rows="5">{{ old('faq') }}</textarea>

        </div>
            <script language="JavaScript" type="text/javascript">
                CKEDITOR.replace( 'faq',
                {
                        filebrowserUploadUrl : '/uploader/upload.php',

                });

                CKEDITOR.replace( 'faq', { toolbar : 'MyToolbar' } );
            </script>


        </div>
</div>
</div></div>
@stop
</div><!-- /.box -->
@section('FooterInclude')

@stop
@stop
<!-- /content -->

@stop