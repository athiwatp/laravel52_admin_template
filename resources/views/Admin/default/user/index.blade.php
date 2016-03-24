<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap" data-url="users" data-columns="{{ $sColumnsJson }}" data-edit-url="{{ URL::route('admin.users.edit', ['id' => '%id%']) }}" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('users.form.name') }}</th>
        <th class="sorting">{{ Lang::get('users.form.email') }}</th>
        <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('users.form.name') }}</th>
        <th class="sorting">{{ Lang::get('users.form.email') }}</th>
        <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
    </tr>
    </tfoot>
</table>
{{--
<!-- <table class="table table-hover">
    <thead>
        <tr role="row">
            <th class="sorting_asc">Id</th>
            <th class="sorting">{{ Lang::get('users.form.name') }}</th>
            <th class="sorting">{{ Lang::get('users.form.email') }}</th>
            <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
            <th class="sorting">{{ Lang::get('users.form.is_admin') }}</th>
            <th class="sorting">{{ Lang::get('users.form.is_verified') }}</th>
            <th>{{ Lang::get('table_field.lists.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $aList as $userItem )
        <tr class="gradeA odd" role="row">
            <td class="sorting_1">{{ $userItem->id }}</td>
            <td class="">{{ $userItem->name }}</td>
            <td class="center">{{ $userItem->email }}</td>
            <td class="center">{{ $userItem->phone }}</td>
            <td class="center">{{ $userItem->is_admin }}</td>
            <td class="center">{{ $userItem->is_verified }}</td>
            <td>
                {!! Html::_link(URL::route('admin.users.edit', array('id' => $userItem->id)), Lang::get('table_field.lists.edit') ) !!}
                <br>
                {!! Html::_link(URL::route('admin.users.destroy', array('id' => $userItem->id)), Lang::get('table_field.lists.delete') ) !!}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">{{ Lang::get('table_field.lists.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table> -->
  --}}