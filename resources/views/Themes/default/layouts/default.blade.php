<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sergey Donchenko" >
    <meta name="api_token" content="{{ csrf_token() }}">

    <title>Clean Blog</title>

    {{-- Custom CSS --}}
    @yield('css')

    {!! Html::style('css/app.css') !!}

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
<body class="pervosoft-template">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Sonata Template</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {!! main_menu() !!}
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Header -->
@yield('page_header')

<!-- Main Content -->
<div class="container">
    @yield('content')
    {!! sidebar_menu() !!}
</div>
<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                <ul class="list-inline text-center">
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>


            </div>
        </div>

        <div class="row">
            <div class="col col-md-9"></div>
            <div class="col col-md-3" id="footer-subscriber">
                <my-subscriber
                        cmp-header="Підписка на новини"
                        cmp-description="Підпишіться на нашу електронну розсилку, щоб отримувати останні новини, свіжі статті та іншу корисну інформацію."
                        cmp-field-placeholder="Вкажіть e-mail">
                </my-subscriber>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-5">{!! footer_menu() !!}</div>
            <div class="col col-md-3">
                <p class="copyright text-muted">{!! build_copyright() !!}</p>
            </div>
        </div>
    </div>
</footer>




{!! Html::script('js/vendor/jquery.min.js') !!}
{!! Html::script('js/vendor/bootstrap.min.js') !!}

{{-- Custom javascript --}}
@yield('javascript')

<!-- Custom Theme JavaScript -->
{!! Html::script('js/app.js') !!}

    </body>
</html>