<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<table class="table table-hover">
    <thead>
        <tr role="row">
            <th class="checkbox-column"></th>
            <th class="sorting">Date</th>
            <th class="sorting">Title</th>
            <th class="sorting">Description</th>
            <th class="sorting">File</th>
            <th class="sorting">User</th>
            <th>{{ Lang::get('table_field.lists.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $aList as $galleryItem )
        <tr class="gradeA odd" role="row">
            <td>{!! Form::checkbox('gallery_items[]', $galleryItem->id, false, array('id' => 'check_' . $galleryItem->id, 'class'=>'i-check')) !!}</td>
            <td class="center">{{ $galleryItem->created_at }}</td>
            <td class="">{{ $galleryItem->title }}</td>
            <td class="center">{{ $galleryItem->is_published }}</td>
            <td class="center">{{ $galleryItem->user_id }}</td>
            <td>
                {!! Html::_link(URL::route('admin.gallery.edit', array('id' => $galleryItem->id)), Lang::get('table_field.lists.edit') ) !!}
                <br>
                {!! Html::_link(URL::route('admin.gallery.destroy', array('id' => $galleryItem->id)), Lang::get('table_field.lists.delete') ) !!}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">{{ Lang::get('table_field.lists.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>