<ul class="nav nav-pills">
    <li class="active">
        <a href="#home-pills" data-toggle="tab" aria-expanded="true">{{ Lang::get('settings.form.main') }}</a>
    </li>
    <li class="">
        <a href="#profile-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('pages.form.tegs') }}</a>
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
</div>
