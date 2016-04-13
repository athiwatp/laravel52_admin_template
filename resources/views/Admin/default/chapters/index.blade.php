<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap" data-url="chapters" data-module="chapters/list"
       data-edit-url="{{ URL::route('admin.chapter.edit', ['id' => '%id%']) }}"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>{{ Lang::get('chapters.form.title') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.pos') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.is_active') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>{{ Lang::get('chapters.form.title') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.pos') }}</th>
            <th class="sorting">{{ Lang::get('chapters.form.is_active') }}</th>
        </tr>
    </tfoot>
</table>
