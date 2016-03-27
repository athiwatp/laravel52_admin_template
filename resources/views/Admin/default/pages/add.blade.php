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
            {{ Form::label('title', Lang::get('news.form.title') ) }}
            {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
        </div>
        <div class="form-group">
            {{ Form::label('url', Lang::get('news.form.url_ident') ) }}
            {{ Form::text('url', ( isset($oData) ? $oData->url : null), array('class' => 'form-control data-url', 'readonly' => true)) }}
        </div>
        <div class="form-group">
            {{ Form::label('content', Lang::get('news.form.content') ) }}
            {{ Form::textarea('content', ( isset($oData) ? $oData->content : null), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('is_published', Lang::get('table_field.lists.published')) }}
            <div class="radio">
                {!! Form::_label('is_published_yes', Form::radio('is_published', '1', isset($oData) ? $oData->is_published === '1' : true, array('id' => 'is_published_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
            </div>
            <div class="radio">
                {!! Form::_label('is_published_no', Form::radio('is_published', '0', isset($oData) ? $oData->is_published === '0' : false, array('id' => 'is_published_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
            </div>
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
</div>