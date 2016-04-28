<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="users/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('users.form.name') }}</th>
            <th class="sorting">{{ Lang::get('users.form.email') }}</th>
            <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('users.form.name') }}</th>
            <th class="sorting">{{ Lang::get('users.form.email') }}</th>
            <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
        </tr>
    </tfoot>
</table>