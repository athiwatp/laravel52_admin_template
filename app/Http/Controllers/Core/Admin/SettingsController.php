<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Repositories\SettingsRepository;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
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
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formContent' => $this->renderView('settings.add', array(
                'oData' => $aData
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
        $settings = $this->settings->store( $request->all() );

        return Redirect::route('admin.settings.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('settings.lists.settings_saved_successfully') ));
    }

}