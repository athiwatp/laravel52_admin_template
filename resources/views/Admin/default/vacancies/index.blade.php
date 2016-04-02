<div class="menu-toolbar">{!! Toolbar::getToolbarParams($aToolbar) !!}</div>
<br>
<table class="datatables display responsive no-wrap"
       data-module="vacancies/list"
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th class="sorting">{{ Lang::get('vacancies.form.title') }}</th>
            <th class="sorting">{{ Lang::get('vacancies.form.date_reg') }}</th>
            <th class="sorting">{{ Lang::get('vacancies.form.employer') }}</th>
            <th class="sorting">{{ Lang::get('vacancies.form.city') }}</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Id</th>
            <th class="sorting">{{ Lang::get('vacancies.form.title') }}</th>
            <th class="sorting">{{ Lang::get('vacancies.form.date_reg') }}</th>
            <th class="sorting">{{ Lang::get('vacancies.form.employer') }}</th>
            <th class="sorting">{{ Lang::get('vacancies.form.city') }}</th>
        </tr>
    </tfoot>
</table>