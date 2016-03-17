<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    {!! Html::_link( URL::route('admin.dashboard'), '<b>Admin</b>PervoSoft v1.0', array('class' => 'navbar-brand') ) !!}
</div>
<!-- /.navbar-header -->
<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                {!! Html::_link( URL::route( 'admin.user.edit', array( 'id' => Auth::id() ) ), '<i class="fa fa-user fa-fw"></i> ' . Lang::get('users.form.profile') ) !!}
            </li>
            <li>
                {!! Html::_link( URL::route('admin.settings'), '<i class="fa fa-gear fa-fw"></i> ' . Lang::get('settings.form.settings') ) !!}
            </li>
            <li class="divider"></li>
            <li>
                {!! Html::_link( URL::route('admin.logout'), '<i class="fa fa-sign-out fa-fw"></i> ' . Lang::get('layouts.layouts.logout') ) !!}
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->