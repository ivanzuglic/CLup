<?php

namespace App\Console;

use App\Tasks\AppointmentDeleteUpdate;
use App\Tasks\NotifyAt30;
use App\Tasks\StatisticsUpdate;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Executing NotifyAt30 task once every minute
        $schedule->call(new NotifyAt30())->everyMinute();
        // Executing StatisticsUpdate task once a day
        $schedule->call(new StatisticsUpdate())->dailyAt('23:55');
        //Executing AppointmentDeleteUpdate every five minutes
        $schedule->call(new AppointmentDeleteUpdate())->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
