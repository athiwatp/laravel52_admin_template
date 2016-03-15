@extends( $__theme . '.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ Lang::get('settings.form.settings') }}</h1>
    </div>
</div>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">{{ Lang::get('settings.form.settings_this_site') }}</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel-body">

                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#home-pills" data-toggle="tab" aria-expanded="true">{{ Lang::get('settings.form.main') }}</a>
                        </li>
                        <li class="">
                            <a href="#profile-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('settings.form.other') }}</a>
                        </li>
                    </ul>

                    <br>
                    {{ Form::open(array('url' => URL::route('admin.settings.post'), 'method'=>'POST')) }}
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home-pills">
                            <div class="form-group">
                                {{ Form::label('site_name', Lang::get('settings.form.site_name') ) }}
                                {{ Form::text('site_name', ( array_key_exists('site_name', $aData) ? $aData['site_name'] : ''), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('footer_content', Lang::get('settings.form.footer_content')) }}
                                {{ Form::textarea('footer_content', ( array_key_exists('footer_content', $aData) ? $aData['footer_content'] : ''), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('admin_email', Lang::get('settings.form.admin_email') ) }}
                                {{ Form::text('admin_email', ( array_key_exists('admin_email', $aData) ? $aData['admin_email'] : ''), array('class' => 'form-control')) }}
                            </div>
                        
                        </div>
                        
                        <div class="tab-pane fade" id="profile-pills">
                            <div class="form-group">
                                {{ Form::label('meta_keywords', Lang::get('settings.form.meta_keywords') ) }}
                                {{ Form::text('meta_keywords', (array_key_exists('meta_keywords', $aData) ? $aData['meta_keywords'] : ''), array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('meta_description', Lang::get('settings.form.meta_description')) }}
                                {{ Form::textarea('meta_description', ( array_key_exists('meta_description', $aData) ? $aData['meta_description'] : ''), array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::submit(Lang::get('table_field.lists.save'), array('class' => 'btn btn-outline btn-primary')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop