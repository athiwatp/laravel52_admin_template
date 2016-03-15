@extends( $__theme . '.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ Lang::get('layouts.layouts.users_management') }}</h1>
    </div>
</div>

<div class="row">
    {{ Html::link(URL::route('admin.user.create'), Lang::get('table_field.users.create_user'), array( 'class' => 'btn btn-outline btn-success') ) }}
    <div class="panel panel-default">
        <div class="panel-heading">{{ Lang::get('table_field.users.lists_users') }}</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">Id</th>
                                        <th class="sorting">{{ Lang::get('users.form.name') }}</th>
                                        <th class="sorting">{{ Lang::get('users.form.email') }}</th>
                                        <th class="sorting">{{ Lang::get('users.form.phone') }}</th>
                                        <th class="sorting">{{ Lang::get('users.form.is_admin') }}</th>
                                        <th class="sorting">{{ Lang::get('users.form.is_verified') }}</th>
                                        <th>{{ Lang::get('table_field.lists.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $aList as $userItem )
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">{{ $userItem->id }}</td>
                                        <td class="">{{ $userItem->name }}</td>
                                        <td class="center">{{ $userItem->email }}</td>
                                        <td class="center">{{ $userItem->phone }}</td>
                                        <td class="center">{{ $userItem->is_admin }}</td>
                                        <td class="center">{{ $userItem->is_verified }}</td>
                                        <td>
                                            <a href="{{ URL::route('admin.user.edit', array('id' => $userItem->id)) }}">Edit</a>
                                            <br>
                                            <a href="{{ URL::route('admin.user.destroy', array('id' => $userItem->id)) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            <td colspan="6">{{ Lang::get('table_field.lists.empty') }}</td>
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