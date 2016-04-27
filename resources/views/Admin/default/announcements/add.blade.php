
<div class="form-group">
    {{ Form::label('title', Lang::get('announce.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
</div>

<div class="form-group">
    {!!
        Form::_label('important',
            Form::checkbox('important', '1', isset($oData) && $oData->important === '1' ? true : false , array('id' => 'important')) . ' ' . Lang::get('announce.form.important')
        )
    !!}
    <p class="help-block">{{ Lang::get('announce.form.important_help') }}</p>
</div>

<div class="form-group">
    {!!
        Form::_label('is_topical',
            Form::checkbox('is_topical', '1', isset($oData) && $oData->is_topical === '1' ? true : false , array(
                    'id' => 'is_topical',
                    'v-model' => 'announce.is_topical'
                )
            ) . ' ' . Lang::get('announce.form.topical_to')
        )
    !!}

    <div class="input-group date-group">
        {{
            Form::text('top_date_end', ( isset($oData) && $oData->top_date_end ? get_formatted_date($oData->top_date_end) : ''), array(
                'class' => 'form-control date-controls',
                ':disabled'=>'isTopDateDisabled'
            ))
        }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
    <p class="help-block">{{ Lang::get('announce.form.topical_help') }}</p>
</div>

<div class="form-group">
    {{ Form::label('date_start', Lang::get('announce.form.date_start')) }}
    <div class="input-group date-group">
        {{ Form::text('date_start', ( isset($oData) ? get_formatted_date($oData->date_start) : get_current_date() ), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('date_end', Lang::get('announce.form.date_end')) }}
    <div class="input-group date-group">
        {{ Form::text('date_end', ( isset($oData) ? get_formatted_date($oData->date_end) : $date['thisDayPlusMonth']), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('description', Lang::get('announce.form.description') ) }}
    {{ Form::textarea('description', ( isset($oData) ? $oData->description : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('chapter_id', Lang::get('announce.form.chapter') ) }}
    {{ Form::select('chapter_id', $aChapters, ( isset($oData) ? $oData->chapter_id : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('image', Lang::get('announce.form.image')) }}
    {{ Form::file('image', array() ) }}
    @if ( isset($oData) && $oData->image)
        <br /><img src="{{ get_file_url($oData->image, 'box2') }}" title="{{ $oData->title }}" class="img-responsive img-thumbnail">
    @endif
</div>

{{
    Form::hidden('id', isset($oData) ? $oData->id : 0, [
        'v-model' => 'announce.id'
    ])
}}


@if ( Config::get('app.debug') == true )
    <pre>
        @{{ $data | json }}
    </pre>
@endif