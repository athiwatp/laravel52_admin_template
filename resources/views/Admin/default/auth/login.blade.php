@extends('Admin.default.layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Lang::get('users.auth.log_in') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ Lang::get('users.auth.e-mail') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ Lang::get('users.auth.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">{{ Lang::get('users.auth.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> {{ Lang::get('users.auth.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ Lang::get('users.auth.forgot_your_password') }}</a>
                            </div>
                        </div>
                        @if( get_facebook_activate() || get_twitter_activate() || get_linkedIn_activate() || get_google_activate() )
                        <div class="social-login">
                            <h3>Вход с помощью социальных сетей</h3>
                            <div class="social-login-buttons">

                                @if( get_facebook_activate() )
                                <a class="btn btn-link-2 facebook" href="redirect">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                @endif

                                @if( get_twitter_activate() )
                                <a class="btn btn-link-2 twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                @endif

                                @if( get_linkedIn_activate() )
                                <a class="btn btn-link-2 linked-in" href="#">
                                    <i class="fa fa-linkedin"></i> LinkedIn
                                </a>
                                @endif

                                @if( get_google_activate() )
                                <a class="btn btn-link-2 google-plus" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                                @endif

                                @if( get_vk_activate() )
                                <a class="btn btn-link-2 vk" href="#">
                                    <i class="fa fa-vk"></i> VK
                                </a>
                                @endif

                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
