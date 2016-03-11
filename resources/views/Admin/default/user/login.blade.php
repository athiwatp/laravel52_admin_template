@extends( $__theme . '.layouts.login')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ Lang::get('layouts.login_form.please_sign_in') }}</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => URL::route('admin.login.post'), 'role'=>'form', 'method' => 'POST')) }}
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{ Lang::get('layouts.login_form.email') }}" name="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{ Lang::get('layouts.login_form.password') }}" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">{{ Lang::get('layouts.login_form.remember_me') }}
                            </label>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">{{ Lang::get('layouts.login_form.login') }}</button>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection