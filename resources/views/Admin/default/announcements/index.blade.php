<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="announcements/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('announce.form.date_start') }}</th>
        <th>{{ Lang::get('announce.form.date_end') }}</th>
        <th>{{ Lang::get('announce.form.title') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('announce.form.date_start') }}</th>
        <th>{{ Lang::get('announce.form.date_end') }}</th>
        <th>{{ Lang::get('announce.form.title') }}</th>
    </tr>
    </tfoot>
</table>