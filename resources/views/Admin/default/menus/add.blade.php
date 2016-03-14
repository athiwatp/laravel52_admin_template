@extends( $__theme . '.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ Lang::get('layouts.layouts.menu') }}</h1>
    </div>
</div>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">{{ Lang::get('table_field.menus.create_menu') }}</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel-body">
                    {{ Form::open(array('url' => URL::route('admin.menu.store'), 'method'=>'POST')) }}
                        <div class="tab-content">

                            <div class="form-group">
                                {{ Form::label('title', Lang::get('menus.form.title') ) }}
                                {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('pos', Lang::get('menus.form.pos') ) }}
                                {{ Form::text('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('type_menu', Lang::get('menus.form.type_menu') ) }}
                                {{ Form::number('type_menu', ( isset($oData) ? $oData->type_menu : null), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('parent_id', Lang::get('menus.form.parent_id') ) }}
                                {{ Form::number('parent_id', ( isset($oData) ? $oData->parent_id : null), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('path', Lang::get('menus.form.path') ) }}
                                {{ Form::text('path', ( isset($oData) ? $oData->path : null), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('page_id', Lang::get('menus.form.page_id') ) }}
                                {{ Form::text('page_id', ( isset($oData) ? $oData->page_id : null), array('class' => 'form-control')) }}

                                {{ Form::checkbox('is_redirectable', '1', isset($oData) ? $oData->is_redirectable === '1' : false, array('id' => 'is_redirectable')) }}
                                {{ Form::label('is_redirectable', Lang::get('menus.form.is_redirectable') ) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('url', Lang::get('menus.form.url') ) }}
                                {{ Form::text('url', ( isset($oData) ? $oData->url : null), array('class' => 'form-control')) }}

                                {{ Form::checkbox('redirect_url', '1', isset($oData) ? $oData->redirect_url === '1' : false, array('id' => 'redirect_url')) }}
                                {{ Form::label('redirect_url', Lang::get('menus.form.redirect_url') ) }}
                            </div>


                            <div class="form-group">
                                <div class="checkbox">
                                    {{ Form::checkbox('is_loaded_by_default', '1', isset($oData) ? $oData->is_loaded_by_default === '1' : false, array('id' => 'is_loaded_by_default')) }}
                                    {{ Form::label('is_loaded_by_default', Lang::get('menus.form.is_loaded_by_default') ) }}
                                </div>
                                <div class="checkbox">
                                    {{ Form::checkbox('is_shown_print_version', '1', isset($oData) ? $oData->is_shown_print_version === '1' : true, array('id' => 'is_shown_print_version')) }}
                                    {{ Form::label('is_shown_print_version', Lang::get('menus.form.is_shown_print_version') ) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('is_published', Lang::get('menus.form.is_published')) }}
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
                    {{ Form::submit(Lang::get('table_field.lists.save'), array('class' => 'btn btn-outline btn-primary')) }}
                    <a href="{{ URL::route('admin.menu') }}" class="btn btn-outline btn-default">{{ Lang::get('table_field.lists.back') }}</a>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop