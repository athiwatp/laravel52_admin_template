<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ChaptersRequest;
use App\Repositories\ChaptersRepository;

use App\Events\Files\FileWasLoaded;
use App\Events\Files\FileWasRemoved;
use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Carbon\Carbon, Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Event, Config;

class ChaptersController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\ChaptersRepository
     */
    protected $chapters;

    /**
     * Create a new ChaptersController instance
     *
     * @param App\Repositories\ChaptersRepository
     *
     * @return void
     */
    public function __construct( ChaptersRepository $chapters )
    {
        $this->chapters = $chapters;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAnnouncements()
    {
        $sType = Config::get('constants.CHAPTER.ANNOUNCE');

        $aParams = array(
            'aBreadcrumbs' => array(array('url' => '#', 'icon' => '<i class="fa fa-th-list"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_announces'))),
            'sTitle'    => Lang::get('chapters.lists.management_chapters_announces'),
            'sSubTitle' => Lang::get('chapters.lists.announces'),
            'sBoxTitle' => Lang::get('chapters.lists.lists_announces'),
            'sUrl'      => 'admin.chapter.announcements',
            );

        return $this->index( $sType, $aParams );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGallery()
    {
        $sType = Config::get('constants.CHAPTER.GALLERY');

        $aParams = array(
            'aBreadcrumbs' => array(array('url' => '#', 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_gallery'))),
            'sTitle'    => Lang::get('chapters.lists.management_chapters_gallery'),
            'sSubTitle' => Lang::get('chapters.lists.gallery'),
            'sBoxTitle' => Lang::get('chapters.lists.lists_chapters_gallery'),
            'sUrl'      => 'admin.chapter.gallery',
            );

        return $this->index( $sType, $aParams );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $sType = '0', $aParams = null )
    {
        if ( $aParams === null ) {
            $aBreadcrumbs = array(
                ($sType === '0' ? array('url' => '#', 'icon' => '<i class="fa fa-object-group"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')) :
                array('url' => '#', 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_gallery')) )
            );
            $sTitle    = Lang::get('chapters.lists.management_chapters');
            $sSubTitle = Lang::get('chapters.lists.chapters');
            $sBoxTitle = Lang::get('chapters.lists.lists_chapters');
            $sUrl      = 'admin.chapter.index';
            $sType     = Config::get('constants.CHAPTER.CHAPTER');
        } else {

            $aBreadcrumbs = $aParams['aBreadcrumbs'];
            $sTitle       = $aParams['sTitle'];
            $sSubTitle    = $aParams['sSubTitle'];
            $sBoxTitle    = $aParams['sBoxTitle'];
            $sUrl         = $aParams['sUrl'];
        }

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => $sTitle,
            'sSubTitle' => $sSubTitle,
            'sBoxTitle' => $sBoxTitle,
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('chapters.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.chapter.create', array('sType' => $sType)),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_chapter', 'class' => 'add-btn')
                    ),
                    'edit' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_chapter', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.chapter.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_chapter', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.chapter.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route( $sUrl ),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_chapter', 'class' => 'refresh-btn', 'data-url' => URL::route( $sUrl ) )
                    )
                )
            ))
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( ChaptersRequest $request )
    {
        if ( $request->sType === Config::get('constants.CHAPTER.CHAPTER') ) {
            $aBreadcrumbs = array(
                array('url' => URL::route('admin.chapter.index'), 'icon' => '<i class="fa fa-object-group"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')),
                array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('chapters.lists.create_chapter')));

            $formChapter = Lang::get('chapters.lists.management_chapters');
            $formTitle   = Lang::get('chapters.lists.create_new_chapter');
            $sUrl        = 'admin.chapter.index';
        } elseif ( $request->sType === Config::get('constants.CHAPTER.GALLERY') ) {
            $aBreadcrumbs = array(
                array('url' => URL::route('admin.chapter.gallery'), 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_gallery')),
                array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('chapters.lists.create_chapter_gallery')));

            $formChapter = Lang::get('chapters.lists.management_chapters_gallery');
            $formTitle   = Lang::get('chapters.lists.create_new_chapter_gallery');
            $sUrl        = 'admin.chapter.gallery';
        } else {
            $aBreadcrumbs = array(
                array('url' => URL::route('admin.chapter.announcements'), 'icon' => '<i class="fa fa-th-list"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_announces')),
                array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('chapters.lists.create_chapter_announces')));

            $formChapter = Lang::get('chapters.lists.management_chapters_announces');
            $formTitle   = Lang::get('chapters.lists.create_new_chapter_announce');
            $sUrl        = 'admin.chapter.announcements';
        }
        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => $formChapter,
            'formSubChapter' => '',
            'formTitle' =>  $formTitle,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route( $sUrl ), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('chapters.add', array(
                'oData' => null,
                'sType' => $request->sType
            )),
            'formUrl' => URL::route('admin.chapter.store'),
        ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ChaptersRequest $request )
    {
        if ( $chapters = $this->chapters->store( $request->all() ) ) {
            if ( $request->hasFile('icon') ) {
                $TYPE_CHAPTER = Config::get('constants.RESOURCES.CHAPTER');
                // Delete related files
                if ( false === empty($chapters['icon']) ) {
                    Event::fire( new FileWasRemoved(array(
                        'path' => $chapters['icon'],
                        'content_id' => $chapters['id'],
                        'content_type' => $TYPE_CHAPTER,
                    )));
                }

                // Upload the photo
                $response = Event::fire( new FileWasLoaded(array(
                    'type' => $TYPE_CHAPTER,
                    'id' => $chapters['id'],
                    'file' => $request->file('icon'),
                    'prefix' => '%s',
                    'date' => Carbon::now()->toDateString()
                )));

                $response = $response ? current($response) : null;
                if ( $response && $response->code === Config::get('constants.DONE_STATUS.SUCCESS') ) {
                    $this->chapters->fixChanges( $chapters['id'], [
                        'icon' => $response->filepath
                    ]);
                }
            }
        }
        if ( $request->sType === Config::get('constants.CHAPTER.CHAPTER') ) {
            $sUrl = 'admin.chapter.index';
            $aMessage = Lang::get('chapters.message.store_chapter');
        } elseif ( $request->sType === Config::get('constants.CHAPTER.GALLERY') ) {
            $sUrl = 'admin.chapter.gallery';
            $aMessage = Lang::get('chapters.message.store_gallery');
        } else {
            $sUrl = 'admin.chapter.announcements';
            $aMessage = Lang::get('chapters.message.store_announce');

        }

        return Redirect::route( $sUrl )
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => $aMessage
                )
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $oData = $this->chapters->edit( $id );

        if ( $oData->type_chapter === Config::get('constants.CHAPTER.CHAPTER') ) {

            $aBreadcrumbs = array(
                array('url' => URL::route('admin.chapter.index'), 'icon' => '<i class="fa fa-object-group"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')),
                array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('chapters.lists.editing_chapter')));
            $sformChapter = Lang::get('chapters.lists.management_chapters');
            $sformTitle   = Lang::get('chapters.lists.editing_chapter');
            $sUrl         = 'admin.chapter.index';

        } elseif ( $oData->type_chapter === Config::get('constants.CHAPTER.GALLERY') ) {

            $aBreadcrumbs = array(
                array('url' => URL::route('admin.chapter.gallery'), 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_gallery')),
                array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('chapters.lists.editing_chapter_gallery')));
            $sformChapter = Lang::get('chapters.lists.management_chapters_gallery');
            $sformTitle   = Lang::get('chapters.lists.editing_chapter_gallery');
            $sUrl         = 'admin.chapter.gallery';

        } else {
            $aBreadcrumbs = array(
                array('url' => URL::route('admin.chapter.announcements'), 'icon' => '<i class="fa fa-th-list"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_announces')),
                array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('chapters.lists.editing_chapter_announce')));
            $sformChapter = Lang::get('chapters.lists.management_chapters_announces');
            $sformTitle   = Lang::get('chapters.lists.editing_chapter_announce');
            $sUrl         = 'admin.chapter.announcements';
        }

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => $sformChapter,
            'formSubChapter' => '',
            'formTitle' => $sformTitle,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route( $sUrl ), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('chapters.add', array(
                'oData' => $oData
            )),
            'formUrl' => URL::route('admin.chapter.store'),
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
