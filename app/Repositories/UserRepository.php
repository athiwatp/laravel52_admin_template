<?php namespace App\Repositories;

use App\Models\User as User;
use Carbon\Carbon, Hash, Lang, Config;

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
        $user->is_verified  = ( isset($inputs['is_verified']) ? $inputs['is_verified'] : $user->is_verified );
        $user->phone        = ( isset($inputs['phone']) ? $inputs['phone'] : null );
        $user->group        = $inputs['group'];

        if ( $user->save() ) {
            return $user;
        }
        return false;
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
        $user->group        = $inputs['group'];

        if ( $user->save() ) {
            return $user;
        }
        return false;
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
            $user = $this->saveUser( $this->model->find( $id ), $inputs );
        } else {
            $user = $this->registerUser( new $this->model, $inputs );
        }

        if ( $user ) {
            return $user;
        }
        return false;
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
     * Find or update Message
     *
     * @param App\Models\User $user
     *
     * @return
    */
    public function findUserByToken( $api_token )
    {
        return $this->model
            ->where('api_token', '=', $api_token)
            ->first();
    }

    /**
     * Destroy a user
     *
     * @param {int} $id
     *
     * @return {Boolean}
    */
    public function destroy($id)
    {
        return parent::destroy($id);
    }

    /**
    * Prepare a list of chapters for the combox
    */
    public static function getCheckGroup()
    {
        $aItems = array(
            -1 => ' --- ' . Lang::get('users.check.select_group') . ' --- ',
            Config::get('constants.USERS.USER') => Lang::get('users.check.user'),
            Config::get('constants.USERS.ADMIN') => Lang::get('users.check.administrator'),
            Config::get('constants.USERS.EDITOR') => Lang::get('users.check.editor'),
        );


        return $aItems;
    }
}
