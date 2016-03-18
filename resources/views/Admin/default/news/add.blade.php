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
        {{ Form::label('date', Lang::get('table_field.lists.date') ) }}
        {{ Form::text('date', ( isset($oData) ? $oData->date : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('chapter_id', Lang::get('news.form.chapter') ) }}
        {{ Form::select('chapter_id', $aChapters, ( isset($oData) ? $oData->chapter_id : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('source', Lang::get('news.form.source') ) }}
        {{ Form::text('source', ( isset($oData) ? $oData->source : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('photo', Lang::get('news.form.photo')) }}
        {{ Form::file('image', array() ) }}
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
    <div class="form-group">
        {{ Form::label('is_main', Lang::get('news.form.main')) }}
        <div class="radio">
            {{ Form::radio('is_main', '1', isset($oData) ? $oData->is_main === '1' : false, array('id' => 'is_main')) }}
            {{ Form::label('is_main', Lang::get('table_field.lists.yes') ) }}
        </div>
        <div class="radio">
            {{ Form::radio('is_main', '0', isset($oData) ? $oData->is_main === '0' : true, array('id' => 'not_main')) }}
            {{ Form::label('not_main', Lang::get('table_field.lists.no')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('is_important', Lang::get('news.form.important')) }}
        <div class="radio">
            {{ Form::radio('is_important', '1', isset($oData) ?  $oData->is_important === '1' : false, array('id' => 'is_important')) }}
            {{ Form::label('is_important', Lang::get('table_field.lists.yes') ) }}
        </div>
        <div class="radio">
            {{ Form::radio('is_important', '0', isset($oData) ?  $oData->is_important === '0' : true, array('id' => 'not_important')) }}
            {{ Form::label('not_important', Lang::get('table_field.lists.no')) }}
        </div>
    </div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
</div>