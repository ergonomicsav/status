<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\RunScannerDomens'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:monitoring')
//            ->everyMinute()
            ->everyFifteenMinutes()
            ->appendOutputTo('public/vendor/error.log');
        $schedule->command('command:ssl')
            ->dailyAt('7:30')
            ->appendOutputTo('public/vendor/error.log');
        $schedule->command('command:expiry')
            ->dailyAt('8:30')
            ->appendOutputTo('public/vendor/error.log');
        $schedule->command('command:botmonitoring')
            ->hourlyAt(17)
        ->appendOutputTo('public/vendor/error.log');
        $schedule->command('command:botssl')
            ->dailyAt('8:00')
            ->appendOutputTo('public/vendor/error.log');
        $schedule->command('command:botexpiry')
            ->dailyAt('9:00')
            ->appendOutputTo('public/vendor/error.log');
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
