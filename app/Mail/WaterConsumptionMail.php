<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\WaterConsumption;
use Carbon\Carbon;
use App\Mail\WaterConsumptionMail;

class WaterConsumptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $currentMaxConsumption;
    public $previousDayMaxConsumption;
    public $totalConsumptionThisWeek;
    public $averageDailyConsumption;
    public $comparisonWithLastWeek;
    public $elevatedConsumption;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Fecha del domingo actual
        $thisSunday = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        // Fecha del domingo pasado
        $lastSunday = Carbon::now()->subWeek()->startOfWeek(Carbon::SUNDAY);

        // Consumo máximo acumulado del domingo actual
        $maxConsumptionThisSunday = WaterConsumption::whereDate('timestamp', $thisSunday)
            ->max('consumption_volume');

        // Consumo máximo acumulado del domingo pasado
        $maxConsumptionLastSunday = WaterConsumption::whereDate('timestamp', $lastSunday)
            ->max('consumption_volume');

        // Calcular el consumo total de esta semana
        $this->totalConsumptionThisWeek = $maxConsumptionThisSunday - $maxConsumptionLastSunday;

        // Calcular el promedio diario de consumo esta semana (suponiendo 7 días)
        $this->averageDailyConsumption = $this->totalConsumptionThisWeek / 7;

        // Calcular el consumo máximo del día actual
        $this->currentMaxConsumption = WaterConsumption::whereDate('timestamp', now()->toDateString())
            ->max('consumption_volume');

        // Calcular el consumo máximo del día anterior
        $this->previousDayMaxConsumption = WaterConsumption::whereDate('timestamp', now()->subDay()->toDateString())
            ->max('consumption_volume');

        // Comparar con el consumo de la semana pasada
        $maxConsumptionTwoSundaysAgo = WaterConsumption::whereDate('timestamp', Carbon::now()->subWeeks(2)->startOfWeek(Carbon::SUNDAY))
            ->max('consumption_volume');

        if ($maxConsumptionTwoSundaysAgo > 0) {
            $this->comparisonWithLastWeek = (($maxConsumptionThisSunday - $maxConsumptionLastSunday) - ($maxConsumptionLastSunday - $maxConsumptionTwoSundaysAgo)) / ($maxConsumptionLastSunday - $maxConsumptionTwoSundaysAgo) * 100;
        } else {
            $this->comparisonWithLastWeek = 0; // Evitar división por cero si no hay datos de semanas anteriores
        }

        // Definir si hay una alerta de consumo elevado (más del 10% de incremento)
        $this->elevatedConsumption = $this->comparisonWithLastWeek > 10;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.water_consumption')
            ->subject('Alerta Semanal de Consumo de Agua')
            ->with([
                'currentMaxConsumption' => $this->currentMaxConsumption,
                'previousDayMaxConsumption' => $this->previousDayMaxConsumption,
                'totalConsumptionThisWeek' => $this->totalConsumptionThisWeek,
                'averageDailyConsumption' => $this->averageDailyConsumption,
                'comparisonWithLastWeek' => $this->comparisonWithLastWeek,
                'elevatedConsumption' => $this->elevatedConsumption,
            ]);
    }
}
