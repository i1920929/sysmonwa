<?php

namespace App\Http\Controllers\Api;

use App\Models\WaterLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
