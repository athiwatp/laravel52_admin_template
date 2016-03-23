<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ChaptersRequest;
use App\Repositories\ChaptersRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL;

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
    public function indexGallery( $sType = '1' )
    {
        return $this->index( $sType );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $sType = '0' )
    {
        $aBreadcrumbs = array( 
            $sType === '0' ? 
            array('url' => '#', 'icon' => '<i class="fa fa-object-group"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')) :
            array('url' => '#', 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters_gallery'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => ( $sType === '0' ? Lang::get('chapters.lists.management_chapters') : Lang::get('chapters.lists.management_chapters_gallery') ),
            'sSubTitle' => ( $sType === '0' ? Lang::get('chapters.lists.chapters') : Lang::get('chapters.lists.gallery') ),
            'sBoxTitle' => Lang::get('chapters.lists.lists_chapters'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('chapters.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'sColumnsJson' => json_encode(array(
                    array( 'data'=> 'id' ),
                    array( 'data' => 'title' )
                )),
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
                        'aParams' => array('id' => 'edit_chapter', 'class' => 'edit-btn', 'data-url' => URL::route('admin.chapter.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_chapter', 'class' => 'delete-btn', 'data-url' => URL::route('admin.chapter.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route( ($sType === '0' ? 'admin.chapter.index' : 'admin.chapter.gallery')),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_chapter', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.chapter.index') )
                    )
                ),
                // 'aList' => $this->chapters->index($sType),
                'sType' => $sType,
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
        $sType = $request['sType'];

        $aBreadcrumbs = $sType === '0' ? array(
            array('url' => URL::route('admin.chapter.index'), 'icon' => '<i class="fa fa-object-group"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('chapters.lists.create_chapter'))
        ) : array(
            array('url' => URL::route('admin.chapter.gallery'), 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('chapters.lists.create_chapter_gallery'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => ( $sType === '0' ? Lang::get('chapters.lists.management_chapters') : Lang::get('chapters.lists.management_chapters_gallery') ),
            'formSubChapter' => '',
            'formTitle' => ( $sType === '0' ? Lang::get('chapters.lists.create_new_chapter') : Lang::get('chapters.lists.create_new_chapter_gallery') ),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.chapter.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('chapters.add', array(
                'oData' => null,
                'sType' => $sType
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
        $sType = $request['sType'];
        $this->chapters->store( $request->all() );

        if ($sType === '0') {
            $sMessage = Lang::get('chapters.message.store_chapter');
        } else {
            $sMessage = Lang::get('chapters.message.store_gallery');
        }

        return Redirect::route( ( $sType === '0' ? 'admin.chapter.index' : 'admin.chapter.gallery' ) )
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get($sMessage)
            ));
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
        $sType = $oData->type_chapter;

        $aBreadcrumbs = $sType === '0' ? array(
            array('url' => URL::route('admin.chapter.index'), 'icon' => '<i class="fa fa-object-group"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('chapters.lists.editing_chapter'))
        ) : array(
            array('url' => URL::route('admin.chapter.gallery'), 'icon' => '<i class="fa fa-clone"></i>', 'title' => Lang::get('chapters.lists.lists_chapters')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('chapters.lists.editing_chapter_gallery'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => ( $sType === '0' ? Lang::get('chapters.lists.management_chapters') : Lang::get('chapters.lists.management_chapters_gallery') ),
            'formSubChapter' => '',
            'formTitle' => ( $sType === '0' ? Lang::get('chapters.lists.editing_chapter') : Lang::get('chapters.lists.editing_chapter_gallery') ),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route(( $sType === '0' ? 'admin.chapter.index' : 'admin.chapter.gallery' ) ), 'class'=>'btn-outline btn-default')
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
