<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Tanque;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sensors = Sensor::with('tank')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%");
            })
            ->paginate(10);
        
        return view('sensors.index', compact('sensors'));
    }

    public function create()
    {
        $tanks = Tanque::all(); // Para el dropdown de tanques
        return view('sensors.create', compact('tanks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:consumo,calidad,nivel',
            'tank_id' => 'nullable|exists:tanks,id',
        ]);

        Sensor::create($request->all());

        return redirect()->route('sensors.index')->with('success', 'Sensor creado correctamente.');
    }

    public function show(Sensor $sensor)
    {
        $tanks = Tanque::all();
        return view('sensors.show', compact('sensor', 'tanks'));
        
    }

    public function edit(Sensor $sensor)
    {
        $tanks = Tanque::all();
        return view('sensors.edit', compact('sensor', 'tanks'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:consumo,calidad,nivel',
            'tank_id' => 'nullable|exists:tanks,id',
        ]);

        $sensor->update($request->all());

        return redirect()->route('sensors.index')->with('success', 'Sensor actualizado correctamente.');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return redirect()->route('sensors.index')->with('success', 'Sensor eliminado correctamente.');
    }
}