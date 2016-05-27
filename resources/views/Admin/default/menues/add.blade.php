<div class="modal fade" id="myRoute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Внутрішні модулі</h4>
            </div>
            <div class="modal-body">
                <p class="help-block">{!! Lang::get('menues.form.modules') !!}</p>
                @forelse($getRoute as $key => $value)
                    <div class="alert alert-info">
                        <a class="route-model" data-dismiss="modal" data-toggle="getModal" data-target="#thisModel">
                            {{ $key }} => "{{ $value }}"
                        </a>
                    </div>
                @endforeach
            </div>
            {{--
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
            --}}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('title', Lang::get('menues.form.title') ) }}
    {{
        Form::text('title', ( isset($oData) ? $oData->title : null), array(
            'required',
            'minlength' => 3,
            'maxlength' => 255,
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
    <p class="help-block">{{ Lang::get('menues.form.message_type_menu') }}</p>
</div>

<div class="form-group">
    {{ Form::label('linked_to_menu', Lang::get('menues.form.connected_with') ) }}
    <select
        name="linked_to_menu"
        v-model="menu.linked_to"
        class="form-control"
        :disabled="isLinkedDisabled">
        <option v-for="option in linkedList" :value="option.value">@{{ option.text }}</option>
    </select>
    <p class="help-block">{{ Lang::get('menues.form.message_linked_to_menu') }}</p>
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
            /*:disabled="isParentDisabled"*/>
        <option v-for="option in parentList" :value="option.value">@{{ option.text }}</option>
    </select>
</div>

<div class="form-group">
    {{ Form::label('page_id', Lang::get('menues.form.page_id') ) }}
    {{
        Form::select(
            'page_id',
            $aPages,
            isset($oData) && $oData ? $oData->page_id : -1,
            [
                'class' => 'form-control',
                 'v-model' => 'menu.page_id',
                ':disabled'=>'isRedirectDisabledPage'
            ]
        )
    }}
</div>

<div class="form-group">
    {!!  Form::_label('redirect_url', Lang::get('menues.form.redirect_url') . ' (<a data-toggle="modal" data-target="#myRoute">' . Lang::get('menues.form.internal_modules') . '</a>)' ) !!}
    {{
        Form::text('redirect_url', ( isset($oData) ? $oData->redirect_url : null ), array(
            'class' => 'form-control',
            'id' => 'thisModel',
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

@if( env('APP_ENV', 'testing') )
    {{ Form::hidden('parent_id', '-1') }}
    {{ Form::hidden('is_published', isset($oData) ? $oData->is_published : 0) }}
@endif
{{-- End --}}

@if ( Config::get('app.debug') == true )
    <pre>
        @{{ $data | json }}
    </pre>
@endif
