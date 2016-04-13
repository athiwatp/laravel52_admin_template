<?php namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementsRequest;
use App\Repositories\AnnouncementsRepository;
use App\Repositories\ChaptersRepository;

use App\Events\Files\FileWasLoaded;
use App\Events\Files\FileWasRemoved;
use App\Http\Requests;
use Carbon\Carbon, Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Event, Config;

class AnnouncementsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\AnnouncementsRepository
     */
    protected $announce;

    /**
     * Create a new NewsController instance
     *
     * @param App\Repositories\AnnouncementsRepository
     *
     * @return void
     */
    public function __construct( AnnouncementsRepository $announce, ChaptersRepository $chapters )
    {
        $this->announce = $announce;
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
            array('url' => '#', 'icon' => '<i class="fa fa-bullhorn"></i>', 'title' => Lang::get('announce.lists.lists_announce'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('announce.lists.announce_management'),
            'sSubTitle' => Lang::get('announce.lists.announce_management_online'),
            'sBoxTitle' => Lang::get('announce.lists.lists_announce'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('announcements.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.announcements.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_announcements')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_announcements', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.announcements.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_announcements', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.announcements.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.announcements.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_announcements', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.announcements.index') )
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
            array('url' => URL::route('admin.announcements.index'), 'icon' => '<i class="fa fa-bullhorn"></i>', 'title' => Lang::get('announce.lists.lists_announce')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('announce.lists.create_announce'))
        );

        $aDate = array(
            'thisDay' => Carbon::now()->toDateString(), 'thisDayPlusMonth' => Carbon::now()->addMonth()->toDateString()
            );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('announce.lists.announce_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('announce.lists.create_new_announce'),
            'formJsHandler' => 'announcements/form',
            'formFormId' => 'admin_announce_form',
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.announcements.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('announcements.add', array(
                'oData' => null,
                'date' => $aDate,
                'aChapters' => $this->chapters->getComboList( Config::get('constants.CHAPTER.ANNOUNCE') )
            )),
            'formUrl' => URL::route('admin.announcements.store'),
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

        if ( $announce = $this->announce->store( $request->except(['_token']) ) ) {
            if ( $request->hasFile('image') ) {
                $TYPE_ANNOUNCE = Config::get('constants.RESOURCES.ANNOUNCE');

                // Delete related files
                if ( false === empty($announce['image']) ) {
                    Event::fire( new FileWasRemoved(array(
                        'path' => $announce['image'],
                        'content_id' => $announce['id'],
                        'content_type' => $TYPE_ANNOUNCE,
                    )));
                }

                // Upload the the photo
                $response = Event::fire( new FileWasLoaded(array(
                    'type' => $TYPE_ANNOUNCE,
                    'id' => $announce['id'],
                    'file' => $request->file('image'),
                    'prefix' => '%s',
                    'date' => $announce['date_start']
                )));

                $response = $response ? current($response) : null;

                if ($response && $response->code === Config::get('constants.DONE_STATUS.SUCCESS') ) {
                    $this->announce->fixChanges( $announce['id'], [
                        'image' => $response->filepath
                    ]);
                }
            }
        }

        return Redirect::route('admin.announcements.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('announce.lists.announce_saved_successfully') ));
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
            array('url' => URL::route('admin.announcements.index'), 'icon' => '<i class="fa fa-list-alt"></i>', 'title' => Lang::get('announce.lists.lists_announce')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('announce.lists.editing_announce'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('announce.lists.announce_management'),
            'formSubChapter' => '',
            'formJsHandler' => 'announcements/form',
            'formFormId' => 'admin_announce_form',
            'useCKEditor' => true,
            'formTitle' => Lang::get('announce.lists.editing_announce'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.announcements.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('announcements.add', array(
                'oData' => $this->announce->edit( $id ),
                'aChapters' => $this->chapters->getComboList( Config::get('constants.CHAPTER.ANNOUNCE') )
            )),
            'formUrl' => URL::route('admin.announcements.store'),
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
