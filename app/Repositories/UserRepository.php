<?php namespace App\Repositories;

use App\Models\User as User;
use Carbon\Carbon, Hash;

class UserRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\User $user
     *
     * @return void
    */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\User $user
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
     * @param App\Models\User $user
     *
     * @return
    */
    public function saveUser( $user, $inputs )
    {
        $user->name         = $inputs['name'];
        $user->email        = $inputs['email'];
        $user->is_admin     = ( isset($inputs['is_admin']) ? $inputs['is_admin'] : 0 );
        $user->is_verified  = ( isset($inputs['is_verified']) ? $inputs['is_verified'] : 0 );
        $user->phone        = ( isset($inputs['phone']) ? $inputs['phone'] : null );

        $user->save();

        return true;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\User $user
     *
     * @return
    */
    public function registerUser( $user, $inputs )
    {
        $user->name         = $inputs['name'];
        $user->email        = $inputs['email'];
        $user->password     = Hash::make($inputs['password']);
        $user->api_token    = str_random(60);

        $user->save();

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
            $news = $this->saveUser( $this->model->find( $id ), $inputs );
        } else {
            $news = $this->registerUser( new $this->model, $inputs );
        }
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\User $user
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
     * @param App\Models\User
     *
     * @return void
    */
    public function destroy($user)
    {
        $user->delete();
    }
}
