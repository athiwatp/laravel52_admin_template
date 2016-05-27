<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\SubscribersRepository;
use App\Repositories\NewsRepository;
use App\Repositories\AnnouncementsRepository;
use App\Events\Mail\SendMail;
use Event, Lang, Carbon\Carbon, Config;

class NotifySubscribersAboutLatestChanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:latestnews';

    /**
     * Inject the subscriber Repository here
     *
     * @var Object
    */
    protected $subscribers = null;

    /**
     * Inject the news Repository here
     *
     * @var Object
     */
    protected $news = null;

    /**
     * Inject the announce repository
     *
     * @var Object
    */
    protected $announces = null;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the daily emails to subscribers to let them know about the latest changes which happened to the site`s content';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SubscribersRepository $subsciber, NewsRepository $news, AnnouncementsRepository $announce)
    {
        parent::__construct();

        $this->subscribers = $subsciber;

        $this->news = $news;

        $this->announces = $announce;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = [];

        // 1. Get the latest news that were added to the system
        $news = $this->news->getTodaysNews();

        foreach( $news as $item) {
            $result[] = [
                'title' => $item->title,
                'description' => str_custom_limit($item->content, 200),
                'date' => $item->date->timestamp,
                'date_formatted' => get_formatted_date($item->date),
                'url' => route('news-url', [ 'url' => $item->url ]),
                'type' => Lang::get('news.mail.type'),
                'type_url' => route('news-index')
            ];
        }

        // 2. Get the list of latest announces
        $announces = $this->announces->getTodaysAnnounces();

        foreach( $announces as $item) {
            $result[] = [
                'title' => $item->title,
                'description' => str_custom_limit($item->description, 200),
                'date' => $item->date_start->timestamp,
                'date_formatted' => get_formatted_date( $item->date_start ) . ' - ' . get_formatted_date( $item->date_end ),
                'url' => route('announce-show', ['id' => $item->id ]),
                'type' => Lang::get('announce.mail.type'),
                'type_url' => route('announce-list')
            ];
        }

        if ( $result && count($result) > 0 ) {
            $aSubscribers = $this->subscribers->getActiveSubscribers();

            if ( $aSubscribers && $aSubscribers->count() > 0 ) {
                // Do a sorting for the data
                usort($result, function($a, $b) {
                    return $a['date'] > $b['date'];
                });

                $today   = Carbon::now();
                $subject = Lang::get('subscribers.mail.subscribers_latest_updates', ['date' => get_formatted_date( $today )]);
                $theme   = 'Themes.' . Config::get('theme.Themes.name');

                foreach( $aSubscribers as $item ) {
                    Event::fire( new SendMail([
                        'theme' => $theme,
                        'template' => SendMail::SUBSCRIBER_LIST_OF_UPDATES,
                        'to' => $item->email,
                        'subject' => $subject,
                        'subscriber' => $item,
                        'today' => $today,
                        'list' => $result
                    ]));
                }
            }
        }

        $this->info('The messages were sent successfully!');
    }
}
