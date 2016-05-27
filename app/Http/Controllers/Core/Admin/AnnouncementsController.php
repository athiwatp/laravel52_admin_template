<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementsRequest;
use App\Repositories\AnnouncementsRepository;
use App\Repositories\ChaptersRepository;
use App\Repositories\FileRepository;

use App\Events\Files\FileWasLoaded;
use App\Events\Files\FileWasRemoved;
use App\Events\Logs\LogsWasChanged;
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
     * @param App\Repositories\AnnouncementsRepository
     *
     * @return void
     */
    public function __construct( AnnouncementsRepository $announce, ChaptersRepository $chapters, FileRepository $file )
    {
        $this->announce = $announce;

        $this->chapters = $chapters;

        // File repository
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( AnnouncementsRequest $input )
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
                        'aParams' => array('id' => 'add')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.announcements.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.announcements.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.announcements.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.announcements.index') )
                    ),
                    // 'sync' => array(
                    //     'url' => URL::route( 'admin.announcements.sync', array( 'start' => $input->get('start', 0) ) ),
                    //     'title' => Lang::get('table_field.toolbar.sync'),
                    //     'icon' => '<i class="fa fa-arrow-circle-down"></i>',
                    //     'aParams' => array('id' => 'sync')
                    // )
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
            'thisDay' => Carbon::now()->format( $this->announce->getDateFormat() ), 'thisDayPlusMonth' => Carbon::now()->addMonth()->format( $this->announce->getDateFormat() )
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('announce.lists.announce_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('announce.lists.create_announce'),
            'formJsHandler' => 'announcements/form',
            'formFormId' => 'admin_announce_form',
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.announcements.index'), 'class'=>'btn-default')
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
        $validator = $this->validate( $request,
            array(
                'title' => 'required|min:3|max:255',
                'top_date_end' => 'required_with:is_topical',
                'date_start' => 'required',
                'date_end' => 'required',
                'chapter_id' => 'required|not_in:0'
                ));

        if ( $request->get('id') > 0 ) {
            $image = $this->announce->edit($request->get('id'))['image'];
            if ( $image == false ) {
                $image = $request->hasFile('image');
            }
        } else {
            $image = $request->hasFile('image');
        }

        if ( $request->get('important') === '1' && $image == false ) {
            return Redirect::route( ($request->get('id') > 0 ? 'admin.announcements.edit' : 'admin.announcements.create'), array('id' => $request->get('id')) )
                ->with('message', array(
                    'code'      => self::$statusError,
                    'message'   => Lang::get('announce.lists.important_announce_need_photo')
                    ))
                ->withInput();
        }

        $date_start = test_for_materiality_date( Carbon::createFromFormat( $this->announce->getDateFormat(), $request->get('date_start') ), Carbon::now()->subYear() );
        $date_end   = test_for_materiality_date( Carbon::createFromFormat( $this->announce->getDateFormat(), $request->get('date_end') ), Carbon::now()->subYear() );

        if( ($date_start !== true ) || ($date_end !== true ) ) {
            $date = $date_start !== true ? Lang::get('announce.form.date_start') . ' ' . $request->get('date_start') : Lang::get('announce.form.date_end') . ' ' . $request->get('date_end');

            return Redirect::route( ($request->get('id') > 0 ? 'admin.announcements.edit' : 'admin.announcements.create'), array('id' => $request->get('id')) )
                ->with('message', array(
                    'code'      => self::$statusError,
                    'message'   => Lang::get('table_field.incorrectly_specified_date', array('date' => $date))
                    ))
                ->withInput();
        }

        if ( $announce = $this->announce->store( $request->except(['_token']) ) ) {
            $TYPE_ANNOUNCE = Config::get('constants.RESOURCES.ANNOUNCE');

            if ( $request->hasFile('image') ) {
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

            Event::fire( new LogsWasChanged(array(
                'comment' => ( $request['id'] > 0 ? 'Редагував' : 'Створив' ),
                'title' => $request->get('title'),
                'object_id'    => $announce['id'],
                'object_type'  => 'App\Models\Announcements'
            )));

            // Check the files for current content
            $this->file->correct($request->get('_token'), $announce['id'], $TYPE_ANNOUNCE);
        }

        return Redirect::route('admin.announcements.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('announce.lists.announce_saved_successfully') ) );
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
            array('url' => URL::route('admin.announcements.index'), 'icon' => '<i class="fa fa-bullhorn"></i>', 'title' => Lang::get('announce.lists.lists_announce')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('announce.lists.editing_announce'))
        );

        $oData = $this->announce->edit($id);

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
                    'params' => array('url' => URL::route('admin.announcements.index'), 'class'=>'btn-default')
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
                    'value' => $oData['is_published']
                )
            ),
            'formContent' => $this->renderView('announcements.add', array(
                'oData' => $oData,
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

    // //// TEMP
    // public function sync($start)
    // {
    //     $sync = $this->announce->sync( $start );

    //     return Redirect::route('admin.announcements.index', array('start' => $sync['start']))
    //         ->with('message', array(
    //             'code' => self::$statusOk,
    //             'message' => Lang::get('table_field.sync.message') . $sync['index']
    //         ));
    // }
    ///

}
