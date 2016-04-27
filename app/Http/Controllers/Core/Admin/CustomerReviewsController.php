<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerReviewsRequest;
use App\Repositories\CustomerReviewsRepository;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL;

class CustomerReviewsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\CustomerReviewsRepository
     */
    protected $customerReviews;

    /**
     * Create a new CustomerReviewsController instance
     *
     * @param App\Repositories\CustomerReviewsRepository
     *
     * @return void
     */
    public function __construct( CustomerReviewsRepository $customerReviews )
    {
        $this->customerReviews = $customerReviews;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-comment"></i>', 'title' => Lang::get('customer_reviews.lists.lists_customer_reviews'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('customer_reviews.lists.customer_reviews_management'),
            'sSubTitle' => '',
            'sBoxTitle' => Lang::get('customer_reviews.lists.customer_reviews_website'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('customerReviews.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.customerReviews.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.customerReviews.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.customerReviews.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.customerReviews.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.customerReviews.index') )
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
            array('url' => URL::route('admin.customerReviews.index'), 'icon' => '<i class="fa fa-comment"></i>', 'title' => Lang::get('customer_reviews.lists.lists_customer_reviews')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('customer_reviews.lists.create_customer_reviews'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('customer_reviews.lists.customer_reviews_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('customer_reviews.lists.create_new_customer_reviews'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.customerReviews.index'), 'class'=>'btn-default')
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
            'formContent' => $this->renderView('customerReviews.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.customerReviews.store'),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerReviewsRequest $request)
    {
        $this->customerReviews->store( $request->all() );

        return Redirect::route('admin.customerReviews.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('customer_reviews.lists.customer_reviews_saved_successfully') ));
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
            array('url' => URL::route('admin.customerReviews.index'), 'icon' => '<i class="fa fa-comment"></i>', 'title' => Lang::get('customer_reviews.lists.lists_customer_reviews')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('customer_reviews.lists.edit'))
        );
        $oData = $this->customerReviews->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('customer_reviews.lists.customer_reviews_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('customer_reviews.lists.editing_customer_reviews'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.customerReviews.index'), 'class'=>'btn-default')
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
            'formContent' => $this->renderView('customerReviews.add', array(
                'oData' => $oData
            )),
            'formUrl' => URL::route('admin.customerReviews.store'),
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
