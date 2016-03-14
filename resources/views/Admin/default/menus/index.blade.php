@extends( $__theme . '.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ Lang::get('layouts.layouts.menu') }}</h1>
    </div>
</div>

<div class="row">
    <a href="{{ URL::route('admin.menu.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> {{ Lang::get('table_field.menus.create_menu') }}</a>
    <div class="panel panel-default">
        <div class="panel-heading">{{ Lang::get('table_field.menus.lists_menus') }}</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">Id</th>
                                        <th class="sorting">{{ Lang::get('menus.form.title') }}</th>
                                        <th class="sorting">{{ Lang::get('menus.form.pos') }}</th>
                                        <th class="sorting">{{ Lang::get('menus.form.is_published') }}</th>
                                        <th class="sorting">{{ Lang::get('menus.form.is_loaded_by_default') }}</th>
                                        <th class="sorting">{{ Lang::get('menus.form.is_shown_print_version') }}</th>
                                        <th class="sorting">User id</th>
                                        <th>{{ Lang::get('table_field.lists.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $aList as $menuItem )
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">{{ $menuItem->id }}</td>
                                        <td class="">{{ $menuItem->title }}</td>
                                        <td class="center">{{ $menuItem->pos }}</td>
                                        <td class="center">{{ $menuItem->is_published }}</td>
                                        <td class="center">{{ $menuItem->is_loaded_by_default }}</td>
                                        <td class="center">{{ $menuItem->is_shown_print_version }}</td>
                                        <td class="center">{{ $menuItem->user_id }}</td>
                                        <td>
                                            <a href="{{ URL::route('admin.menu.edit', array('id' => $menuItem->id)) }}">Edit</a>
                                            <br>
                                            <a href="{{ URL::route('admin.menu.destroy', array('id' => $menuItem->id)) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            <td colspan="9">{{ Lang::get('table_field.lists.empty') }}</td>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop