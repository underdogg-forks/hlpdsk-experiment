@extends('themes.default1.layouts.login')

@section('body')
@if(Session::has('status'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-check-circle"> </i> <b> {{ trans('lang.success') }} </b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('status') }}
</div>
@endif
<!-- failure message -->
@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{{ trans('lang.alert') }} !</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($errors->all() as $error)
    <li class="error-message-padding">{{ $error }}</li>
    @endforeach
</div>
@endif

<div id="corewidgetbox" class="wid">
            
    <div id="wbox" class="widgetrow text-center">
        
        @if(Auth::user())
        @else
        <span onclick="javascript: window.location.href='{{url('auth/register')}}';">
            <a href="{{url('auth/register')}}"  class="widgetrowitem defaultwidget"  style="background-image:url({{ URL::asset('lb-faveo/media/images/register.png') }})">
                <span class="widgetitemtitle">{{ trans('lang.register') }}</span>
            </a>
        </span>
        @endif
        <?php $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();            
        ?>
        @if($system != null) 
            @if($system->status) 
                @if($system->status == 1)
                    <span onclick="javascript: window.location.href='{!! URL::route('form') !!}';">
                        <a href="{!! URL::route('form') !!}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/submitticket.png') }})">
                            <span class="widgetitemtitle">{{ trans('lang.submit_a_ticket') }}</span>
                        </a>
                    </span>
                @endif
            @endif
        @endif
        <span onclick="javascript: window.location.href='{{url('mytickets')}}';">
            <a href="{{url('mytickets')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/news.png') }})">
                <span class="widgetitemtitle">{{ trans('lang.my_tickets') }}</span>
            </a>
        </span>
        <span onclick="javascript: window.location.href='{{url('/knowledgebase')}}';">
            <a href="{{url('/knowledgebase')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/knowledgebase.png') }})">
                <span class="widgetitemtitle">{{ trans('lang.knowledge_base') }}</span>
            </a>
        </span>
    </div>
</div>

        <script type="text/javascript"> $(function(){ $('.dialogerror, .dialoginfo, .dialogalert').fadeIn('slow');$("form").bind("submit", function(e){$(this).find("input:submit").attr("disabled", "disabled");});});</script>
        <script type="text/javascript" >try {if (top.location.hostname != self.location.hostname) { throw 1; }} catch (e) { top.location.href = self.location.href; }</script>
        
<div class="col-md-6 offset-md-3 form-helper">

    <div valign="center" class="login-box" style="width: auto;">

        <div class="form-border">

            <h3 style="text-align: center;">{{ trans('lang.reset_password') }}</h3> 

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <input type="hidden" name="token" value="{{ $token }}">
                <!-- Email -->
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}" style="display: -webkit-box;">
                
                    <input type="email" class="form-control" name="email" placeholder="{{ trans('lang.e-mail') }}" value="{{ $email }}" readonly>
                
                    <span class="far fa-envelope text-muted  form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                </div>
                
                <!-- password -->
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}" style="display: -webkit-box;">
                
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('lang.password') }}">
                
                    <span class="fa fa-lock form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                </div>

                <!-- confirm password -->
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}" style="display: -webkit-box;">
                    
                    <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('lang.confirm_password') }}">
                    
                    <span class="fas fa-sign-in-alt  form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                </div>
                <!-- Confirm password -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        <i class="fas fa-sync"> </i> 
                        {{ trans('lang.reset_password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop