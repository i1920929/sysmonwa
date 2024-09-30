<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Api\WaterConsumptionController; // Asegúrate de tener el namespace correcto

class SendWeeklyWaterConsumptionReport extends Command
{
    protected $signature = 'email:send-weekly-report';
    protected $description = 'Envía un informe semanal de consumo de agua';

    public function handle()
    {
        // Crear una instancia del controlador
        $controller = new WaterConsumptionController();

        // Llama al método que envía la alerta
        $controller->enviarAlertaConsumo();

        $this->info('Correo enviado exitosamente.');
    }
}
