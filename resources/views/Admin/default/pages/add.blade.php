<div class="tab-content">
    <div class="form-group">
        {{ Form::label('title', Lang::get('news.form.title') ) }}
        {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('url', Lang::get('news.form.url') ) }}
        {{ Form::text('url', ( isset($oData) ? $oData->url : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('content', Lang::get('news.form.content') ) }}
        {{ Form::textarea('content', ( isset($oData) ? $oData->content : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('meta_keywords', Lang::get('table_field.lists.meta_keywords') ) }}
        {{ Form::textarea('meta_keywords', ( isset($oData) ? $oData->meta_keywords : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('meta_descriptions', Lang::get('table_field.lists.meta_descriptions') ) }}
        {{ Form::textarea('meta_descriptions', ( isset($oData) ? $oData->meta_descriptions: null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('is_published', Lang::get('news.form.published')) }}
        <div class="radio">
            {{ Form::radio('is_published', '1', isset($oData) ? $oData->is_published === '1' : true, array('id' => 'is_published_yes')) }}
            {{ Form::label('is_published_yes', Lang::get('table_field.lists.yes') ) }}
        </div>
        <div class="radio">
            {{ Form::radio('is_published', '0', isset($oData) ? $oData->is_published === '0' : false, array('id' => 'is_published_no')) }}
            {{ Form::label('is_published_no', Lang::get('table_field.lists.no') ) }}
        </div>
    </div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
</div>