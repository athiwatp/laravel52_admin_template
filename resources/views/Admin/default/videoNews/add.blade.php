<div class="form-group">
    {{ Form::label('title', Lang::get('videoNews.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('url', Lang::get('videoNews.form.url') ) }}
    {{ Form::text('url', ( isset($oData) ? $oData->url : null ), array('class' => 'form-control')) }}
    <p class="help-block">Ссылка на Youtube, например https://www.youtube.com/watch?v=s1ysoohV_zA</p>
</div>

@if( $oData && $oData->url)
    <div class="form-group">
        {{ Form::label('picture', Lang::get('videoNews.form.picture') ) }}
        <div>
            <a href="{{ $oData->url }}" target="_blank" title="">
                <img width="100" height="50"
                     src="http://img.youtube.com/vi/{{ cScreenshot::getItems($oData->url) }}/hqdefault.jpg"
                     class="img-responsive img-thumbnail">
            </a>
        </div>
    </div>
@endif

<div class="form-group">
    {{ Form::label('date', Lang::get('videoNews.form.date')) }}
    <div class="input-group date-group">
        {{ Form::text('date', ( isset($oData) ? get_formatted_date($oData->date) : get_current_date() ), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('content', Lang::get('videoNews.form.content')) }}
    {{ Form::textarea('content', ( isset($oData) ? $oData->content : null), array('class' => 'form-control ck-edtor')) }}
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
