<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\NotifySubscribersAboutLatestChanges;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        NotifySubscribersAboutLatestChanges::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // For more info: https://laravel.com/docs/5.2/scheduling

        $dt = Carbon::now();


        // Run this command from Monday to Friday at 18:30
        $schedule->command('mail:latestnews')
            ->timezone('Europe/Kiev')
            ->dailyAt('18:30')
            ->when(function() use($dt) {
                if ( $dt->dayOfWeek == Carbon::SUNDAY || $dt->dayOfWeek == Carbon::SATURDAY) {
                    return false;
                }
                return true;
            });
    }
}