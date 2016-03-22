<div class="form-group">
    {{ Form::label('title', Lang::get('videoNews.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('url', Lang::get('videoNews.form.url') ) }}
    {{ Form::text('url', ( isset($oData) ? $oData->url : null ), array('class' => 'form-control')) }}
</div>

@if( isset($oData) && $oData->url)
    <div class="form-group">
        {{ Form::label('picture', Lang::get('videoNews.form.picture') ) }}
        <div>
            <a href="{{ $oData->url }}" target="_blank" title="">
                <img width="100" height="50" src="http://img.youtube.com/vi/{{ cScreenshot::getItems($oData->url) }}/hqdefault.jpg" class="img-responsive img-thumbnail">
            </a>
        </div>
    </div>
@endif

<div class="form-group">
    {{ Form::label('date', Lang::get('videoNews.form.date')) }}
    <div class="input-group date-group">
        {{ Form::text('date', ( isset($oData) ? $oData->date : null), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('content', Lang::get('videoNews.form.content')) }}
    {{ Form::textarea('content', ( isset($oData) ? $oData->content : null), array('class' => 'form-control ck-edtor')) }}
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
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
