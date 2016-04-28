<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap" data-url="pages"
       data-module="pages/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('pages.form.title') }}</th>
            <th>{{ Lang::get('table_field.lists.published') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('pages.form.title') }}</th>
            <th>{{ Lang::get('table_field.lists.published') }}</th>
        </tr>
    </tfoot>
</table>