<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table id="example" class="datatables display responsive no-wrap" data-url="menu" data-columns="{{ $sColumnsJson }}" data-edit-url="{{ URL::route('admin.menu.edit', ['id' => '%id%']) }}" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
    </tr>
    </tfoot>
</table>
{{--
<!-- <table class="table table-hover">
    <thead>
        <tr role="row">
            <th class="checkbox-column"></th>
            <th class="sorting">{{ Lang::get('menues.form.title') }}</th>
            <th class="sorting">{{ Lang::get('menues.form.pos') }}</th>
            <th class="sorting">{{ Lang::get('table_field.lists.published') }}</th>
            <th>{{ Lang::get('table_field.lists.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $aList as $menuItem )
        <tr class="gradeA odd" role="row">
            <td>{!! Form::checkbox('menu_items[]', $menuItem->id, false,  array('id' => 'check_' . $menuItem->id, 'class'=>'i-check')) !!}</td>
            <td class="">{{ $menuItem->title }}</td>
            <td class="center">{{ $menuItem->pos }}</td>
            <td class="center">{{ $menuItem->is_published }}</td>
            <td>
                {!! Html::_link(URL::route('admin.menu.edit', array('id' => $menuItem->id)), Lang::get('table_field.lists.edit') ) !!}
                <br>
                {!! Html::_link(URL::route('admin.menu.destroy', array('id' => $menuItem->id)), Lang::get('table_field.lists.delete') ) !!}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">{{ Lang::get('table_field.lists.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table> -->
--}}