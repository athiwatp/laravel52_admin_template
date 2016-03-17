<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sergey Donchenko">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- MetisMenu CSS -->
    {!! Html::style('css/vendor/metisMenu.min.css') !!}
    {!! Html::style('css/admin.css') !!}
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">PS Admin v1.0</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="{{ URL::route('admin.settings') }}"><i class="fa fa-gear fa-fw"></i> {{ Lang::get('settings.form.settings') }}</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ URL::route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{ Lang::get('layouts.layouts.logout') }}</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse metismenu">
                @include( $__theme . '.components.left-sidebar-menues')
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

{!! Html::script('js/vendor/jquery.min.js') !!}
{!! Html::script('js/vendor/bootstrap.min.js') !!}

<!-- Metis Menu Plugin JavaScript -->
{!! Html::script('js/vendor/metisMenu.min.js') !!}

<!-- Custom Theme JavaScript -->
{!! Html::script('js/admin.js') !!}
</body>
</html>