<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Repositories\GalleryRepository;
use App\Repositories\ChaptersRepository;

use App\Events\Files\FileWasLoaded;
use App\Events\Files\FileWasRemoved;
use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Carbon\Carbon, Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Config, Event;

class GalleryController extends AdminController
{
        /**
     * The MessageRepository instance
     *
     * @var App\Repositories\GalleryRepository
     */
    protected $chapters;

    /**
     * Create a new GalleryController instance
     *
     * @param App\Repositories\GalleryRepository
     *
     * @return void
     */
    public function __construct( GalleryRepository $gallery )
    {
        $this->gallery = $gallery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-camera"></i>', 'title' => Lang::get('gallery.lists.lists_gallery'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('gallery.lists.management_gallery'),
            'sSubTitle' => Lang::get('gallery.lists.gallery'),
            'sBoxTitle' => Lang::get('gallery.lists.lists_gallery'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('gallery.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'sColumnsJson' => json_encode(array(
                    array( 'data'=> 'id' ),
                    array( 'data' => 'title' ),
                    array( 'data' => 'filename' )
                )),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.gallery.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_gallery', 'class' => 'add-btn')
                    ),
                    'edit' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_gallery', 'class' => 'edit-btn', 'data-url' => URL::route('admin.gallery.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_gallery', 'class' => 'delete-btn', 'data-url' => URL::route('admin.gallery.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.gallery.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_gallery', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.gallery.index') )
                    )
                ),
                // 'aList' => $this->gallery->index()
            ))
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( ChaptersRepository $chapters, GalleryRepository $gallery )
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.gallery.index'), 'icon' => '<i class="fa fa-camera"></i>', 'title' => Lang::get('gallery.lists.lists_gallery')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('gallery.lists.create_gallery'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('gallery.lists.management_gallery'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('gallery.lists.create_new_gallery'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.gallery.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('gallery.add', array(
                'oData' => null,
                'aChapter' => $chapters->getComboList( 1 /*Chapters::TYPE_GALLERY*/ ),
            )),
            'formUrl' => URL::route('admin.gallery.store'),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( GalleryRequest $request )
    {
        // $this->gallery->store( $request->all() );
        if ( $gallery = $this->gallery->store( $request->all() ) ) {
            if ( $request->hasFile('filename') ) {
                $TYPE_GALLERY = Config::get('constants.RESOURCES.PHOTO_GALLERY');

                // Delete related files
                if ( false === empty($gallery['filename']) ) {
                    Event::fire( new FileWasRemoved(array(
                        'path' => $gallery['filename'],
                        'content_id' => $gallery['id'],
                        'content_type' => $TYPE_GALLERY,
                    )));
                }

                // Upload the the photo
                $response = Event::fire( new FileWasLoaded(array(
                    'type' => $TYPE_GALLERY,
                    'id' => $gallery['id'],
                    'file' => $request->file('filename'),
                    'prefix' => '%s',
                    'date' => Carbon::now()->toDateString()
                )));

                $response = $response ? current($response) : null;

                if ($response && $response->code === Config::get('constants.DONE_STATUS.SUCCESS') ) {
                    $this->gallery->fixChanges( $gallery['id'], [
                        'filename' => $response->filepath
                    ]);
                }
            }
        }

        return Redirect::route('admin.gallery.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('gallery.message.store_gallery')
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
    public function edit( $id, ChaptersRepository $chapters, GalleryRepository $gallery )
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.gallery.index'), 'icon' => '<i class="fa fa-camera"></i>', 'title' => Lang::get('gallery.lists.lists_gallery')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('gallery.lists.editing_gallery'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('gallery.lists.management_gallery'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('gallery.lists.editing_gallery'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.gallery.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('gallery.add', array(
                'oData' => $this->gallery->edit( $id ),
                'aChapter' => $chapters->getComboList( 1 /*Chapters::TYPE_GALLERY*/ ),
            )),
            'formUrl' => URL::route('admin.gallery.store'),
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
