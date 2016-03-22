<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <title>Admin PervoSoft | @yield('title')</title>
    <meta name="description" content="@yield('description')">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sergey Donchenko">
    <meta name="api_token" content="{{ Auth::user()->api_token }}">

    {!! Html::style('css/vendor/metisMenu.min.css') !!}
    {!! Html::style('css/vendor/jquery.dataTables.min.css') !!}
    {!! Html::style('css/admin.css') !!}
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <!-- notification panel -->
            @include( $__theme . '.components.notification-bar')
            <!-- /.notification panel -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse metismenu">
                    @include( $__theme . '.components.left-sidebar-menues')
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div class="content-wrapper" id="page-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('page_header')
            </section>
            <section class="content">
                @if (Session::has('message'))
                <?php
                    $aMessage = Session::get('message');
                    $sType    = 'alert alert-warning alert-dismissable';
                    
                    if ( is_array($aMessage) ) {
                        $sType    = $aMessage['code'];
                        $sMessage = $aMessage['message'];
                    } else {
                        $sMessage = $aMessage;
                    }
                ?>

                <div class="{{$sType}}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ $sMessage }}
                </div>
                @endif

            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

{!! Html::script('js/vendor/jquery.min.js') !!}
{!! Html::script('js/vendor/bootstrap.min.js') !!}

<!-- Metis Menu Plugin JavaScript -->
{!! Html::script('js/vendor/metisMenu.min.js') !!}}

<!-- Custom Theme JavaScript -->
{!! Html::script('js/admin.js') !!}
</body>
</html>