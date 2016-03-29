<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="users/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('users.form.name') }}</th>
        <th class="sorting">{{ Lang::get('users.form.email') }}</th>
        <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
        <th class="sorting">{{ Lang::get('users.form.created') }}</th>
        <th class="sorting">{{ Lang::get('users.form.updated') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('users.form.name') }}</th>
        <th class="sorting">{{ Lang::get('users.form.email') }}</th>
        <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
        <th class="sorting">{{ Lang::get('users.form.created') }}</th>
        <th class="sorting">{{ Lang::get('users.form.updated') }}</th>
    </tr>
    </tfoot>
</table>