<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table id="example" class="datatables display responsive no-wrap"
       data-module="video/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ Lang::get('table_field.lists.date') }}</th>
        <th>{{ Lang::get('videoNews.form.title') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{ Lang::get('table_field.lists.date') }}</th>
        <th>{{ Lang::get('videoNews.form.title') }}</th>
    </tr>
    </tfoot>
</table>