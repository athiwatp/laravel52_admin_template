<?php namespace App\Http\Controllers\Core\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\SubscribersRepository;
use League\Fractal\Manager;
use App\Http\Transformers\Subscribers as SubscribersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Subscribers;
use App\Events\Mail\SendMail;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Config, Event;

class SubscriberController extends ApiController
{

    /**
     * Subscriber repository
     *
     * @var Object
    */
    protected $subscriber = null;
    protected $user = null;

    /**
     * Constructor
     *
     */
    public function __construct( Manager $fractal, SubscribersRepository $subscriber, UserRepository $user )
    {
        parent::__construct($fractal);

        // Subscribers repository
        $this->subscriber = $subscriber;

        // User repository
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Subscribers::query())
            ->setTransformer( new SubscribersTransformer() )
            ->make(true);
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
            'email' => 'required|email|max:255'
        ]);

        if ( $validator && $validator->fails() ) {
            $errors = $validator->errors()->all();
        } else {

            $email = $request->only(['email']);

            if ( $result = $this->subscriber->checkIfEmailExists($email) ) {
                $message = 'Вказана адреса вже знаходилася в Базі Данних підписчиків, отож ми відправили повторно код активації. Будь-ласка перевірте вашу поштову скриньку та виконайте інструкції по активації.';
            } else
            if ( $result = $this->subscriber->add( $email ) ) {
                $message = 'Email був успішно добавлений в Базу Даних підписчиків. Для підтвердження підписки - на вказанний Email була відправленна інструкція по активації.';
            }

            if ( $result ) {
                Event::fire( new SendMail([
                    'theme' => 'Themes.' . Config::get('theme.Themes.name'),
                    'template' => SendMail::SUBSCRIBER_ACTIVATION,
                    'to' => $result->email,
                    'code' => $result->activation_code
                ]));
            }
        }

        return response()->json([
            'success' => $result ? true : false,
            'message' => $message,
            'errors' => $errors
        ]);
    }

    /**
     * Destroy the subscribers item
     *
     * @param id {Integer} - subscribers identifier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $subscriber = $this->subscriber->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $subscriber['email'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\Subscribers',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->subscriber->destroy($id);
        }

        return $this->respond( $result );
    }
}
