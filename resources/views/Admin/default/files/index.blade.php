@extends( $__theme . '.layouts.fileuploader')

@section('content')

    <div id="updates" class="popout"></div>

    <div id="dropzone" class="dropzone"
         ondragenter="return false;"
         ondragover="return false;"
         ondrop="drop(event)">
        <p>
            <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-upload-big.png">
            <br>
            {{ Lang::get('table_field.files.destroy_file') }}
        </p>
    </div>


    {{--<div class="menu-toolbar">{!!  Toolbar::getToolbarParams($aToolbar, $aFilters) !!}</div>--}}

    <p class="folderInfo">
        {{ Lang::get('table_field.files.total') }} <span id="finalcount">{{ $iFilesCount }}</span>,
        {{ Lang::get('table_field.files.pictures') }} - <span id="finalsize">{{ $fSizeSumm }}</span>
    </p>

    <div id="files" class="file-list">
        <div class="panel panel-default">

            @if ($oFiles && $oFiles->count() > 0)
                <div class="panel-body">
                    @foreach( $oFiles as $oFileItem)
                        @include( $__theme . '.files.box-item', [
                            'item' => $oFileItem,
                            'iHeight' => '400'
                        ])
                    @endforeach
                </div>
                <div class="text-center">{{ $oFiles->links() }}</div>
            @else
                {{ Lang::get('table_field.files.uploaded_documents_not_found') }}
            @endif

        </div>
    </div>

    <div id="imageFullSreen" class="lightbox popout">
        <div class="buttonBar">
            <button id="imageFullSreenClose" class="headerBtn" onclick="$('#imageFullSreen').hide(); $('#background').slideUp(250, 'swing');">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-close.png" class="headerIcon">
            </button>
            <button class="headerBtn" id="imgActionDelete">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-delete.png" class="headerIcon">
            </button>

            <a href="#" id="imgActionDownload" download>
                <button class="headerBtn">
                    <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-download.png" class="headerIcon">
                </button>
            </a>

            <button class="headerBtn greenBtn" id="imgActionUse" onclick="#" class="imgActionP">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-use.png" class="headerIcon"> {{ Lang::get('admin_page.upload.use') }}
            </button>
        </div>
        <br><br>
        <img id="imageFSimg" src="#" style="#"><br>
    </div>

    <div id="uploadImgDiv" class="lightbox popout">
        <div class="buttonBar">
            <button class="headerBtn" onclick="$('#uploadImgDiv').hide(); $('#background2').slideUp(250, 'swing');">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-close.png" class="headerIcon">
            </button>

            <button class="headerBtn greenBtn" name="submit" onclick="$('#uploadImgForm').submit();">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-upload.png" class="headerIcon">
                {{ Lang::get('table_field.files.download') }}
            </button>
        </div>
        <br><br><br>

        <form action="{{ URL::route('file-upload') }}" method="post" enctype="multipart/form-data" id="uploadImgForm" onsubmit="return checkUpload();">
            <p class="uploadP">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-select.png" class="headerIcon">
                {{ Lang::get('table_field.files.file_to_download') }}:
            </p>
            <input type="file" name="upload" id="upload">
            <input type="hidden" name="CKEditorFuncNum" value="{{ $CKEditorFuncNum }}">

            <br>

            <h3 class="settingsh3" style="font-size:12px;font-weight:lighter;">
                {{ Lang::get('table_field.files.file_download_save_dir') }}:<br>
                <p style="font-weight:bolder;">"{{ $sUserUploadFolder }}"</p>
                {{ Lang::get('table_field.files.administrator_can_change_settings') }}
            </h3>
            <br>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>
    </div>


    <div id="settingsDiv" class="lightbox popout">
        <div class="buttonBar">
            <button class="headerBtn" onclick="$('#settingsDiv').hide(); $('#background3').slideUp(250, 'swing');">
                <img src="/js/vendor/ckeditor/plugins/imageuploader/img/cd-icon-close.png" class="headerIcon">
            </button>
        </div>
        <br><br><br>

        <h3 class="settingsh3">{{ Lang::get('admin_page.upload.upload_path') }}:</h3>
        <p class="settingsh3 saveUploadPathP">{{ Lang::get('admin_page.upload.choose_existing_folder') }}:</p>
        <p class="uploadP editable" id="uploadpathEditable">{{ $sUserUploadFolder }}</p>
        <p class="settingsh3 saveUploadPathP">{{ Lang::get('admin_page.upload.path_history') }}:</p>
        <?php
        //pathHistory();
        ?>
        <button class="headerBtn greyBtn saveUploadPathA" id="pathCancel">{{ Lang::get('admin_page.upload.cancel') }}</button>
        <button class="headerBtn saveUploadPathA" onclick="updateImagePath();">{{ Lang::get('admin_page.upload.save') }}</button><br class="saveUploadPathA">

        <br><h3 class="settingsh3">{{ Lang::get('admin_page.upload.settings') }}:</h3>
        @if($sFileExtens == "yes")
            <p class="uploadP" onclick="extensionSettings('no');"><img src="img/cd-icon-hideext.png" class="headerIcon"> {{ Lang::get('admin_page.upload.hide_file_extension') }}</p>
        @elseif($sFileExtens == "no")
            <p class="uploadP" onclick="extensionSettings('yes');"><img src="img/cd-icon-showext.png" class="headerIcon"> {{ Lang::get('admin_page.upload.show_file_extension') }}</p>
        @endif
        <br>
    </div>
@stop
