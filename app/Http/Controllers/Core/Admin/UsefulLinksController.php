<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UsefulLinksRequest;
use App\Repositories\UsefulLinksRepository;
use App\Repositories\ChaptersRepository;
use App\Repositories\FileRepository;
use App\Events\Files\FileWasLoaded;
use App\Events\Files\FileWasRemoved;
use App\Events\Logs\LogsWasChanged;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, Event, cForms, URL, Config;

class UsefulLinksController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\UsefulLinksRepository
     */
    protected $usefulLinks;

    /**
     * File repository
     *
     * @var Object repository
     */
    protected $file = null;

    /**
     * Create a new UsefulLinksController instance
     *
     * @param App\Repositories\UsefulLinksRepository
     *
     * @return void
     */
    public function __construct( UsefulLinksRepository $usefulLinks, ChaptersRepository $chapters, FileRepository $file )
    {
        $this->usefulLinks = $usefulLinks;
        $this->chapters    = $chapters;

        // File repository
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-link"></i>', 'title' => Lang::get('useful_links.lists.lists_useful_links'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('useful_links.lists.useful_links_management'),
            'sSubTitle' => Lang::get('useful_links.lists.useful_links_management_online'),
            'sBoxTitle' => Lang::get('useful_links.lists.lists_useful_links'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('usefulLinks.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'sColumnsJson' => json_encode(array(
                    array( 'data'=> 'id' ),
                    array( 'data' => 'title' )
                )),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.usefulLinks.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add', 'class' => 'add-btn')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.usefulLinks.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true,'class' => 'delete-btn', 'data-url' => URL::route('admin.usefulLinks.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.usefulLinks.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn')
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
    public function create()
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.usefulLinks.index'), 'icon' => '<i class="fa fa-link"></i>', 'title' => Lang::get('useful_links.lists.lists_useful_links')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('useful_links.lists.create_useful_links'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('useful_links.lists.useful_links_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('useful_links.lists.create_new_useful_links'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.usefulLinks.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('useful_links.form.active'),
                    'name' => 'is_active',
                )
            ),
            'formContent' => $this->renderView('usefulLinks.add', array(
                'oData' => null,
                'aGroup' => $this->chapters->getComboList( Config::get('constants.CHAPTER.USEFUL_LINKS') )
            )),
            'formUrl' => URL::route('admin.usefulLinks.store'),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $validator = $this->validate( $request,
            array(
                'title' => 'required|min:3|max:255',
                'url' => 'required|url',
                'chapter_id' => 'required|not_in:0'
                ));

        if ( $usefulLinks = $this->usefulLinks->store( $request->all() ) ) {
            $TYPE = Config::get('constants.RESOURCES.USEFUL_LINK');

            if ( $request->hasFile('image') ) {
                // Delete related files
                if ( false === empty($usefulLinks['image']) ) {
                    Event::fire( new FileWasRemoved(array(
                        'path' => $usefulLinks['image'],
                        'content_id' => $usefulLinks['id'],
                        'content_type' => $TYPE,
                    )));
                }

                // Upload the the photo
                $response = Event::fire( new FileWasLoaded(array(
                    'type' => $TYPE,
                    'id' => $usefulLinks['id'],
                    'file' => $request->file('image'),
                    'prefix' => '%s',
                )));

                $response = $response ? current($response) : null;

                if ($response && $response->code === Config::get('constants.DONE_STATUS.SUCCESS') ) {
                    $this->usefulLinks->fixChanges( $usefulLinks['id'], [
                        'image' => $response->filepath
                    ]);
                }
            }

            Event::fire( new LogsWasChanged(array(
            'comment' => ( $request->id > 0 ? 'Редагував' : 'Створив' ),
            'title'   => $request->get('title'),
            'object_id'    => $usefulLinks['id'],
            'object_type'  => 'App\Models\UsefulLinks'
        )));

            // Check the files for current content
            $this->file->correct($request->get('_token'), $usefulLinks['id'], $TYPE);
        }

        return Redirect::route('admin.usefulLinks.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('useful_links.lists.useful_links_saved_successfully') ));
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
    public function edit($id)
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.usefulLinks.index'), 'icon' => '<i class="fa fa-link"></i>', 'title' => Lang::get('useful_links.lists.lists_useful_links')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('useful_links.lists.editing_useful_links'))
        );
        $oData = $this->usefulLinks->edit( $id );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('useful_links.lists.useful_links_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('useful_links.lists.editing_useful_links'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.usefulLinks.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('useful_links.form.active'),
                    'name' => 'is_active',
                    'value' => $oData->is_active
                )
            ),
            'formContent' => $this->renderView('usefulLinks.add', array(
                'oData' => $oData,
                'aGroup' => $this->chapters->getComboList( Config::get('constants.CHAPTER.USEFUL_LINKS') )
            )),
            'formUrl' => URL::route('admin.usefulLinks.store'),
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
