<?php namespace App\Repositories;

use App\Models\CustomerReviews as CustomerReviews;
use Carbon\Carbon, Lang, Auth, Config;

class CustomerReviewsRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\CustomerReviews $customerReviews
     *
     * @return void
    */
    public function __construct(CustomerReviews $customerReviews)
    {
        $this->model = $customerReviews;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\CustomerReviews $customerReviews
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\CustomerReviews $customerReviews
     *
     * @return
    */
    public function saveCustomerReviews( $reviews, $inputs )
    {
        $reviews->title        = $inputs['title'];
        $reviews->comment      = $inputs['comment'];
        $reviews->date         = ( isset($inputs['date']) ? $inputs['date'] : Carbon::now()->toDateString() );
        $reviews->is_published = $inputs['is_published'];
        $reviews->user_id      = Auth::id();

        $reviews->save();

        return true;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $customerReviews = $this->saveCustomerReviews( $model, $inputs );
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\CustomerReviews $customerReviews
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Destroy a message
     *
     * @param App\Models\CustomerReviews
     *
     * @return void
    */
    public function destroy($customerReviews)
    {
        $customerReviews->delete();
    }

}
