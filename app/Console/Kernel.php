<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Esta tarea se ejecuta cada lunes a las 9:00 AM
        $schedule->call(function () {
            // Aquí llamas al método de tu controlador
            app(\App\Http\Controllers\Api\WaterConsumptionController::class)->enviarAlertaConsumo();
        })->weeklyOn(1, '9:00'); // 1 es para lunes, 9:00 AM
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
