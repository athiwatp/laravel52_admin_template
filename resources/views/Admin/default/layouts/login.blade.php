<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sergey Donchenko">

    <title>Login page</title>

    {!! Html::style('css/app.css') !!}
</head>
<body>

    <div class="container">
        <div class="row">@yield('content')</div>
    </div>

    {!! Html::script('js/vendor/jquery.min.js') !!}
    {!! Html::script('js/app.js') !!}
</body>
</html>