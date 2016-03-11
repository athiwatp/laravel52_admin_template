<?php namespace App\Repositories;

use App\Models\User as User;
use Carbon\Carbon;

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
    public function saveUser( $user, $inputs/*, $user_id*/)
    {

        /**
         * NEED TO IMPLEMENT USER SAVING PROCESS
        */
        //$user->save();

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
    public function store( $user, $inputs/*, $user_id*/)
    {
        $user = $this->saveUser(new $this->model, $inputs/*, $user_id*/);

        // some post creation actions will be required
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
