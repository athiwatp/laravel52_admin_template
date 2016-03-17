<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ChaptersRequest;
use App\Repositories\ChaptersRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Toolbar;

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
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('table_field.chapters.chapters'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('table_field.chapters.chapters'),
            'sSubTitle' => Lang::get('table_field.chapters.lists_chapters'),
            'sBoxTitle' => Lang::get('admin_page.menu.list_title'),
            'sContent' => $this->renderView('chapters.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.chapter.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'class' => 'btn btn-outline btn-success',
                        'aParams' => array('id' => 'add_menu')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'class' => 'btn btn-outline btn-warning',
                        'aParams' => array('id' => 'edit_menu', 'class' => 'edit-btn', 'data-url' => URL::route('admin.chapter.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'class' => 'btn btn-outline btn-danger',
                        'aParams' => array('id' => 'delete_menu', 'class' => 'delete-btn', 'data-url' => URL::route('admin.chapter.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.chapter.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'class' => 'btn btn-outline btn-info',
                        'aParams' => array('id' => 'refresh_menu', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.chapter.destroy', array('id' => '%id%')) )
                    )
                ),
                'aList' => $this->chapters->index()
            ))
        ));


        // return $this->renderView('chapters.index', array(
        //     'aList' => $this->chapters->index()
        //     )
        // );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.chapter.index'), 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('table_field.chapters.chapters')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('table_field.chapters.add'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('admin_menu.nav.menu_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('admin_page.menu.new_sub_title'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('admin_page.form.to_the_list'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.chapter.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('admin_page.form.save'), 
                    'type' => 'submit',
                    'params' => array('class'=>'btn-primary')
                )
            ),
            'formContent' => $this->renderView('chapters.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.chapter.store'),
        )); 


        // return $this->renderView('chapters.add', array(
        //     'oData' => null
        //     )
        // );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ChaptersRequest $request )
    {
        $this->chapters->store( $request->all() );

        return Redirect::route('admin.chapter.index')
            ->with('message', Lang::get('$sMessage') );
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
        return $this->renderView('chapters.add', array(
            'oData' => $this->chapters->edit( $id )
            )
        );
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
