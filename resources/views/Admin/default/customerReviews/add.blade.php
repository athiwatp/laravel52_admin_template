<div class="form-group">
    {{ Form::label('client', Lang::get('customer_reviews.form.client') ) }}
    {{ Form::text('client', ( isset($oData) ? $oData->client : null), array('class' => 'form-control convert-to-url')) }}
</div>

<div class="form-group">
    {{ Form::label('date', Lang::get('table_field.lists.date')) }}
    <div class="input-group date-group">
        {{ Form::text('date', ( isset($oData) ? get_formatted_date($oData->date) : get_current_date() ), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('comment', Lang::get('customer_reviews.form.comment') ) }}
    {{ Form::textarea('comment', ( isset($oData) ? $oData->comment : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('signature', Lang::get('customer_reviews.form.signature') ) }}
    {{ Form::text('signature', ( isset($oData) ? $oData->signature : null), array('class' => 'form-control')) }}
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}