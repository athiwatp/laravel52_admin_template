<ul class="nav nav-pills">
    <li class="active">
        <a href="#home-pills" data-toggle="tab" aria-expanded="true">{{ Lang::get('settings.form.main') }}</a>
    </li>
    <li class="">
        <a href="#profile-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('pages.form.tegs') }}</a>
    </li>
    <li class="">
        <a href="#contact" data-toggle="tab" aria-expanded="false">{{ Lang::get('settings.form.contact') }}</a>
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

        <div class="form-group">
            {{ Form::label('admin_phone', Lang::get('settings.form.admin_phone') ) }}
            {!! Form::text('admin_phone', ( array_key_exists('admin_phone', $oData) ? $oData['admin_phone'] : ''), array('class' => 'form-control')) !!}
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

    <div class="tab-pane fade" id="contact">
        <div class="form-group">
            {{ Form::label('contact', Lang::get('settings.form.page_contact') ) }}
            {!! Form::textarea('contact', (array_key_exists('contact', $oData) ? $oData['contact'] : ''), array('class' => 'form-control ck-edtor')) !!}
        </div>
        <div class="form-group">
            {{ Form::label('contact_address', Lang::get('settings.form.address') ) }}
            {!! Form::text('contact_address', (array_key_exists('contact_address', $oData) ? $oData['contact_address'] : ''), array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label('contact_coordinates', Lang::get('settings.form.contact_coordinates')) }}
            {!! Form::text('contact_coordinates', ( array_key_exists('contact_coordinates', $oData) ? $oData['contact_coordinates'] : ''), array('class' => 'form-control')) !!}
            <p class="help-block">{!! Lang::get('settings.form.to_coordinate') !!}</p>
        </div>
    </div>

    <div class="tab-pane fade" id="social-networks-pills">
        <div class="panel-group" id="accordion">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFacebook">
                            {{ Form::label('facebook', Lang::get('settings.social_networks.facebook') ) }}
                        </a>
                    </div>
                    <div class="panel-body panel-collapse collapse in" id="collapseFacebook" aria-expanded="true">
                        <div class="form-group">
                            {{ Form::label('facebook_activate', Lang::get('settings.set.activate') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('facebook_activate', $oData) ? $oData['facebook_activate'] : '' }}"
                                    cmp-name = "facebook_activate">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('facebook_authorization', Lang::get('settings.set.use_authorization') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('facebook_authorization', $oData) ? $oData['facebook_authorization'] : '' }}"
                                    cmp-name = "facebook_authorization">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('facebook_repost', Lang::get('settings.set.repost_updates') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('facebook_repost', $oData) ? $oData['facebook_repost'] : '' }}"
                                    cmp-name = "facebook_repost">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('facebook_account', Lang::get('settings.set.facebook_account') ) }}
                            {!! Form::text('facebook_account', ( array_key_exists('facebook_account', $oData) ? $oData['facebook_account'] : ''), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('facebook_token', Lang::get('settings.set.token') ) }}
                            {!! Form::text('facebook_token', ( array_key_exists('facebook_token', $oData) ? $oData['facebook_token'] : ''), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-facebook"> Facebook</i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwitter">
                            {{ Form::label('twitter', Lang::get('settings.social_networks.twitter') ) }}
                        </a>
                    </div>
                    <div class="panel-body panel-collapse collapse" id="collapseTwitter" aria-expanded="false">
                        <div class="form-group">
                            {{ Form::label('twitter_activate', Lang::get('settings.set.activate') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('twitter_activate', $oData) ? $oData['twitter_activate'] : '' }}"
                                    cmp-name = "twitter_activate">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('twitter_authorization', Lang::get('settings.set.use_authorization') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('twitter_authorization', $oData) ? $oData['twitter_authorization'] : '' }}"
                                    cmp-name = "twitter_authorization">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('twitter_repost', Lang::get('settings.set.repost_updates') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('twitter_repost', $oData) ? $oData['twitter_repost'] : '' }}"
                                    cmp-name = "twitter_repost">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('twitter_account', Lang::get('settings.set.twitter_account') ) }}
                            {!! Form::text('twitter_account', ( array_key_exists('twitter_account', $oData) ? $oData['twitter_account'] : ''), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('twitter_token', Lang::get('settings.set.token') ) }}
                            {!! Form::text('twitter_token', ( array_key_exists('twitter_token', $oData) ? $oData['twitter_token'] : ''), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-twitter"> Twitter</i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseLinkedIn">
                            {{ Form::label('linkedIn', Lang::get('settings.social_networks.linkedIn') ) }}
                        </a>
                    </div>
                    <div class="panel-body panel-collapse collapse" id="collapseLinkedIn" aria-expanded="false">
                        <div class="form-group">
                            {{ Form::label('linkedIn_activate', Lang::get('settings.set.activate') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('linkedIn_activate', $oData) ? $oData['linkedIn_activate'] : '' }}"
                                    cmp-name = "linkedIn_activate">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('linkedIn_authorization', Lang::get('settings.set.use_authorization') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('linkedIn_authorization', $oData) ? $oData['linkedIn_authorization'] : '' }}"
                                    cmp-name = "linkedIn_authorization">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('linkedIn_repost', Lang::get('settings.set.repost_updates') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('linkedIn_repost', $oData) ? $oData['linkedIn_repost'] : '' }}"
                                    cmp-name = "linkedIn_repost">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('linkedIn_account', Lang::get('settings.set.linkedIn_account') ) }}
                            {!! Form::text('linkedIn_account', ( array_key_exists('linkedIn_account', $oData) ? $oData['linkedIn_account'] : ''), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('linkedIn_token', Lang::get('settings.set.token') ) }}
                            {!! Form::text('linkedIn_token', ( array_key_exists('linkedIn_token', $oData) ? $oData['linkedIn_token'] : ''), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-linkedin"> LinkedIn</i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseGoogle">
                            {{ Form::label('google', Lang::get('settings.social_networks.google') ) }}
                        </a>
                    </div>
                    <div class="panel-body panel-collapse collapse" id="collapseGoogle" aria-expanded="false">
                        <div class="form-group">
                            {{ Form::label('google_activate', Lang::get('settings.set.activate') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('google_activate', $oData) ? $oData['google_activate'] : '' }}"
                                    cmp-name = "google_activate">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('google_authorization', Lang::get('settings.set.use_authorization') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('google_authorization', $oData) ? $oData['google_authorization'] : '' }}"
                                    cmp-name = "google_authorization">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('google_repost', Lang::get('settings.set.repost_updates') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('google_repost', $oData) ? $oData['google_repost'] : '' }}"
                                    cmp-name = "google_repost">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('google_account', Lang::get('settings.set.google_account') ) }}
                            {!! Form::text('google_account', ( array_key_exists('google_account', $oData) ? $oData['google_account'] : ''), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('google_token', Lang::get('settings.set.token') ) }}
                            {!! Form::text('google_token', ( array_key_exists('google_token', $oData) ? $oData['google_token'] : ''), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-google-plus"> Google plus</i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseVk">
                            {{ Form::label('vk', Lang::get('settings.social_networks.vk') ) }}
                        </a>
                    </div>
                    <div class="panel-body panel-collapse collapse" id="collapseVk" aria-expanded="false">
                        <div class="form-group">
                            {{ Form::label('vk_activate', Lang::get('settings.set.activate') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('vk_activate', $oData) ? $oData['vk_activate'] : '' }}"
                                    cmp-name = "vk_activate">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('google_authorization', Lang::get('settings.set.use_authorization') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('vk_authorization', $oData) ? $oData['vk_authorization'] : '' }}"
                                    cmp-name = "vk_authorization">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('vk_repost', Lang::get('settings.set.repost_updates') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('vk_repost', $oData) ? $oData['vk_repost'] : '' }}"
                                    cmp-name = "vk_repost">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('vk_account', Lang::get('settings.set.vk_account') ) }}
                            {!! Form::text('vk_account', ( array_key_exists('vk_account', $oData) ? $oData['vk_account'] : ''), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('vk_token', Lang::get('settings.set.token') ) }}
                            {!! Form::text('vk_token', ( array_key_exists('vk_token', $oData) ? $oData['vk_token'] : ''), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-vk"> Vk</i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOk">
                            {{ Form::label('ok', Lang::get('settings.social_networks.ok') ) }}
                        </a>
                    </div>
                    <div class="panel-body panel-collapse collapse" id="collapseOk" aria-expanded="false">
                        <div class="form-group">
                            {{ Form::label('ok_activate', Lang::get('settings.set.activate') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('ok_activate', $oData) ? $oData['ok_activate'] : '' }}"
                                    cmp-name = "ok_activate">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('google_authorization', Lang::get('settings.set.use_authorization') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('ok_authorization', $oData) ? $oData['ok_authorization'] : '' }}"
                                    cmp-name = "ok_authorization">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('ok_repost', Lang::get('settings.set.repost_updates') ) }}
                            <div class="switcher">
                                <my-switcher
                                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                                    cmp-value = "{{ array_key_exists('ok_repost', $oData) ? $oData['ok_repost'] : '' }}"
                                    cmp-name = "ok_repost">
                                </my-switcher>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('ok_account', Lang::get('settings.set.ok_account') ) }}
                            {!! Form::text('ok_account', ( array_key_exists('ok_account', $oData) ? $oData['ok_account'] : ''), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('ok_token', Lang::get('settings.set.token') ) }}
                            {!! Form::text('ok_token', ( array_key_exists('ok_token', $oData) ? $oData['ok_token'] : ''), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <i class="fa fa-odnoklassniki"> Odnoklassniki</i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="news-pills">
        <div class="form-group">
            {{ Form::label('post_news_updates_on_social_networks', Lang::get('settings.tune-up.post_updates_on_social_networks') ) }}
            <div class="switcher">
                <my-switcher
                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                    cmp-value = "{{ array_key_exists('post_news_updates_on_social_networks', $oData) ? $oData['post_news_updates_on_social_networks'] : '' }}"
                    cmp-name = "post_news_updates_on_social_networks">
                </my-switcher>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="gallery-pills">
        <div class="form-group">
            {{ Form::label('post_gallery_updates_on_social_networks', Lang::get('settings.tune-up.post_updates_on_social_networks') ) }}
            <div class="switcher">
                <my-switcher
                    cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                    cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                    cmp-value = "{{ array_key_exists('post_gallery_updates_on_social_networks', $oData) ? $oData['post_gallery_updates_on_social_networks'] : '' }}"
                    cmp-name = "post_gallery_updates_on_social_networks">
                </my-switcher>
            </div>
        </div>
    </div>
</div>
