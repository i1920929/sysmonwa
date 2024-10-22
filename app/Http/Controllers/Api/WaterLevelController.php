<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WaterLevel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class WaterLevelController extends Controller
{
    // Exportar a XLS para el historial
    public function exportHistoricalXLS(Request $request)
    {
        // Filtrar los registros de nivel de agua según la fecha proporcionada
        $waterLevels = WaterLevel::whereBetween('timestamp', [$request->start_date, $request->end_date])->get();

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
        $filename = 'historico_nivel_agua_' . date('Y_m_d_H_i_s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Guardar el archivo en la salida
        $writer->save('php://output');
        exit;
    }

    // Exportar a XLS para tiempo real (si es necesario)
    public function exportRealTimeXLS()
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
