@extends('themes.default1.admin.layout.kb')

@section('article')
    active
@stop

@section('all-article')
    class="active"
@stop

<script type="text/javascript" src="{{asset('dist/js/EditnicEdit.js')}}"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
    nicEditors.editors.push(
        new nicEditor().panelInstance(
            document.getElementById('myNicEditor')
        ));
});
</script>

@section('content')
<form method="POST">
    @csrf
    @method('PATCH')

<div class="row">
		<div class="box-body" >
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
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('fails') }}
    </div>
    @endif
			<div class="col-md-9">

			<div class="row">

				<div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}" >

					{!! Form::label('name',trans('lang.name')) !!}
					{!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
					<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
				</div>

				<div class="col-md-6 form-group {{ $errors->has('slug') ? 'has-error' : '' }}" >

					{!! Form::label('slug',trans('lang.slug')) !!}
					{!! $errors->first('slug', '<spam class="help-block">:message</spam>') !!}
					<input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">
				</div>
			</div>

				<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
				{!! Form::label('description',trans('lang.description')) !!}
				{!! $errors->first('description', '<spam class="help-block">:message</spam>') !!}
				<div class="form-group" style="background-color:white">
					<textarea name="description" id="myNicEditor" class="form-control" rows="20">{{ old('description') }}</textarea>
				</div>
				</div>
			</div>

		</div>

	<ul style="list-style-type:none;">
	<li>
	<div class="col-md-3">
	<div class="box box-default">
	<div class="box-header with-border">
              <h3 class="box-title">{{ trans('lang.publish') }}</h3>
	</div>
				<div class="box-body">
					<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">

						{!! Form::label('type',trans('lang.status')) !!}
						{!! $errors->first('type', '<spam class="help-block">:message</spam>') !!}
						<div class="row">
							<div class="col-xs-4">
								<input type="radio" name="type" value="'1'">{{ trans('lang.published') }}
							</div>
							<div class="col-xs-3">
								<input type="radio" name="type" value="'0'">{{ trans('lang.draft') }}
							</div>
						</div>
					</div>


					<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">

						{!! Form::label('status',trans('lang.visibility')) !!}
						{!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}
						<div class="row">
							<div class="col-xs-3">
								<input type="radio" name="status" value="'1'">{{ trans('lang.public') }}
								</div>
								<div class="row">
							<div class="col-xs-3">
								<input type="radio" name="status" value="'0'">{{ trans('lang.private') }}
								</div>
					</div>

				</div>

			</div>
		</div>
		</form>
		<div class="box-footer" style="background-color:#f5f5f5;">
		<div style="margin-left:140px;">

				{!! Form::submit(trans('lang.publish'),['class'=>'btn btn-block btn-primary btn-sm'])!!}
		</div>

		</div>

		</li>
<li>
<div class="col-md-3">
	<div class="box box-default">
				<div class="box-header with-border">
                  <h3 class="box-title">{{ trans('lang.category') }}</h3>
                </div>
			<div class="box-body" style="height:190px; overflow-y:auto;">

				<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
		{{-- <label for="category_id">'Category'</label> --}}
				{!! $errors->first('category_id', '<spam class="help-block">:message</spam>') !!}
			@while (list($key, $val) = each($category))
			<div class="row">
						<div class="form-group">
							<div class="col-md-1">
			<input type="checkbox" name="category_id[]" value="<?php echo $val;?>" <?php if (in_array($val, $assign)) {
	echo ('checked');
}
?> ></div>
							<div class="col-md-10">
								<?php echo $key;?>
							</div>
						</div>
					</div>
					@endwhile

				</div>
		</div>

		<div class="box-footer" style="background-color:#f5f5f5;">

				<span class="btn btn-info btn-sm" data-toggle="modal" data-target="#j">Add Category</span>
				<div class="modal" id="j">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form method="POST">
    @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{ trans('lang.addcategory') }}</h4>
                            </div>
                            <div class="modal-body">
                               	@include('themes.default1.admin.category.form')
                            </div>
                            <div class="modal-footer">
                              	<div class="form-group">
                                    <button type="submit">'Add'</button>
                                </div>
                            	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                      	</div>
                     </div>
                    </div>

		</div>
	</div>
</div>

</li>
</ul>




{{-- </form> --}}
@stop
