<?php namespace App\Http\Controllers\Core\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\SubscribersRepository;
use League\Fractal\Manager;

class SubscriberController extends ApiController
{

    /**
     * Subscriber repository
     *
     * @var Object
    */
    protected $subscriber = null;

    /**
     * Constructor
     *
     */
    public function __construct(Manager $fractal, SubscribersRepository $subscriber)
    {
        parent::__construct($fractal);

        $this->subscriber = $subscriber;
    }

    /**
     * Save the new position to subscription table
    */
    public function store(Request $request)
    {
        $result     = false;
        $message    = '';
        $errors     = [];

        $validator = Validator::make($request->only(['email']), [
            'email' => 'required|email|unique:subscribers|max:255'
        ]);

        if ( $validator && $validator->fails() ) {
            $errors = $validator->errors()->all();
        } else {
            if ( $result = $this->subscriber->add($request->only(['email'])) ) {
                $message = 'Email был успешно добавлен в базу данных. Для подтверждения - на указанный Email была выслана инструкция.';
            }
        }

        return response()->json([
            'success' => $result,
            'message' => $message,
            'errors' => $errors
        ]);
    }
}
