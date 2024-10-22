<?php

namespace App\Http\Controllers\Api;

use App\Models\WaterLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WaterLevelController extends Controller
{
    public function index()
    {
        $waterLevels = WaterLevel::orderBy('timestamp', 'desc')->take(100)->get();
        return response()->json($waterLevels);
    }

    public function getDailyLevel()
    {
        $dailyLevels = WaterLevel::selectRaw('DATE(timestamp) as date, AVG(level) as avg_level')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($dailyLevels);
    }

    public function historicalData(Request $request)
    {
        $minDate = '2024-09-24 21:49:56';
        $query = WaterLevel::query()->where('timestamp', '>=', $minDate);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('timestamp', [$request->start_date, $request->end_date]);
        }

        $historicalData = $query->paginate(10);
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
        // Obtener todos los registros de nivel de agua
        $waterLevels = WaterLevel::all();

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Configurar encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Timestamp');
        $sheet->setCellValue('C1', 'Nivel (cm)');
        $sheet->setCellValue('D1', 'Unidad');
        $sheet->setCellValue('E1', 'ID Sensor');
        $sheet->setCellValue('F1', 'ID Tanque');

        // Agregar los datos
        $row = 2; // Comenzar en la segunda fila
        foreach ($waterLevels as $level) {
            $sheet->setCellValue('A' . $row, $level->id);
            $sheet->setCellValue('B' . $row, $level->timestamp);
            $sheet->setCellValue('C' . $row, $level->level);
            $sheet->setCellValue('D' . $row, $level->unit);
            $sheet->setCellValue('E' . $row, $level->sensor_id);
            $sheet->setCellValue('F' . $row, $level->tank_id);
            $row++;
        }

        // Configurar el escritor de XLSX
        $writer = new Xlsx($spreadsheet);
        
        // Enviar el archivo al navegador
        $filename = 'nivel_agua_' . date('Y_m_d_H_i_s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Guardar el archivo en la salida
        $writer->save('php://output');
        exit;
    }
}
