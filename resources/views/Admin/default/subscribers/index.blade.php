<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="subscribers/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('subscribers.form.email') }}</th>
            <th class="sorting">{{ Lang::get('table_field.lists.active') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('subscribers.form.email') }}</th>
            <th class="sorting">{{ Lang::get('table_field.lists.active') }}</th>
        </tr>
    </tfoot>
</table>