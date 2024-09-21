@extends('layouts.layout')
@section('title', 'Inicio')

@section('content')

<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de tanques / Registro </h1>
</div>  

<div class="containercreate">
    <form action="{{ route('tanques.store') }}" method="POST">
    @csrf
        <div class="form-group">
            <label for="name">Nombre del tanque:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="location">Ubicación:</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacidad:</label>
            <input type="number" id="capacity" name="capacity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="unit">Unidad:</label>
            <input type="text" id="unit" name="unit" value="litros"  class="form-control" required>
        </div>

        <div class="form-group">
            <label for="client_id">Cliente:</label>
            <select id="client_id" name="client_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option> <!-- Asegúrate de que el campo name exista en el modelo Client -->
                @endforeach
            </select>
        </div>

        <div class="buttons">
            <button type="button" class="volver"> <a href="{{ route('tanques.index') }}" >< Volver</a></button>
            <button type="submit" class="agregar"> + Agregar</button>
        </div>
    </form>
</div>

@endsection
