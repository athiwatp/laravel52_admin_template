<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<table class="table table-hover">
    <thead>
        <tr role="row">
            <th class="checkbox-column"></th>
            <th class="sorting">{{ Lang::get('chapters.form.title') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.description') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.pos') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.is_active') }}</th>
            <th class="sorting">{{ Lang::get('table_field.lists.date') }}</th>
            <th class="sorting">{{ Lang::get('table_field.lists.user') }}</th>
            <th>{{ Lang::get('table_field.lists.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $aList as $chapterItem )
        <tr class="gradeA odd" role="row">
            <td>{!! Form::checkbox('chapter_items[]', $chapterItem->id, false,  array('id' => 'check_' . $chapterItem->id, 'class'=>'i-check')) !!}</td>
            <td class="">{{ $chapterItem->title }}</td>
            <td>{{ $chapterItem->description }}</td>
            <td class="center">{{ $chapterItem->pos }}</td>
            <td class="center">{{ $chapterItem->is_active }}</td>
            <td class="center">{{ $chapterItem->date }}</td>
            <td class="center">{{ $chapterItem->user_id }}</td>
            <td>
                {!! Html::_link(URL::route('admin.chapter.edit', array('id' => $chapterItem->id)), Lang::get('table_field.lists.edit') ) !!}
                <br>
                {!! Html::_link(URL::route('admin.chapter.destroy', array('id' => $chapterItem->id)), Lang::get('table_field.lists.delete') ) !!}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">{{ Lang::get('table_field.lists.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>