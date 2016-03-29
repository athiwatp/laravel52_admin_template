<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="menu/list"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th class="sorting">{{ Lang::get('menues.form.title') }}</th>
        <th class="sorting">{{ Lang::get('menues.form.pos') }}</th>
        <th class="sorting">{{ Lang::get('menues.form.is_published') }}</th>
        <th class="sorting">{{ Lang::get('table_field.lists.date') }}</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th class="sorting">{{ Lang::get('menues.form.title') }}</th>
        <th class="sorting">{{ Lang::get('menues.form.pos') }}</th>
        <th class="sorting">{{ Lang::get('menues.form.is_published') }}</th>
        <th class="sorting">{{ Lang::get('table_field.lists.date') }}</th>
    </tr>
    </tfoot>
</table>