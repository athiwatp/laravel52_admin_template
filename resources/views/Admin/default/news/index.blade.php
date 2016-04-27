<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="news/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ Lang::get('table_field.lists.date') }}</th>
        <th>{{ Lang::get('news.form.title') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>#</th>
        <th>{{ Lang::get('table_field.lists.date') }}</th>
        <th>{{ Lang::get('news.form.title') }}</th>
    </tr>
    </tfoot>
</table>