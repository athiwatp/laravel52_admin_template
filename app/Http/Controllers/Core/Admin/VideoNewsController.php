<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\VideoNewsRequest;
use App\Repositories\VideoNewsRepository;
use App\Events\Logs\LogsWasChanged;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Carbon\Carbon, Lang, Redirect, cTemplate, cBreadcrumbs, Event, cForms, URL;

class VideoNewsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\VideoNewsRepository
     */
    protected $videoNews;

    /**
     * Create a new VideoNewsController instance
     *
     * @param App\Repositories\VideoNewsRepository
     *
     * @return void
     */
    public function __construct( VideoNewsRepository $videoNews )
    {
        $this->videoNews = $videoNews;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-video-camera"></i>', 'title' => Lang::get('videoNews.lists.lists_video_news'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('videoNews.lists.video_news_management'),
            'sSubTitle' => Lang::get('videoNews.lists.video_news_management_online'),
            'sBoxTitle' => Lang::get('videoNews.lists.lists_video_news'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('videoNews.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.videoNews.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_videoNews')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.videoNews.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.videoNews.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.videoNews.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh')
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
            array(
                'url' => URL::route('admin.videoNews.index'),
                'icon' => '<i class="fa fa-video-camera"></i>',
                'title' => Lang::get('videoNews.lists.lists_video_news')
            ),

            array(
                'url' => '#',
                'icon' => '<i class="fa fa-plus"></i>',
                'title' => Lang::get('videoNews.lists.create_video_news')
            )
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('videoNews.lists.video_news_management'),
            'formSubChapter' => '',
            'useCKEditor' => true,
            'formTitle' => Lang::get('videoNews.lists.create_video_news'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.videoNews.index'), 'class'=>'btn-default')
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
            'formContent' => $this->renderView('videoNews.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.videoNews.store'),
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
                'url' => 'required_with:title',
                'youtube_url' => 'required|url|max:500',
                'date' => 'required'
                ));

        $date = test_for_materiality_date( Carbon::createFromFormat( $this->videoNews->getDateFormat(), $request->get('date') ), Carbon::now()->subYear() );

        if ( $date !== true ) {
            return Redirect::route( ($request->get('id') > 0 ? 'admin.videoNews.edit' : 'admin.videoNews.create'), array('id' => $request->get('id')) )
                ->with('message', array(
                    'code'      => self::$statusError,
                    'message'   => Lang::get('table_field.incorrectly_specified_date', array('date' => Lang::get('table_field.lists.date') . ' ' . $request->get('date')))
                    ))
                ->withInput();
        }

        $videoNews = $this->videoNews->store( $request->all() );

        Event::fire( new LogsWasChanged(array(
            'comment' => ( $request->id > 0 ? 'Редагував' : 'Створив' ),
            'object_id'    => $videoNews['id'],
            'object_type'  => 'App\Models\VideoNews'
        )));

        return Redirect::route('admin.videoNews.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('videoNews.lists.video_news_saved_successfully')
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
    public function edit($id)
    {
        $aBreadcrumbs = array(
            array(
                'url' => URL::route('admin.videoNews.index'),
                'icon' => '<i class="fa fa-video-camera"></i>',
                'title' => Lang::get('videoNews.lists.lists_video_news')
            ),
            array(
                'url' => '#',
                'icon' => '<i class="fa fa-pencil"></i>',
                'title' => Lang::get('videoNews.lists.editing_video_news')
            )
        );
        $oData = $this->videoNews->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('videoNews.lists.video_news_management'),
            'formSubChapter' => '',
            'useCKEditor' => true,
            'formTitle' => Lang::get('videoNews.lists.editing_video_news'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.videoNews.index'), 'class'=>'btn-default')
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
            'formContent' => $this->renderView('videoNews.add', array(
                'oData' => $oData
            )),
            'formUrl' => URL::route('admin.videoNews.store'),
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
