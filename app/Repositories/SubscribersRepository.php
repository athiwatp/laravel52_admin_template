<?php namespace App\Repositories;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use Config;

class SubscribersRepository extends BaseRepository {

    /**
     * Create a new Message instance
     *
     * @param App\Models\News $news
     *
     * @return void
     */
    public function __construct( Subscribers $subscribers )
    {
        // News Model
        $this->model = $subscribers;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\News $news
     *
     * @return Collection of Object
     */
    public function index()
    {
        return $this->model->all();
    }


    /**
     * Create or update Message
     *
     * @param App\Models\News $news
     *
     * @return
     */
    public function save( $subscriber, $inputs )
    {
        foreach($inputs as $field => $value) {
            $subscriber->$field = $value;
        }

        if ($inputs) {
            return $subscriber->save();
        }

        return false;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Subscribers $subscribers
     *
     * @return
    */
    public function saveSubscribers( $subscribers, $inputs )
    {
        if ( empty($inputs['id']) ) {
            $subscribers->email    = $inputs['email'];
        }
        $subscribers->is_active    = $inputs['is_active'];

        $subscribers->save();

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

        $subscribers = $this->saveSubscribers( $model, $inputs );

        if ( $this->saveSubscribers( $model, $inputs ) ) {
            return $model->toArray();
        } else {
            return false;
        }
    }

    /**
     * Create a news
     *
     * @param array $inputs
     *
     * @return mixed ( App\Models\News | false )
     */
    public function add( $inputs )
    {
        return $this->save(new $this->model, $inputs);
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\News $news
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
     * @param App\Models\News
     *
     * @return void
     */
    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
