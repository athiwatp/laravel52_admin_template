<div class="form-group">
    {{ Form::label('title', Lang::get('menues.form.title') ) }}
    {{
        Form::text('title', ( isset($oData) ? $oData->title : null), array(
            'class' => 'form-control convert-to-url',
            'v-model' => 'menu.title'
        ))
    }}
</div>

<div class="form-group">
    {{ Form::label('url', Lang::get('menues.form.url') ) }}
    {{ Form::text('url', ( isset($oData) ? $oData->url : null ), array('class' => 'form-control data-url', 'readonly' => true)) }}
</div>

<div class="form-group">
    {{ Form::label('type_menu', Lang::get('menues.form.type_menu') ) }}
    {{
        Form::select('type_menu', $aTypeMenues,( isset($oData) ? $oData->type_menu : null), array(
            'class' => 'form-control',
            'v-model' => 'menu.type',
            '@change' => 'onTypeChange()'
        ))
    }}
    <p class="help-block">Разделяя меню по типу, мы имеем возможность манипулировать элементами и показывать в соответсвующих местах</p>
</div>

<div class="form-group">
    {{ Form::label('linked_to_menu', 'Связан с' ) }}

    <select
        name="linked_to_menu"
        v-model="menu.linked_to"
        class="form-control"
        :disabled="isLinkedDisabled">
        <option v-for="option in linkedList" :value="option.value">@{{ option.text }}</option>
    </select>
    <p class="help-block">Показывать текущий пункт меню, на связной странице (как сайдбар меню)</p>
</div>

<div class="form-group">
    {{ Form::label('pos', Lang::get('menues.form.pos') ) }}
    {{ Form::number('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control data-pos')) }}
</div>
<div class="form-group">
    {{ Form::label('parent_id', Lang::get('menues.form.parent_id') ) }}
    <select
            name="parent_id"
            v-model="menu.parent"
            class="form-control"
            :disabled="isParentDisabled">
        <option v-for="option in parentList" :value="option.value">@{{ option.text }}</option>
    </select>

</div>
<div class="form-group">
    {{ Form::label('page_id', Lang::get('menues.form.page_id') ) }}
    {{ Form::select('page_id', $aPages, ( isset($oData) ? $oData->page_id : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('url', Lang::get('menues.form.redirect_url') ) }}
    {{
        Form::text('redirect_url', ( isset($oData) ? $oData->redirect_url : null ), array(
            'class' => 'form-control',
            ':disabled'=>'isRedirectTextDisabled'
        ))
    }}
    {!!
        Form::_label('redirectable', Form::checkbox('is_redirectable', '1', isset($oData) && $oData->is_redirectable === '1' ? true : false , array(
            'id' => 'redirectable',
            'v-model' => 'menu.is_redirectable'
        )) . ' ' . Lang::get('menues.form.is_redirectable') )
    !!}
</div>
<div class="form-group">
    <div class="checkbox">
        {!! Form::_label('is_loaded_by_default', Form::checkbox('is_loaded_by_default', '1', isset($oData) && $oData->is_loaded_by_default === '1' ? true : false , array('id' => 'is_loaded_by_default')) . ' ' . Lang::get('menues.form.is_loaded_by_default') ) !!}
    </div>
    <div class="checkbox">
        {!! Form::_label('is_shown_print_version', Form::checkbox('is_shown_print_version', '1', isset($oData) && $oData->is_shown_print_version === '1' ? true : false , array('id' => 'is_shown_print_version')) . ' ' . Lang::get('menues.form.is_shown_print_version') ) !!}
    </div>
</div>

<div class="form-group">
    {{ Form::label('is_published', Lang::get('table_field.lists.published')) }}
    <div class="radio">
        {!! Form::_label('published_yes', Form::radio('is_published', '1', isset($oData) ? $oData->is_published === '1' : true, array('id' => 'published_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
    </div>
    <div class="radio">
        {!! Form::_label('published_no', Form::radio('is_published', '0', isset($oData) ? $oData->is_published === '0' : false, array('id' => 'published_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
    </div>
</div>
{{
    Form::hidden('id', isset($oData) ? $oData->id : 0, [
        'v-model' => 'menu.id'
    ])
}}

{{-- @TODO: It should be re-written, since it has bad approach --}}
{{
    Form::hidden('hdn_prnt_id', isset($oData) ? $oData->parent_id : 0, [
        'v-model' => 'retrieved.parent_id'
    ])
}}

{{
    Form::hidden('hdn_lnkd_id', isset($oData) ? $oData->linked_to : 0, [
        'v-model' => 'retrieved.linked_id'
    ])
}}
{{-- End --}}



@if ( Config::get('app.debug') == true )
    <pre>
        @{{ $data | json }}
    </pre>
@endif
