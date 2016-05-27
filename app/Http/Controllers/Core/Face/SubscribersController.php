<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\SubscribersRepository;
use App\Events\Mail\SendMail;
use Redirect, Lang, Config, Event;

class SubscribersController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $subscribers = null;

    /**
     * Statuses
     *
    */
    protected $statuses = [];

    /**
     *
     */
    public function __construct(SubscribersRepository $subscribers)
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->subscribers = $subscribers;

        $this->statuses = Config::get('constants.DONE_STATUS');
    }

    /**
     * Retrive the news page
     */
    public function thanks( Request $request, $id )
    {
        if ( $id ) {
            $subcriber = $this->subscribers->getById($id);

            if (  $subcriber ) {
                return $this->renderView('subscribers.thanks', [
                    'subscriber' => $subcriber,
                    'unsubscribe' => $request->get('unsubscribe'),
                    'aTitle' => $request->get('unsubscribe') == null ? Lang::get('subscribers.layouts.thank_you_for_subscribing_to_our_newsletter') : Lang::get('subscribers.layouts.unsubscription_was_successful')
                ]);
            }
        }

        return Redirect::route( 'home' );
    }

    /**
     * Retrive the news page
     */
    public function error(Request $request)
    {
        return $this->renderView('subscribers.errors', [
            'unsubscribe' => $request->get('unsubscribe'),
            'aTitle' => Lang::get('subscribers.layouts.error_at_activate')
            ]);
    }

    /**
     * Output the list of news
     *
     */
    public function activate(Request $request, $code)
    {
        if ( $code ) {
            $subcriber = $this->subscribers->getByActivationCode($code);

            if ( $subcriber ) {

                $subcriber->is_active = $this->statuses['SUCCESS'];
                $subcriber->save();

                Event::fire( new SendMail([
                    'template' => SendMail::SUBSCRIBER_ACTIVATION_SUCCESS,
                    'to' => $subcriber->email,
                    'code' => $subcriber->activation_code
                ]));

                return Redirect::route( 'subscription-thanks', ['code' => $subcriber->id ] )
                    ->with('subscriber', $subcriber)
                    ->with('message', [
                        'code'      => self::$statusOk,
                        'message'   => Lang::get('subscribers.mail.subscribers_activation_success')
                    ]);
            }
        }

        return Redirect::route( 'subscription-activation-error' )
            ->with('message', array(
                    'code'      => self::$statusError,
                    'message'   => Lang::get('subscribers.mail.subscribers_activation_fail')
                )
            );
    }

    /**
     * Deactivating the subscription
     *
    */
    public function deactivate( $code )
    {
        if ( $code ) {
            $subcriber = $this->subscribers->getByActivationCode($code, $this->statuses['FAILURE']);

            if ( $subcriber ) {

                $subcriber->is_active = $this->statuses['FAILURE'];
                $subcriber->save();

                return Redirect::route( 'subscription-thanks', ['code' => $subcriber->id, 'unsubscribe' => true ] )
                    ->with('subscriber', $subcriber)
                    ->with('message', [
                        'code'      => self::$statusOk,
                        'message'   => Lang::get('subscribers.mail.subscribers_deactivation_success')
                    ]);
            }
        }

        return Redirect::route( 'subscription-activation-error', ['unsubscribe' => true] )
            ->with('message', array(
                    'code'      => self::$statusError,
                    'message'   => Lang::get('subscribers.mail.subscribers_deactivation_fail')
                )
            );
    }
}
