<?php

namespace App\Listeners\Mail;

use App\Events\Mail\SendMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpParser\Node\Expr\Cast\String_;
use Lang, Mail, Config;

class SendMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the template path
     *
     * @param template String
     * @param theme String
     *
     * @return String
    */
    public function buildTemplatePath( $template, $theme = '' )
    {
        return ( $theme ? $theme . '.' : '') . 'emails.' . $template;
    }

    /**
     * Build the subscet for the mail
     *
     * @param String $type
     *
     * @return String
    */
    public function getSubject( $type )
    {
        $result = '';

        switch ( $type ) {
            case SendMail::SUBSCRIBER_ACTIVATION:
                $result = Lang::get('subscribers.mail.subscribers_activation');
                break;

            case SendMail::SUBSCRIBER_ACTIVATION_SUCCESS:
                $result = Lang::get('subscribers.mail.subscribers_activation_success');
                break;

            case SendMail::SUBSCRIBER_DEACTIVATION:
                $result = Lang::get('subscribers.mail.subscribers_deactivation');
                break;

            case SendMail::SUBSCRIBER_DEACTIVATION_SUCCESS:
                $result = Lang::get('subscribers.mail.subscribers_deactivation_success');
                break;

            case SendMail::SUBSCRIBER_LIST_OF_UPDATES:
                $result = Lang::get('subscribers.mail.subscribers_last_news');
                break;

        }

        return $result;
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        // For more info: https://laravel.com/docs/5.2/mail
        $aParams  = $event->aParams;

        $template = array_key_exists('template', $aParams) ? $aParams['template'] : '';
        $theme    = 'Themes.' . Config::get('theme.Themes.name');
        $subject  = array_key_exists('subject', $aParams) ? $aParams['subject'] : $this->getSubject( $template );

        Mail::send($this->buildTemplatePath( $template, $theme ), array_merge([
            '__theme' => $theme . '.emails'
        ], $aParams), function ($message) use ($aParams, $subject) {
            $email = array_key_exists('to', $aParams) ? $aParams['to'] : '';

            $message->from('noreply@pervomaisk.mk.ua', get_short_site_name() );
            $message->subject( '[' . $subject . ']: ' . get_site_name() );

            if ( $email ) {
                $message->to( $email );
            }
        });
    }
}
