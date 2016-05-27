<?php namespace App\Repositories;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use Config;

class SubscribersRepository extends BaseRepository {

    /**
     * Create a new Message instance
     *
     * @param App\Models\Subscribers $subscribers
     *
     * @return void
     */
    public function __construct( Subscribers $subscribers )
    {
        if ( $subscribers === null ) {
            $subscribers = new Subscribers();
        }

        // Subscribers Model
        $this->model = $subscribers;

        // Retrieve the config settings
        $this->PUBLISHED = Config::get('constants.DONE_STATUS.SUCCESS');
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Subscribers $subscribers
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
     * @param App\Models\Subscribers $subscribers
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
        $subscribers->activation_code = $this->_generateActivationCode();
        $subscribers->is_active    = $inputs['is_active'];

        if ( $subscribers->save() ) {
            return $subscribers;
        }
        return false;
    }

    /**
     * Generate code
    */
    private function _generateActivationCode()
    {
        return md5( 'subscription-code-' . time() );
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

        if ( $subscribers ) {
            return $subscribers;
        } else {
            return false;
        }
    }

    /**
     * Create a subscribers
     *
     * @param array $inputs
     *
     * @return mixed ( App\Models\Subscribers | false )
     */
    public function add( $inputs )
    {
        $inputs['activation_code'] = $this->_generateActivationCode();

        $model = new $this->model;

        if ($this->save($model, $inputs)) {
            return $model;
        }  else {
            return false;
        }
    }

    /**
     * Returns a list of subscribers
     *
     * @return Colelction
    */
    public function getActiveSubscribers()
    {
        return $this->model->where('is_active', $this->PUBLISHED)
            ->take(1000)
            ->get();
    }

    /**
     * Check if email exists (in case when User deactivated his account and then just decided to subscribe againe)
     *
    */
    public function checkIfEmailExists( $email )
    {
        return $this->model->whereEmail( $email )
            ->first();
    }

    /**
     * Get subscriber data by the code
     *
    */
    public function getByActivationCode( $code, $active = '1' )
    {
        return $this->model->where('activation_code', $code)
            ->where('is_active', '!=', $active)
            ->first();
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Subscribers $subscribers
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
     * @param App\Models\Subscribers
     *
     * @return void
     */
    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
