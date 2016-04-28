<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="customerReviews/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('table_field.lists.date') }}</th>
            <th>{{ Lang::get('customer_reviews.form.client') }}</th>
            <th>{{ Lang::get('table_field.lists.active') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>{{ Lang::get('table_field.lists.date') }}</th>
            <th>{{ Lang::get('customer_reviews.form.client') }}</th>
            <th>{{ Lang::get('table_field.lists.active') }}</th>
        </tr>
    </tfoot>
</table>