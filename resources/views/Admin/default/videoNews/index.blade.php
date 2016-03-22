<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table id="example" class="datatables display responsive no-wrap" data-url="video-news" data-columns="{{ $sColumnsJson }}" data-edit-url="{{ URL::route('admin.videoNews.edit', ['id' => '%id%']) }}" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Url</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Url</th>
    </tr>
    </tfoot>
</table>