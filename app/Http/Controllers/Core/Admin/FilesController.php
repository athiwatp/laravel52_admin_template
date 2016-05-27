<?php

namespace App\Http\Controllers\Core\Admin;

use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use App\Events\Files\FileWasLoaded;
use App\Http\Requests;
use App\Helpers\File as cFile;
use Carbon\Carbon, Lang, Config, Redirect, Event;

class FilesController extends AdminController
{
    /**
     * Injected variable
     *
     * @var Object
    */
    protected $file = null;

    /**
     * Create a new PagesController instance
     *
     * @param App\Repositories\PagesRepository
     *
     * @return void
     */
    public function __construct(FileRepository $file)
    {
        // Inject fire repository
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sSelectedFilterTypeFile = $request->get('type_file');
        $sSelectedFilterTypeContent = $request->get('type_content');
        $CKEditorFuncNum = $request->get('CKEditorFuncNum');
        $sUserUploadFolder = cFile::getDestinationFolder();
        $sFileExtens = '';
        $sFileStype = 0;

        $oFile = $this->file->getLatest([
            'file_type' => $sSelectedFilterTypeFile,
            'content_type' => $sSelectedFilterTypeContent
        ]);

        return $this->renderView('files.index', [
            'sFileStyle' => $sFileStype,
            'fSizeSumm' => round( $oFile->sum / 1024 / 1024, 1) . ' MB',
            'iFilesCount' => $oFile->count,
            'CKEditorFuncNum' => $CKEditorFuncNum,
            'sUserUploadFolder' => $sUserUploadFolder,
            'sFileExtens' => $sFileExtens,
            'oFiles' => $oFile->list,
            'aToolbar' => [
                'template' => $this->getTheme()
            ],
            'aFilters' => array(
                'url' => route('files-list'),
                'items' => array(
                    'type_content' => [
                        'data' => $this->file->getContentType() ,
                        'selected' => $sSelectedFilterTypeContent
                    ],
                    'type_file' => [
                        'data' => $this->file->getFileTypes(),
                        'selected' => $sSelectedFilterTypeFile
                    ]
                )
            )
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function show()
    {

    }

    /**
     * Show thank you page
     *
    */
    public function thanks(Request $request)
    {
        $iFileId = $request->get('targetFileId');
        $oFile   = null;

        if ($iFileId) {
            $oFile = $this->file->getById( $iFileId );
        }

        return $this->renderView('files.thanks', [
            'oFile' => $oFile,
            'iHeight' => 400
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $TYPE_CONTENT = Config::get('constants.RESOURCES.CONTENT');
        $STATUS    = Config::get('constants.DONE_STATUS.FAILURE');

        $sMessage  = Lang::get('table_field.files.message_error');
        $aParams   = [];

        if ( $request->hasFile('upload') ) {
            $response = Event::fire( new FileWasLoaded([
                'type' => $TYPE_CONTENT,
                'id' => -1,
                'token_id' => $request->get('_token'),
                'file' => $request->file('upload'),
                'prefix' => '%s',
                'date' => Carbon::now()->toDateString()
            ]));

            $response = $response ? current($response) : null;

            if ($response && $response->code === Config::get('constants.DONE_STATUS.SUCCESS') ) {
                $aParams['targetFileId']    = $response->id;
                $aParams['CKEditorFuncNum'] = $request->get('CKEditorFuncNum');

                $STATUS   = $response->code;
                $sMessage = Lang::get('table_field.files.message');
            }
        }

        return Redirect::route('file-thanks-page', $aParams)
            ->with('message', [
                'code' => $STATUS,
                'message' => $sMessage
            ]);
    }


}
