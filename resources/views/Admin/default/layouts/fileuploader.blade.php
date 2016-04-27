<!DOCTYPE html>
<html lang="en"
      ondragover="toggleDropzone('show')"
      ondragleave="toggleDropzone('hide')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="api_token" content="{{ Auth::user()->api_token }}" >
    <title>Завантаження документів</title>

    <meta name="author" content="Sergey Donchenko">
    <link rel="icon" href="/js/vendor/ckeditor/plugins/imageuploader/img/cd-ico-browser.ico">

    {!! Html::style('css/admin.css') !!}
    <link rel="stylesheet" href="/js/vendor/ckeditor/plugins/imageuploader/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/vendor/ckeditor/plugins/imageuploader/dist/jquery.lazyload.min.js"></script>
    <script src="/js/vendor/ckeditor/plugins/imageuploader/dist/js.cookie-2.0.3.min.js"></script>

    <script src="/js/vendor/ckeditor/plugins/imageuploader/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/vendor/ckeditor/plugins/imageuploader/dist/sweetalert.css">

    <script src="/js/vendor/ckeditor/plugins/imageuploader/function.js"></script>
    <script src="/js/vendor/ckeditor/ckeditor.min.js"></script>

    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
</head>
<body class="file-uploader">
<div id="header" class="file-uploader-header">
    <a class="logo" href="{{ route('home') }}" target="_blank">{{ get_site_name() }}</a>

    <img onclick="Cookies.remove('qEditMode');window.close();" src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-close-grey.png" class="headerIconRight iconHover">
    <?php /*?><img onclick="reloadImages();" src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-refresh.png" class="headerIconRight iconHover"> <?php */?>
    <img onclick="uploadImg();" src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-upload-grey.png" class="headerIconCenter iconHover">
</div>

<div id="editbar">
    <div id="editbarView" onclick="#" class="editbarDiv">
        <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-images.png" class="editbarIcon editbarIconLeft">
        <p class="editbarText">Перегляд</p>
    </div>

    <a href="#" id="editbarDownload" download>
        <div class="editbarDiv">
            <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-download.png" class="editbarIcon editbarIconLeft">
            <p class="editbarText">Завантажити</p>
        </div>
    </a>

    <div id="editbarUse" onclick="#" class="editbarDiv">
        <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-use.png" class="editbarIcon editbarIconLeft">
        <p class="editbarText">Використати</p>
    </div>

    <div id="editbarDelete" onclick="#" class="editbarDiv">
        <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-qtrash.png" class="editbarIcon editbarIconLeft">
        <p class="editbarText">Видалити</p>
    </div>

    <img onclick="hideEditBar();" src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-close-black.png" class="editbarIcon editbarIconRight">
</div>

@yield('content')

<!--Noscript part if js is disabled-->
<noscript>
    <div class="noscript">
        <div id="folderError" class="noscriptContainer popout">
            <br><br>JavaScript повинен бути активованний перед використанням данного плагіну.
            <a href="http://www.enable-javascript.com/" target="_blank">How to enable JavaScript in your browser (external link)</a>
        </div>
    </div>
</noscript>
</body>
</html>