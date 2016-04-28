<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\CustomerReviews as CustomerReviewsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\CustomerReviews;
use League\Fractal\Manager;
use App\Repositories\CustomerReviewsRepository;

class CustomerReviewsController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\CustomerReviewsRepository}
     */
    protected $customerReviews = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, CustomerReviewsRepository $customerReviews)
    {
        // apply parent implementation
        parent::__construct($fractal);

        // page repository
        $this->customerReviews = $customerReviews;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        return Datatables::of(CustomerReviews::query())
            ->setTransformer( new CustomerReviewsTransformer() )
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = CustomerReviews::find($id);

        if ( ! $item)
        {
            return Response::json([
                'error' => [
                    'message' => 'Not Found',
                    'status_code' => 404
                ]
            ], 404);
        }

        return $this->fractal->item( $item, new CustomerReviewsTransformer() );
    }

    /**
     * Destroy the customer reviews item
     *
     * @param id {Integer} - customer reviews identifier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->customerReviews->destroy($id);
        }

        return $this->respond( $result );
    }
}
