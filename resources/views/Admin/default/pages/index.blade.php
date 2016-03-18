<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<table class="table table-hover">
    <thead>
        <tr role="row">
            <th class="checkbox-column"></th>
            <th class="sorting">Date</th>
            <th class="sorting">Title</th>
            <th class="sorting">Published</th>
            <th class="sorting">User</th>
            <th>{{ Lang::get('table_field.lists.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $aList as $pageItem )
        <tr class="gradeA odd" role="row">
            <td>{!! Form::checkbox('page_items[]', $pageItem->id, false,  array('id' => 'check_' . $pageItem->id, 'class'=>'i-check')) !!}</td>
            <td class="center">{{ $pageItem->created_at }}</td>
            <td class="">{{ $pageItem->title }}</td>
            <td class="center">{{ $pageItem->is_published }}</td>
            <td class="center">{{ $pageItem->user_id }}</td>
            <td>
                {!! Html::_link(URL::route('admin.pages.edit', array('id' => $pageItem->id)), Lang::get('table_field.lists.edit') ) !!}
                <br>
                {!! Html::_link(URL::route('admin.pages.destroy', array('id' => $pageItem->id)), Lang::get('table_field.lists.delete') ) !!}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">{{ Lang::get('table_field.lists.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>