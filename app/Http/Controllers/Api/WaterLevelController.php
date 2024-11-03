<?php

namespace App\Http\Controllers\Api;
use App\Models\WaterLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\WaterTankAlertMail;

class WaterLevelController extends Controller
{
    public function index()
    {
        $waterLevels = WaterLevel::orderBy('timestamp', 'desc')->take(100)->get();
        return response()->json($waterLevels);
    }

    public function getLatestLevel()
    {
        $latestLevel = WaterLevel::orderBy('timestamp', 'desc')->first();
        return response()->json($latestLevel);
    }

    public function historicalData(Request $request)
    {
        $minDate = '2024-09-24 21:49:56';
        $query = WaterLevel::query()->where('timestamp', '>=', $minDate);
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('timestamp', [$request->start_date, $request->end_date]);
        }
    
        // Ordenar los resultados por timestamp en orden descendente
        $historicalData = $query->orderBy('timestamp', 'desc')->paginate(20);
    
        return view('level.historical', compact('historicalData'));
    }
    

    public function exportCSV()
    {
        $filename = "water_level_" . date('Y-m-d') . ".csv";
        $waterLevels = WaterLevel::all();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID', 'Timestamp', 'Level', 'Unit', 'Sensor ID', 'Tank ID']);

        foreach ($waterLevels as $waterLevel) {
            fputcsv($handle, [
                $waterLevel->id,
                $waterLevel->timestamp,
                $waterLevel->level,
                $waterLevel->unit,
                $waterLevel->sensor_id,
                $waterLevel->tank_id,
            ]);
        }

        fclose($handle);
        exit();
    }

    public function exportXLS()
    {
        $filename = "water_level_" . date('Y-m-d') . ".xls";
        $waterLevels = WaterLevel::all();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrir salida para escribir el contenido en formato de tabla HTML
        echo '<table border="1">';
        echo '<tr>
                <th>ID</th>
                <th>Timestamp</th>
                <th>Level</th>
                <th>Unit</th>
                <th>Sensor ID</th>
                <th>Tank ID</th>
              </tr>';

        foreach ($waterLevels as $waterLevel) {
            echo '<tr>';
            echo '<td>' . $waterLevel->id . '</td>';
            echo '<td>' . $waterLevel->timestamp . '</td>';
            echo '<td>' . $waterLevel->level . '</td>';
            echo '<td>' . $waterLevel->unit . '</td>';
            echo '<td>' . $waterLevel->sensor_id . '</td>';
            echo '<td>' . $waterLevel->tank_id . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        exit();
    }

    public function enviarAlertaNivel()
{
    try {
        // Obtener el último registro del nivel del tanque
        $tank = WaterLevel::orderBy('id', 'desc')->first(); // Asumiendo que 'id' es el campo de identificación

        if ($tank) {
            $waterLevel = $tank->level; // Obtener el nivel del tanque

            // Determinar el tipo de alerta según el nivel de agua
            $alertType = null;
            if ($waterLevel >= 17) {
                $alertType = 'high';
            } elseif ($waterLevel <= 5) { // Cambiar 5 por el nivel mínimo crítico
                $alertType = 'low';
            }

            // Enviar alerta si es necesario
            if ($alertType) {
                Mail::to('71383938@continental.edu.pe')->send(new WaterTankAlertMail($waterLevel, $alertType));
                
                // Mensaje de éxito
                \Log::info('Alerta enviada: Nivel de agua ' . $waterLevel . ' - Tipo de alerta: ' . $alertType);
                return 'Correo enviado con éxito al usuario logueado.';
            }
        } else {
            // Manejo del caso donde no se encuentra un registro
            \Log::warning('No se encontraron registros de nivel de agua.');
            return 'eroroes';
        }
    } catch (\Exception $e) {
        // Manejo de excepciones para registrar errores
        \Log::error('Error al enviar alerta de nivel de agua: ' . $e->getMessage());
        return 'Correo enviado con éxito al usuario logueado.';

    }
}

}
