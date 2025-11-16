@extends('themes.default1.client.layout.client')

@section('contact')
    class = "active"
@stop

@section('check')
<!-- Start of Page Container -->
<div style="padding-top: 60px;">

    @if($settings->address)
    <h2>Our Address</h2>
    {!! $settings->address !!}
    @endif
</div>
@stop
@section('content')
<div id="content" class="site-content col-md-9">
    <article class="type-page hentry clearfix">
        <h1 class="post-title">
            <a href="#">Contact us</a>
        </h1>
        <hr>
        <p></p>
    </article>
    <form method="POST">
    @csrf
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

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

        <label for="name">'Name'</label>
        {!! $errors->first('name', '<spam class="help-block">:message</spam>') !!}
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">

    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

        <label for="email">'Email'</label>
        {!! $errors->first('email', '<spam class="help-block">:message</spam>') !!}
        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">

    </div>

    <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">

        <label for="subject">'Subject'</label>
        {!! $errors->first('subject', '<spam class="help-block">:message</spam>') !!}
        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control">

    </div>

    <div class="form-group {{ $errors->has('message') ? 'has-	error' : '' }}">
        <label for="message">'Messege'</label>
        {!! $errors->first('message', '<spam class="help-block">:message</spam>') !!}
        <textarea name="message" id="message" class="form-control" rows="7">{{ old('message') }}</textarea>

    </div>
    <div>

        <button type="submit" class="form-group btn btn-primary">'Send Message'</button>

    </div>

    </form>


</div>

@stop