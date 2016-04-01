<ul class="nav nav-pills">
    <li class="active">
        <a href="#home-pills" data-toggle="tab" aria-expanded="true">{{ Lang::get('settings.form.main') }}</a>
    </li>
    <li class="">
        <a href="#profile-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('pages.form.tegs') }}</a>
    </li>
    <li class="">
        <a href="#social-networks-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('settings.form.social_networks') }}</a>
    </li>
    <li class="">
        <a href="#news-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('settings.tune-up.news') }}</a>
    </li>
    <li class="">
        <a href="#gallery-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('settings.tune-up.gallery') }}</a>
    </li>
</ul>
<br>
<div class="tab-content">
    <div class="tab-pane fade active in" id="home-pills">
        <div class="form-group">
            {{ Form::label('site_name', Lang::get('settings.form.site_name') ) }}
            {!! Form::text('site_name', ( array_key_exists('site_name', $oData) ? $oData['site_name'] : ''), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {{ Form::label('footer_content', Lang::get('settings.form.footer_content')) }}
            {!! Form::textarea('footer_content', ( array_key_exists('footer_content', $oData) ? $oData['footer_content'] : ''), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {{ Form::label('admin_email', Lang::get('settings.form.admin_email') ) }}
            {!! Form::text('admin_email', ( array_key_exists('admin_email', $oData) ? $oData['admin_email'] : ''), array('class' => 'form-control')) !!}
        </div>

    </div>

    <div class="tab-pane fade" id="profile-pills">
        <div class="form-group">
            {{ Form::label('meta_keywords', Lang::get('settings.form.meta_keywords') ) }}
            {!! Form::text('meta_keywords', (array_key_exists('meta_keywords', $oData) ? $oData['meta_keywords'] : ''), array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label('meta_description', Lang::get('settings.form.meta_description')) }}
            {!! Form::textarea('meta_description', ( array_key_exists('meta_description', $oData) ? $oData['meta_description'] : ''), array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="tab-pane fade" id="social-networks-pills">

        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ Form::label('facebook', Lang::get('settings.social_networks.facebook') ) }}
                </div>
                <div class="panel-body">
                    {{ Form::label('facebook_activate', Lang::get('settings.set.activate') ) }}
                    {!! Form::select('facebook_activate', $setSocialNetworks, ( array_key_exists('facebook_activate', $oData) ? $oData['facebook_activate'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('facebook_authorization', Lang::get('settings.set.use_authorization') ) }}
                    {!! Form::select('facebook_authorization', $setSocialNetworks, ( array_key_exists('facebook_authorization', $oData) ? $oData['facebook_authorization'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('facebook_repost', Lang::get('settings.set.repost_updates') ) }}
                    {!! Form::select('facebook_repost', $setSocialNetworks, ( array_key_exists('facebook_repost', $oData) ? $oData['facebook_repost'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('facebook_token', Lang::get('settings.set.token') ) }}
                    {!! Form::text('facebook_token', ( array_key_exists('facebook_token', $oData) ? $oData['facebook_token'] : ''), array('class' => 'form-control')) !!}
                </div>
                <div class="panel-footer">
                    <i class="fa fa-facebook"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ Form::label('twitter', Lang::get('settings.social_networks.twitter') ) }}
                </div>
                <div class="panel-body">
                    {{ Form::label('twitter_activate', Lang::get('settings.set.activate') ) }}
                    {!! Form::select('twitter_activate', $setSocialNetworks, ( array_key_exists('twitter_activate', $oData) ? $oData['twitter_activate'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('twitter_authorization', Lang::get('settings.set.use_authorization') ) }}
                    {!! Form::select('twitter_authorization', $setSocialNetworks, ( array_key_exists('twitter_authorization', $oData) ? $oData['twitter_authorization'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('twitter_repost', Lang::get('settings.set.repost_updates') ) }}
                    {!! Form::select('twitter_repost', $setSocialNetworks, ( array_key_exists('twitter_repost', $oData) ? $oData['twitter_repost'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('twitter_token', Lang::get('settings.set.token') ) }}
                    {!! Form::text('twitter_token', ( array_key_exists('twitter_token', $oData) ? $oData['twitter_token'] : ''), array('class' => 'form-control')) !!}
                </div>
                <div class="panel-footer">
                    <i class="fa fa-twitter"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ Form::label('linkedIn', Lang::get('settings.social_networks.linkedIn') ) }}
                </div>
                <div class="panel-body">
                    {{ Form::label('linkedIn_activate', Lang::get('settings.set.activate') ) }}
                    {!! Form::select('linkedIn_activate', $setSocialNetworks, ( array_key_exists('linkedIn_activate', $oData) ? $oData['linkedIn_activate'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('linkedIn_authorization', Lang::get('settings.set.use_authorization') ) }}
                    {!! Form::select('linkedIn_authorization', $setSocialNetworks, ( array_key_exists('linkedIn_authorization', $oData) ? $oData['linkedIn_authorization'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('linkedIn_repost', Lang::get('settings.set.repost_updates') ) }}
                    {!! Form::select('linkedIn_repost', $setSocialNetworks, ( array_key_exists('linkedIn_repost', $oData) ? $oData['linkedIn_repost'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('linkedIn_token', Lang::get('settings.set.token') ) }}
                    {!! Form::text('linkedIn_token', ( array_key_exists('linkedIn_token', $oData) ? $oData['linkedIn_token'] : ''), array('class' => 'form-control')) !!}
                </div>
                <div class="panel-footer">
                    <i class="fa fa-linkedin"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ Form::label('google', Lang::get('settings.social_networks.google') ) }}
                </div>
                <div class="panel-body">
                    {{ Form::label('google_activate', Lang::get('settings.set.activate') ) }}
                    {!! Form::select('google_activate', $setSocialNetworks, ( array_key_exists('google_activate', $oData) ? $oData['google_activate'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('google_authorization', Lang::get('settings.set.use_authorization') ) }}
                    {!! Form::select('google_authorization', $setSocialNetworks, ( array_key_exists('google_authorization', $oData) ? $oData['google_authorization'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('google_repost', Lang::get('settings.set.repost_updates') ) }}
                    {!! Form::select('google_repost', $setSocialNetworks, ( array_key_exists('google_repost', $oData) ? $oData['google_repost'] : ''), array('class' => 'form-control')) !!}
                    {{ Form::label('google_token', Lang::get('settings.set.token') ) }}
                    {!! Form::text('google_token', ( array_key_exists('google_token', $oData) ? $oData['google_token'] : ''), array('class' => 'form-control')) !!}
                </div>
                <div class="panel-footer">
                    <i class="fa fa-google-plus"></i>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="news-pills">
        <div class="form-group">
            {{ Form::label('post_news_updates_on_social_networks', Lang::get('settings.tune-up.post_updates_on_social_networks') ) }}
            {!! Form::select('post_news_updates_on_social_networks', $setSocialNetworks, ( array_key_exists('post_news_updates_on_social_networks', $oData) ? $oData['post_news_updates_on_social_networks'] : ''), array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="tab-pane fade" id="gallery-pills">
        <div class="form-group">
            {{ Form::label('post_gallery_updates_on_social_networks', Lang::get('settings.tune-up.post_updates_on_social_networks') ) }}
            {!! Form::select('post_gallery_updates_on_social_networks', $setSocialNetworks, ( array_key_exists('post_gallery_updates_on_social_networks', $oData) ? $oData['post_gallery_updates_on_social_networks'] : ''), array('class' => 'form-control')) !!}
        </div>
    </div>
</div>
