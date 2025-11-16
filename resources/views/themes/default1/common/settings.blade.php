@extends('themes.default1.layouts.master')
@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="box">

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
                <i class="fa fa-ban"></i>
                <b>{{ trans('message.alert') }}!</b> {{ trans('message.success') }}.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
            </div>
            @endif
            <!-- fail message -->
            @if(session()->has('fails'))
            <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <b>{{ trans('message.alert') }}!</b> {{ trans('message.failed') }}.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('fails') }}
            </div>
            @endif

            <div class="box-body no-padding">
                <form method="POST">
    @csrf
    @method('PATCH')

                <table class="table table-condensed">

                    <tr>
                        <td><h3 class="box-title">{{ trans('message.company') }}</h3></td>
                        <td><button type="submit" class="btn btn-primary pull-right">{{ trans('message.update') }}</button></td>

                    </tr>

                    <tr>

                        <td><b><label for="company" class="required">{{ trans('message.company') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">


                                <input type="text" name="company" id="company" value="{{ old('company') }}" class="form-control">
                                <p><i> {{ trans('message.enter-the-company-name') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="website">{{ trans('message.website') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">


                                <input type="text" name="website" id="website" value="{{ old('website') }}" class="form-control">
                                <p><i> {{ trans('message.enter-the-company-website') }}</i> </p>

                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="phone">{{ trans('message.phone') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">


                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
                                <p><i> {{ trans('message.enter-the-company-phone-number') }}</i> </p>

                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="address" class="required">{{ trans('message.address') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">

                                <textarea name="address" id="address" class="form-control" rows="10">{{ old('address') }}</textarea>
                                <p><i> {{ trans('message.enter-company-address') }}</i> </p>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="logo">{{ trans('message.logo') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">

                                <input type="file" name="logo" id="logo">
                                <p><i> {{ trans('message.enter-the-company-logo') }}</i> </p>
                                @if($setting->logo) 
                                <img src="{{asset('cart/img/logo/'.$setting->logo)}}" class="img-thumbnail" style="height: 100px;">
                                @endif
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td><h3 class="box-title">{{ trans('message.smtp') }}</h3></td>
                        <td></td>
                    </tr>
                    <tr>

                        <td><b><label for="driver" class="required">{{ trans('message.driver') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">


                                <select name="driver" id="driver" class="form-control">
    @foreach(['mail'=>'Mail','smtp'=>'SMTP'] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.select-email-driver') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="port">{{ trans('message.port') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('port') ? 'has-error' : '' }}">


                                <input type="text" name="port" id="port" value="{{ old('port') }}" class="form-control">
                                <p><i> {{ trans('message.enter-email-port') }}</i> </p>

                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="host">{{ trans('message.host') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('host') ? 'has-error' : '' }}">


                                <input type="text" name="host" id="host" value="{{ old('host') }}" class="form-control">
                                <p><i> {{ trans('message.enter-email-host') }}</i> </p>

                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="encryption">{{ trans('message.encryption') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('encryption') ? 'has-error' : '' }}">

                                <input type="text" name="encryption" id="encryption" value="{{ old('encryption') }}" class="form-control">
                                <p><i> {{ trans('message.select-email-encryption-method') }}</i> </p>

                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="email" class="required">{{ trans('message.email') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
                                <p><i> {{ trans('message.enter-email') }}</i> </p>

                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="password" class="required">{{ trans('message.password') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">

                                <input type="password" name="password" id="password" class="form-control">
                                <p><i> {{ trans('message.enter-email-password') }}</i> </p>

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td><h3 class="box-title">{{ trans('message.error-log') }}</h3></td>
                        <td></td>
                    </tr>

                    <tr>

                        <td><b><label for="error_log">{{ trans('message.error-log') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('error_log') ? 'has-error' : '' }}">


                                <input type="radio" name="error_log" value="'1'"><span>   {{ trans('message.yes') }}</span>
                                <input type="radio" name="error_log" value="'0'"><span>   {{ trans('message.no') }}</span>
                                <p><i> {{ trans('message.enable-error-logging') }}</i> </p>


                            </div>
                        </td>

                    </tr>

                    <tr>

                        <td><b><label for="error_email">{{ trans('message.error-email') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('error_email') ? 'has-error' : '' }}">


                                <input type="text" name="error_email" id="error_email" value="{{ old('error_email') }}" class="form-control">
                                <p><i> {{ trans('message.provide-error-reporting-email') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    
                    <tr>
                        <td><h3 class="box-title">{{ trans('message.templates') }}</h3></td>
                        <td></td>
                    </tr>

                    <tr>

                        <td><b><label for="welcome_mail">{{ trans('message.welcome-mail') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('welcome_mail') ? 'has-error' : '' }}">


                                <select name="welcome_mail" id="welcome_mail" class="form-control">
    @foreach(['Templates'=>$template->where('type',1)->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.choose-welcome-mail-template') }}</i> </p>


                            </div>
                        </td>

                    </tr>

                    <tr>

                        <td><b><label for="order_mail">{{ trans('message.order-mail') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('order_mail') ? 'has-error' : '' }}">


                                <select name="order_mail" id="order_mail" class="form-control">
    @foreach(['Templates'=>$template->where('type',7)->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.choose-order-mail-template') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="forgot_password">{{ trans('message.forgot-password') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('forgot_password') ? 'has-error' : '' }}">


                                <select name="forgot_password" id="forgot_password" class="form-control">
    @foreach(['Templates'=>$template->where('type',2)->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.choose-forgot-password-mail-template') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="subscription_going_to_end">{{ trans('message.subscription-going-to-end') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('subscription_going_to_end') ? 'has-error' : '' }}">


                                <select name="subscription_going_to_end" id="subscription_going_to_end" class="form-control">
    @foreach(['Templates'=>$template->where('type',4)->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.choose-subscription-going-to-end-notification-email-template') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="subscription_over">{{ trans('message.subscription-over') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('subscription_over') ? 'has-error' : '' }}">


                                <select name="subscription_over" id="subscription_over" class="form-control">
    @foreach(['Templates'=>$template->where('type',5)->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.choose-mail-template-to-notify-subscription-has-over') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td><b><label for="cart">{{ trans('message.cart') }}</label></b></td>
                        <td>
                            <div class="form-group {{ $errors->has('cart') ? 'has-error' : '' }}">


                                <select name="cart" id="cart" class="form-control">
    @foreach(['Templates'=>$template->where('type',3)->pluck('name','id')->toArray()] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value as $subKey => $subValue)
                    <option value="{{ $subKey }}">{{ $subValue }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
                                <p><i> {{ trans('message.choose-shoping-cart-template') }}</i> </p>


                            </div>
                        </td>

                    </tr>
                    
                    </form>
                </table>



            </div>

        </div>
        <!-- /.box -->

    </div>


</div>

@stop