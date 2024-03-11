<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule
            ->command('ones:sync category')
            ->daily()
            ->at('23:59')
            ->then(function (Schedule $schedule) {
                $this->call('ones:sync product');
                $this->call('product-images:sync');
                $this->call('product-keywords:update');
                $this->call('optimize:clear');
            });

        $schedule
            ->command('product-images:fix')
            ->everyTwoHours();
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
