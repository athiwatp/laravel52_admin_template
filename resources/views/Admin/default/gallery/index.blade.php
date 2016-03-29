<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table id="example" class="datatables display responsive no-wrap" data-url="gallery" data-columns="{{ $sColumnsJson }}" data-edit-url="{{ URL::route('admin.gallery.edit', ['id' => '%id%']) }}" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th class="sorting">{{  Lang::get('gallery.form.title') }}</th>
            <th>{{ Lang::get('gallery.form.file') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Id</th>
            <th class="sorting">{{  Lang::get('gallery.form.title') }}</th>
            <th>{{ Lang::get('gallery.form.file') }}</th>
        </tr>
    </tfoot>
</table>