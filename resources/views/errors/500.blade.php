@extends('themes.default1.client.layout.client')
@section('breadcrumb')
    {{--<div class="site-hero clearfix">--}}
    <ol class="breadcrumb float-sm-right ">
        <style>
            .words {
                margin-right: 10px; /* Adjust the value to increase or decrease the gap between list items */
            }
        </style>
        <li class="breadcrumb-item"> <i class="fas fa-home"> </i> {{ trans('lang.you_are_here') }} : &nbsp;</li>
        <li><a  class="words" href="{{url('/')}}">{{ trans('lang.home') }}</a></li>
        @stop
@section('content')  
<div id="page" class="hfeed site">
    <article class="hentry error404 text-center" style="margin-left: 300px;">
        <h1 class="error-title mb-0">5<i class="fas fa-frown text-info"></i><span class="visible-print text-danger" style="display: none;">0</span><i class="fas fa-frown text-info"></i><span class="visible-print text-danger" style="display: none;">0</span></h1>
        <h2 class="entry-title text-muted">{{ trans('lang.sorry_something_went_wrong') }}</h2>
        <div class="entry-content clearfix">
            <p class="lead">{{ trans('lang.were_working_on_it_and_well_get_it_fixed_as_soon_as_we_can') }}</p>
            <p><a onclick="goBack()" href="#">{{ trans('lang.go_back') }}</a></p>
        </div><!-- .entry-content -->
    </article><!-- .hentry -->
</div><!-- #page -->

<script>
    function goBack() {
        window.history.back();
    }
</script>
@stop