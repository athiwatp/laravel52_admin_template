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
    public function destroy($news)
    {
        $news->delete();
    }
}
