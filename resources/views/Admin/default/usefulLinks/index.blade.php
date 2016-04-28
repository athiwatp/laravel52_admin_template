<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="usefulLinks/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('useful_links.form.title') }}</th>
            <th>{{ Lang::get('useful_links.form.url') }}</th>
            <th>{{ Lang::get('useful_links.form.active') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('useful_links.form.title') }}</th>
            <th>{{ Lang::get('useful_links.form.url') }}</th>
            <th>{{ Lang::get('useful_links.form.active') }}</th>
        </tr>
    </tfoot>
</table>