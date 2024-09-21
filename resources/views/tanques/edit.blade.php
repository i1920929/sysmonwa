@extends('layouts.layout')
@section('title', 'Editar Tanque')

@section('content')

<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de tanques / Editar</h1>
</div>  

<div class="containercreate">
    <form action="{{ route('tanques.update', $tanque) }}" method="POST">
        @csrf
        @method('PUT') <!-- Asegúrate de incluir esto para indicar que es una actualización -->
        
        <div class="form-group">
            <label for="name">Nombre del tanque:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $tanque->name) }}" required>
        </div>

        <div class="form-group">
            <label for="location">Ubicación:</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $tanque->location) }}" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacidad:</label>
            <input type="number" id="capacity" name="capacity" class="form-control" value="{{ old('capacity', $tanque->capacity) }}" required>
        </div>

        <div class="form-group">
            <label for="unit">Unidad:</label>
            <input type="text" id="unit" name="unit" value="{{ old('unit', $tanque->unit) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="client_id">Cliente:</label>
            <select id="client_id" name="client_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $tanque->client_id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="buttons">
                <button type="button" class="volver">
                    <a href="{{ route('tanques.index') }}">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </button>
                <button type="submit" class="agregar">
                    <i class="fas fa-edit mr-1"></i> Actualizar
                </button>
            </div>
    </form>
</div>

@endsection
