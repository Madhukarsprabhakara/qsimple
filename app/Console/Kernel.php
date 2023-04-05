<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
       Commands\RunQueryE24h::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('jobs:RunQueryE24h')->daily();
        $schedule->command('jobs:RunQueryE12h')->twiceDailyAt(5, 14, 35);
        //$schedule->command('jobs:RunQueryE12h')->twiceDaily(1, 13);
        //$schedule->command('jobs:RunQueryE6h')->everySixHours();
        $schedule->command('jobs:RunQueryE1h')->hourly();
        //$schedule->command('jobs:RunQueryE1h')->quarterly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
