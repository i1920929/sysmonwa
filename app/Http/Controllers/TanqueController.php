<?php

namespace App\Http\Controllers;

use App\Models\Tanque;
use App\Models\Client;
use Illuminate\Http\Request;

class TanqueController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        // Cargar tanques con su cliente asociado
        $tanques = Tanque::with('client') // Cargar la relación 'client'
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('name', 'like', "%{$query}%")
                                    ->orWhere('location', 'like', "%{$query}%");
            })
            ->paginate(7);

        return view('tanques.index', compact('tanques', 'query'));
    }

    public function create()
    {
        $clients = Client::all(); // Obtén todos los clientes
        return view('tanques.create', compact('clients')); // Pasa los clientes a la vista
    }

    public function store(Request $request)
    {

    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'capacity' => 'required|numeric',
        'unit' => 'required|string',
        'client_id' => 'required|exists:clients,id', // Validación para que el cliente exista
    ]);

    // Crear el nuevo tanque
    Tanque::create([
        'name' => $request->name,
        'location' => $request->location,
        'capacity' => $request->capacity,
        'unit' => $request->unit,
        'client_id' => $request->client_id, // Se guarda el client_id
    ]);

    return redirect()->route('tanques.index')->with('success', 'Tanque creado exitosamente');
    }

    

    public function show(Tanque $tanque)
    {
        $clients = Client::all();
        return view('tanques.show', compact('tanque', 'clients'));
    }

    public function edit(Tanque $tanque)
    {
         // Obtén todos los clientes para el combo
        $clients = Client::all();

        // Retorna la vista de edición y pasa el tanque y la lista de clientes
        return view('tanques.edit', compact('tanque', 'clients'));

    }

    public function update(Request $request, Tanque $tanque)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'capacity' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'client_id' => 'nullable|exists:clients,id',
        ]);

        $tanque->update($request->all());
        return redirect()->route('tanques.index')->with('success', 'Tanque actualizado exitosamente.');
    }

    public function destroy(Tanque $tanque)
    {
        $tanque->delete();
        return redirect()->route('tanques.index')->with('success', 'Tanque eliminado exitosamente.');
    }
}
