<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="news/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Date</th>
        <th>Title</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Date</th>
        <th>Title</th>
    </tr>
    </tfoot>
</table>
{{--
<!-- <table class="table table-hover">
    <thead>
        <tr role="row">
            <th class="checkbox-column"></th>
            <th class="sorting">Title</th>
            <th class="sorting">Important</th>
            <th class="sorting">Source</th>
            <th class="sorting">Published</th>
            <th class="sorting">Main</th>
            <th class="sorting">Date</th>
            <th class="sorting">User_id</th>
            <th>{{ Lang::get('table_field.lists.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $aList as $newsItem )
        <tr class="gradeA odd" role="row">
            <td>{!! Form::checkbox('news_items[]', $newsItem->id, false,  array('id' => 'check_' . $newsItem->id, 'class'=>'i-check')) !!}</td>
            <td class="">{{ $newsItem->title }}</td>
            <td>{{ $newsItem->is_important }}</td>
            <td class="center">{{ $newsItem->source }}</td>
            <td class="center">{{ $newsItem->is_published }}</td>
            <td class="center">{{ $newsItem->is_main }}</td>
            <td class="center">{{ $newsItem->date }}</td>
            <td class="center">{{ $newsItem->user_id }}</td>
            <td>
                {!! Html::_link(URL::route('admin.news.edit', array('id' => $newsItem->id)), Lang::get('table_field.lists.edit') ) !!}
                <br>
                {!! Html::_link(URL::route('admin.news.destroy', array('id' => $newsItem->id)), Lang::get('table_field.lists.delete') ) !!}
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