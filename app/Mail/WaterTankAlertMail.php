<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WaterTankAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $waterLevel;
    public $alertType;

    /**
     * Create a new message instance.
     *
     * @param float $waterLevel
     * @param string $alertType
     */
    public function __construct($waterLevel, $alertType)
    {
        $this->waterLevel = $waterLevel;
        $this->alertType = $alertType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.water_level_alert')
                    ->subject('Alerta de Nivel de Agua')
                    ->with([
                        'waterLevel' => $this->waterLevel,
                        'alertType' => $this->alertType,
                    ]);
    }
}