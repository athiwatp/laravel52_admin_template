<ul class="nav nav-pills">
    <li class="active">
        <a href="#main-pills" data-toggle="tab" aria-expanded="true">{{ Lang::get('pages.form.main') }}</a>
    </li>
    <li class="">
        <a href="#other-pills" data-toggle="tab" aria-expanded="false">{{ Lang::get('pages.form.tegs') }}</a>
    </li>
</ul>
<br>
<div class="tab-content">

    <div class="tab-pane fade active in" id="main-pills">
        <div class="form-group">
            {{ Form::label('title', Lang::get('pages.form.title') ) }}
            {{ Form::text('title', ( $oData ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
        </div>
        <div class="form-group">
            {{ Form::label('url', Lang::get('news.form.url') ) }}
            {{
                Form::text(
                    'url', ( $oData ? $oData->url : null), array(
                        'id' => 'url',
                        'v-model' => 'pages.url',
                        'class' => 'form-control data-url',
                        'readonly' => true
                    )
                )
            }}
        </div>
        <div class="form-group">
            {{ Form::label('public_url', Lang::get('pages.form.public_url') ) }}
            {{
                Form::text(
                    'public_url', ( $oData ? route('page-url', ['url' => $oData->url]) : route('page-url', ['url' => '%'])) , array(
                        'id' => 'public_url',
                        'url' => route('page-url', ['url' => 'url']),
                        'v-model' => 'pages.public_url',
                        'class' => 'form-control data-public_url',
                        'disabled'
                    )
                )
            }}
        </div>
        <div class="form-group">
            {{ Form::label('subtitle', Lang::get('pages.form.subtitle') ) }}
            {{ Form::text('subtitle', ( $oData ? $oData->subtitle : null), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('content', Lang::get('news.form.content') ) }}
            {{ Form::textarea('content', ( $oData ? $oData->content : null), array('class' => 'form-control ck-edtor')) }}
        </div>
    </div>

    <div class="tab-pane fade" id="other-pills">
        <div class="form-group">
            {{ Form::label('meta_keywords', Lang::get('table_field.lists.meta_keywords') ) }}
            {{ Form::textarea('meta_keywords', ( isset($oData) ? $oData->meta_keywords : null), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('meta_descriptions', Lang::get('table_field.lists.meta_descriptions') ) }}
            {{ Form::textarea('meta_descriptions', ( isset($oData) ? $oData->meta_descriptions: null), array('class' => 'form-control')) }}
        </div>
    </div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
@if( env('APP_ENV', 'testing') )
    {{ Form::hidden('is_published', isset($oData) ? $oData->is_published : 1) }}
@endif
{{ Form::hidden('template_url', route('page-url', ['url' => '%%url%%']), ['v-model' => 'pages.template_url'] ) }}
{{ Form::hidden('menu_id', isset($oMenuId) ? $oMenuId : 0) }}
</div>

@if ( Config::get('app.debug') == true )
    <pre>
        @{{ $data | json }}
    </pre>
@endif