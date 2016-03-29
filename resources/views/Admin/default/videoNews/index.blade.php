<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table id="example" class="datatables display responsive no-wrap"
       data-module="video/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('videoNews.form.preview') }}</th>
        <th>{{ Lang::get('videoNews.form.title') }}</th>
        <th>{{ Lang::get('table_field.lists.created') }}</th>
        <th>{{ Lang::get('table_field.lists.updated') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>{{ Lang::get('videoNews.form.preview') }}</th>
        <th>{{ Lang::get('videoNews.form.title') }}</th>
        <th>{{ Lang::get('table_field.lists.created') }}</th>
        <th>{{ Lang::get('table_field.lists.updated') }}</th>
    </tr>
    </tfoot>
</table>