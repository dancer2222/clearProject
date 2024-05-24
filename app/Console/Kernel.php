<?php

namespace App\Console;

use App\Console\Commands\GetTemperatureByCity;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        GetTemperatureByCity::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->job('temperature:by_city')->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');



        require base_path('routes/console.php');
    }
}
