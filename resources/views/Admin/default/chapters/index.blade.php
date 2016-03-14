@extends( $__theme . '.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ Lang::get('table_field.chapters.chapters') }}</h1>
    </div>
</div>

<div class="row">
    <a href="{{ URL::route('admin.chapter.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> {{ Lang::get('table_field.chapters.create_chapter') }}</a>
    <div class="panel panel-default">
        <div class="panel-heading">{{ Lang::get('table_field.chapters.lists_chapters') }}</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">Id</th>
                                        <th class="sorting">Title</th>
                                        <th class="sorting">Description</th>
                                        <th class="sorting">Pos</th>
                                        <th class="sorting">Path</th>
                                        <th class="sorting">Is active</th>
                                        <th class="sorting">Date</th>
                                        <th class="sorting">User_id</th>
                                        <th>{{ Lang::get('table_field.lists.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $aList as $chaptersItem )
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">{{ $chaptersItem->id }}</td>
                                        <td class="">{{ $chaptersItem->title }}</td>
                                        <td>{{ $chaptersItem->description }}</td>
                                        <td class="center">{{ $chaptersItem->pos }}</td>
                                        <td class="center">{{ $chaptersItem->path }}</td>
                                        <td class="center">{{ $chaptersItem->is_active }}</td>
                                        <td class="center">{{ $chaptersItem->date }}</td>
                                        <td class="center">{{ $chaptersItem->user_id }}</td>
                                        <td>
                                            <a href="{{ URL::route('admin.chapter.edit', array('id' => $chaptersItem->id)) }}">Edit</a>
                                            <br>
                                            <a href="{{ URL::route('admin.chapter.destroy', array('id' => $chaptersItem->id)) }}">Delete</a>
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