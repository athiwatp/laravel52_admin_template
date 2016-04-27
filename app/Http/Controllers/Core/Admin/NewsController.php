<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Repositories\NewsRepository;
use App\Repositories\ChaptersRepository;
use App\Repositories\FileRepository;

use App\Events\Files\FileWasLoaded;
use App\Events\Files\FileWasRemoved;
use App\Http\Requests;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Event, Config;

class NewsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\NewsRepository
     */
    protected $news;

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
     * Create a new NewsController instance
     *
     * @param App\Repositories\NewsRepository
     *
     * @return void
     */
    public function __construct( NewsRepository $news, ChaptersRepository $chapters, FileRepository $file )
    {
        // injected repository instance
        $this->news = $news;

        // injacted chapter instance
        $this->chapters = $chapters;

        // injacted file repository
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
            array('url' => '#', 'icon' => '<i class="fa fa-list-alt"></i>', 'title' => Lang::get('news.lists.lists_news'))
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
                        'aParams' => array('id' => 'add')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.news.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.news.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.news.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.news.index') )
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
            array('url' => URL::route('admin.news.index'), 'icon' => '<i class="fa fa-list-alt"></i>', 'title' => Lang::get('news.lists.lists_news')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('news.lists.create_news'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('news.lists.news_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('news.lists.create_new_news'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.news.index'), 'class'=>'btn-default')
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
                ),
                array(
                    'title' => Lang::get('news.form.main'),
                    'name' => 'is_main',
                    'value' => '0'
                ),
                array(
                    'title' => Lang::get('news.form.important'),
                    'name' => 'is_important',
                    'value' => '0'
                )
            ),
            'formContent' => $this->renderView('news.add', array(
                'oData' => null,
                'aChapters' => $this->chapters->getComboList( Config::get('constants.CHAPTER.CHAPTER') )
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
        if ( $news = $this->news->store( $request->all() ) ) {
            $TYPE_NEWS = Config::get('constants.RESOURCES.NEWS');

            if ( $request->hasFile('image') ) {
                // Delete related files
                if ( false === empty($news['photo']) ) {
                    Event::fire( new FileWasRemoved(array(
                        'path' => $news['photo'],
                        'content_id' => $news['id'],
                        'content_type' => $TYPE_NEWS,
                    )));
                }

                // Upload the the photo
                $response = Event::fire( new FileWasLoaded(array(
                    'type' => $TYPE_NEWS,
                    'id' => $news['id'],
                    'file' => $request->file('image'),
                    'prefix' => '%s',
                    'date' => $news['date']
                )));

                $response = $response ? current($response) : null;

                if ($response && $response->code === Config::get('constants.DONE_STATUS.SUCCESS') ) {
                    $this->news->fixChanges( $news['id'], [
                        'photo' => $response->filepath
                    ]);
                }
            }

            // Check the files for current content
            $this->file->correct($request->get('_token'), $news['id'], $TYPE_NEWS);
        }

        return Redirect::route('admin.news.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('news.lists.news_saved_successfully') ));
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
            array('url' => URL::route('admin.news.index'), 'icon' => '<i class="fa fa-list-alt"></i>', 'title' => Lang::get('news.lists.lists_news')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('news.lists.editing_news'))
        );
        $oData = $this->news->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('news.lists.news_management'),
            'formSubChapter' => '',
            'useCKEditor' => true,
            'formTitle' => Lang::get('news.lists.editing_news'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.news.index'), 'class'=>'btn-default')
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
                ),
                array(
                    'title' => Lang::get('news.form.main'),
                    'name' => 'is_main',
                    'value' => $oData->is_main
                ),
                array(
                    'title' => Lang::get('news.form.important'),
                    'name' => 'is_important',
                    'value' => $oData->is_important
                )
            ),
            'formContent' => $this->renderView('news.add', array(
                'oData' => $oData,
                'aChapters' => $this->chapters->getComboList( Config::get('constants.CHAPTER.CHAPTER') )
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
