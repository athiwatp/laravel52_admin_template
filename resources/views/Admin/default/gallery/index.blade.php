<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="gallery/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th class="sorting">{{  Lang::get('gallery.form.title') }}</th>
            <th>{{ Lang::get('gallery.form.file') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th class="sorting">{{  Lang::get('gallery.form.title') }}</th>
            <th>{{ Lang::get('gallery.form.file') }}</th>
        </tr>
    </tfoot>
</table>