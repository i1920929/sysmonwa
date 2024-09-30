<?php

namespace App\Http\Controllers\Api;

use App\Models\WaterConsumption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\WaterConsumptionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class WaterConsumptionController extends Controller

{
    public function index()
{
    // Obtener el consumo máximo del día anterior
    $yesterdayMaxConsumption = DB::table('water_consumption')
        ->select(DB::raw('MAX(consumption_volume) AS max_consumption'))
        ->whereDate('timestamp', '=', now()->subDays(1)->toDateString())
        ->value('max_consumption');

    // Obtener los últimos 150 registros de consumo de agua
    $waterConsumption = WaterConsumption::orderBy('timestamp', 'desc')
        ->take(100)
        ->get()
        ->values(); // Convertir a array

    // Actualizar el consumption_volume en base al máximo del día anterior
    foreach ($waterConsumption as $item) {
        // Calcula el nuevo consumption_volume como el valor absoluto
        $item->consumption_volume = abs($yesterdayMaxConsumption - $item->consumption_volume);
    }

    return response()->json($waterConsumption);
}

    public function getDailyConsumption()
{
    // Obtener los datos acumulados
    $dailyConsumption = WaterConsumption::selectRaw('DATE(timestamp) as date, MAX(consumption_volume) as max_volume')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // Calcular la diferencia diaria
    $consumptionArray = [];
    $previousMax = 0;

    foreach ($dailyConsumption as $data) {
        $currentMax = $data->max_volume;
        $dailyDifference = $currentMax - $previousMax; // Diferencia con el día anterior
        $consumptionArray[] = [
            'date' => $data->date,
            'daily_consumption' => $dailyDifference > 0 ? $dailyDifference : 0 // Evitar valores negativos
        ];
        $previousMax = $currentMax; // Actualiza el valor anterior
    }

    return response()->json($consumptionArray);
}
public function historicalData(Request $request)
    {
        // Definir la fecha mínima
        $minDate = '2024-09-24 21:49:56';

        // Filtrar por rango de fechas si se proporcionan, además de la fecha mínima
        $query = WaterConsumption::query()->where('created_at', '>=', $minDate);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Obtener datos históricos con paginación
        $historicalData = $query->paginate(10); // Cambia el número según tus necesidades

        return view('consumption.historical', compact('historicalData'));
    }
    public function exportCSV()
    {
        $filename = "water_consumption_" . date('Y-m-d') . ".csv";
        $waterConsumptions = WaterConsumption::all();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');

        // Añadir encabezados
        fputcsv($handle, ['ID', 'Timestamp', 'Location', 'Consumption Volume', 'Unit', 'Sensor ID', 'Tank ID']);

        // Añadir datos
        foreach ($waterConsumptions as $waterConsumption) {
            fputcsv($handle, [
                $waterConsumption->id,
                $waterConsumption->timestamp,
                $waterConsumption->location,
                $waterConsumption->consumption_volume,
                $waterConsumption->unit,
                $waterConsumption->sensor_id,
                $waterConsumption->tank_id,
            ]);
        }

        fclose($handle);
        exit();
    }

    public function exportXLS()
    {
        $filename = "water_consumption_" . date('Y-m-d') . ".xls";
        $waterConsumptions = WaterConsumption::all();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Añadir encabezados
        echo "ID\tTimestamp\tLocation\tConsumption Volume\tUnit\tSensor ID\tTank ID\n";

        // Añadir datos
        foreach ($waterConsumptions as $waterConsumption) {
            echo $waterConsumption->id . "\t" .
                $waterConsumption->timestamp . "\t" .
                $waterConsumption->location . "\t" .
                $waterConsumption->consumption_volume . "\t" .
                $waterConsumption->unit . "\t" .
                $waterConsumption->sensor_id . "\t" .
                $waterConsumption->tank_id . "\n";
        }

        exit();
    }
    public function enviarAlertaConsumo()
    {
         // Obtener el correo electrónico del usuario logueado
        $user = Auth::user();

        // Verificar si el usuario está autenticado
        if ($user) {
            Mail::to($user->email)->send(new WaterConsumptionMail());

            return 'Correo enviado con éxito al usuario logueado.';
        } else {
            return 'No hay ningún usuario logueado.';
        }
    }
}
