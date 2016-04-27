<?php namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Repositories\PagesRepository;
use App\Repositories\FileRepository;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Config;

class PagesController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\PagesRepository
     */
    protected $pages;

    /**
     * Chapter repository
     *
     * @var Object
     */
    protected $chapters;

    /**
     * File repository
     *
     * @var Object repository
     */
    protected $file = null;

    /**
     * Create a new PagesController instance
     *
     * @param App\Repositories\PagesRepository
     *
     * @return void
     */
    public function __construct( PagesRepository $pages, FileRepository $file )
    {
        $this->pages = $pages;

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
            array('url' => '#', 'icon' => '<i class="fa fa-sticky-note"></i>', 'title' => Lang::get('pages.lists.lists_pages'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('pages.lists.pages_management'),
            'sSubTitle' => Lang::get('pages.lists.pages_management_online'),
            'sBoxTitle' => Lang::get('pages.lists.page_static_website'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('pages.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.pages.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_page')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.pages.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.pages.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.pages.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.pages.index') )
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
            array('url' => URL::route('admin.pages.index'), 'icon' => '<i class="fa fa-sticky-note"></i>', 'title' => Lang::get('pages.lists.lists_pages')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('pages.lists.create_page'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('pages.lists.pages_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('pages.lists.create_new_pages'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.pages.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('table_field.lists.published'),
                    'name' => 'is_published'
                )
            ),
            'formContent' => $this->renderView('pages.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.pages.store'),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( PagesRequest $request )
    {
        if ($page = $this->pages->store( $request->only([
            'title',
            'url',
            'subtitle',
            'content',
            'is_published',
            'meta_keywords',
            'meta_descriptions',
            'id',
        ]))) {
            $TYPE_PAGE = Config::get('constants.RESOURCES.PAGE');

            // Check the files for current content
            $this->file->correct($request->get('_token'), $page['id'], $TYPE_PAGE);
        }

        return Redirect::route('admin.pages.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('pages.lists.pages_saved_successfully') ));
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
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.pages.index'), 'icon' => '<i class="fa fa-sticky-note"></i>', 'title' => Lang::get('pages.lists.lists_pages')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('pages.lists.editing_pages'))
        );
        $oData = $this->pages->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('pages.lists.pages_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('pages.lists.editing_page'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.pages.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('table_field.lists.published'),
                    'name' => 'is_published',
                    'value' => $oData->is_published
                )
            ),
            'formContent' => $this->renderView('pages.add', array(
                'oData' => $oData
            )),
            'formUrl' => URL::route('admin.pages.store'),
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
