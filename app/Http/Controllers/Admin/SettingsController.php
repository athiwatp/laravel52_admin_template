<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Repositories\SettingsRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cBreadcrumbs, cForms, URL;

class SettingsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\SettingsRepository
     */
    protected $settings;

    /**
     * Create a new SettingsController instance
     *
     * @param App\Repositories\SettingsRepository
     *
     * @return void
     */
    public function __construct( SettingsRepository $settings )
    {
        $this->settings = $settings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-cog"></i>', 'title' => Lang::get('settings.form.settings'))
        );

        $aData = array();

        foreach($this->settings->index() as $item) {
            $aData[$item->key_name] = $item->value;
        }

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('settings.lists.system_settings'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('settings.lists.manage_system_settings'),
            'formButtons' => array(
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('settings.add', array(
                'oData' => $aData,
            )),
            'formUrl' => URL::route('admin.settings.store'),
        ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( SettingsRequest $request )
    {
        $this->settings->store( $request->all() );

        return Redirect::route('admin.settings.index')
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
        //
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