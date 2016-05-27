<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="logs/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>{{ Lang::get('table_field.lists.date') }}</th>
            <th>{{ Lang::get('logs.lists.comment') }}</th>
            <th>{{ Lang::get('logs.lists.object') }}</th>
            <th>{{ Lang::get('logs.lists.user_id') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>{{ Lang::get('table_field.lists.date') }}</th>
            <th>{{ Lang::get('logs.lists.comment') }}</th>
            <th>{{ Lang::get('logs.lists.object') }}</th>
            <th>{{ Lang::get('logs.lists.user_id') }}</th>
        </tr>
    </tfoot>
</table>