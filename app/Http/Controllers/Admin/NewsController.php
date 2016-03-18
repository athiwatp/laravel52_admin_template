<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Repositories\NewsRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL;

class NewsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\NewsRepository
     */
    protected $news;

    /**
     * Create a new NewsController instance
     *
     * @param App\Repositories\NewsRepository
     *
     * @return void
     */
    public function __construct( NewsRepository $news )
    {
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('news.lists.lists_news'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('news.lists.news_management'),
            'sSubTitle' => Lang::get('news.lists.news_management_online'),
            'sBoxTitle' => Lang::get('news.lists.lists_news'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('news.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.news.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_news')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_news', 'class' => 'edit-btn', 'data-url' => URL::route('admin.news.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_news', 'class' => 'delete-btn', 'data-url' => URL::route('admin.news.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.news.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_news', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.news.index') )
                    )
                ),
                'aList' => $this->news->index()
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
            array('url' => URL::route('admin.news.index'), 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('news.lists.lists_news')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('news.lists.create_news'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('news.lists.news_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('news.lists.create_new_news'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.news.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('news.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.news.store'),
        ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( NewsRequest $request )
    {
        $this->news->store( $request->all() );

        return Redirect::route('admin.news.index')
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
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.news.index'), 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('news.lists.lists_news')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('news.lists.editing_news'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('news.lists.news_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('news.lists.editing_news'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.news.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('news.add', array(
                'oData' => $this->news->edit( $id )
            )),
            'formUrl' => URL::route('admin.news.store'),
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
