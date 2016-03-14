@extends( $__theme . '.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ Lang::get('table_field.news.news') }}</h1>
    </div>
</div>

<div class="row">
    <a href="{{ URL::route('admin.news.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> {{ Lang::get('table_field.news.create_news') }}</a>
    <div class="panel panel-default">
        <div class="panel-heading">{{ Lang::get('table_field.news.lists_news') }}</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">Id</th>
                                        <th class="sorting">Title</th>
                                        <th class="sorting">Important</th>
                                        <th class="sorting">Source</th>
                                        <th class="sorting">Published</th>
                                        <th class="sorting">Main</th>
                                        <th class="sorting">Date</th>
                                        <th class="sorting">User_id</th>
                                        <th>{{ Lang::get('table_field.lists.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $aList as $newsItem )
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">{{ $newsItem->id }}</td>
                                        <td class="">{{ $newsItem->title }}</td>
                                        <td>{{ $newsItem->is_important }}</td>
                                        <td class="center">{{ $newsItem->source }}</td>
                                        <td class="center">{{ $newsItem->is_published }}</td>
                                        <td class="center">{{ $newsItem->is_main }}</td>
                                        <td class="center">{{ $newsItem->date }}</td>
                                        <td class="center">{{ $newsItem->user_id }}</td>
                                        <td>
                                            <a href="{{ URL::route('admin.news.edit', array('id' => $newsItem->id)) }}">Edit</a>
                                            <br>
                                            <a href="{{ URL::route('admin.news.destroy', array('id' => $newsItem->id)) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9">{{ Lang::get('table_field.lists.empty') }}</td>
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