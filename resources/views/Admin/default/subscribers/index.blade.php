<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="subscribers/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('subscribers.form.email') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('subscribers.form.email') }}</th>
    </tr>
    </tfoot>
</table>