@extends( $__theme . '.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bullhorn fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ Lang::get('announce.lists.active_announces', array('num' => $countAnnounces)) }}</div>
                            <div class="body-huge">
                                <a href="{{ URL::route('admin.announcements.create') }}" class="btn btn-warning" title="{{ Lang::get('announce.lists.create_announce') }}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::route('admin.announcements.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ Lang::get('announce.lists.go_to_announce') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list-alt fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ Lang::get('news.lists.active_news', array('num' => $countNews)) }}</div>
                            <div class="body-huge">
                                <a href="{{ URL::route('admin.news.create') }}" class="btn btn-primary" title="{{ Lang::get('news.lists.create_new_news') }}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::route('admin.news.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ Lang::get('news.lists.go_to_news') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-camera fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ Lang::get('gallery.lists.count_gallery', array('num' => $countGallery)) }}</div>
                            <div class="body-huge">
                                <a href="{{ URL::route('admin.gallery.create') }}" class="btn btn-success" title="{{ Lang::get('gallery.lists.create_new_gallery') }}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::route('admin.gallery.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ Lang::get('gallery.lists.go_to_gallery') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-video-camera fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ Lang::get('videoNews.lists.count_video_news', array('num' => $countVideoNews)) }}</div>
                            <div class="body-huge">
                                <a href="{{ URL::route('admin.videoNews.create') }}" class="btn btn-danger" title="{{ Lang::get('videoNews.lists.create_video_news') }}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::route('admin.videoNews.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ Lang::get('videoNews.lists.go_to_video_news') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ Lang::get('announce.lists.ten_latest_announce') }}</div>
            <div class="panel-body">
                <table class="datatables display responsive no-wrap" data-module="announcements/list" data-query="dashboard=true" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ Lang::get('announce.form.date') }}</th>
                            <th>{{ Lang::get('announce.form.title') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ Lang::get('announce.form.date') }}</th>
                            <th>{{ Lang::get('announce.form.title') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ Lang::get('news.lists.ten_latest_news') }}
            </div>
            <div class="panel-body">
                <table class="datatables display responsive no-wrap" data-module="news/list" data-query="dashboard=true" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ Lang::get('table_field.lists.date') }}</th>
                            <th>{{ Lang::get('news.form.title') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ Lang::get('table_field.lists.date') }}</th>
                            <th>{{ Lang::get('news.form.title') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ Lang::get('logs.lists.ten_latest_logs') }} <a href="{{ URL::route('admin.logs') }}">{{ Lang::get('logs.lists.all_logs') }}</a></div>
            <div class="panel-body">
                <table class="datatables display responsive no-wrap" data-module="logs/list" data-query="dashboard=true" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{ Lang::get('table_field.lists.date') }}</th>
                            <th>{{ Lang::get('logs.lists.comment') }}</th>
                            <th>{{ Lang::get('logs.lists.object') }}</th>
                            <th>{{ Lang::get('logs.lists.user_id') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>{{ Lang::get('table_field.lists.date') }}</th>
                            <th>{{ Lang::get('logs.lists.comment') }}</th>
                            <th>{{ Lang::get('logs.lists.object') }}</th>
                            <th>{{ Lang::get('logs.lists.user_id') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection