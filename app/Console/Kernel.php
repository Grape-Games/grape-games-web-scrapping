<?php

namespace App\Console;

use App\Console\Commands\Scrapper\BothSiteCron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        BothSiteCron::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->exec('/usr/bin/php /home/innolgkl/scrapper.innovativeappstudio.website/grape-games-web-scrapping/artisan scrap:both')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs') . '/cron-get_events.log'); //command('scrap:both')->everyMinute()->sendOutputTo(base_path() . '/app/console/log.txt');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
