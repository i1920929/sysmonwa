@extends('layouts.layout')
@section('title', 'Ver Tanque')

@section('content')

<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Tanques / Detalles</h1>
</div>

<div class="containercreate">
    <form>
        <!-- Nombre del tanque -->
        <div class="form-group">
            <label for="name">Nombre del tanque:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $tanque->name }}" disabled>
        </div>

        <!-- Ubicación -->
        <div class="form-group">
            <label for="location">Ubicación:</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ $tanque->location }}" disabled>
        </div>

        <!-- Capacidad -->
        <div class="form-group">
            <label for="capacity">Capacidad:</label>
            <input type="number" id="capacity" name="capacity" class="form-control" value="{{ $tanque->capacity }}" disabled>
        </div>

        <!-- Unidad -->
        <div class="form-group">
            <label for="unit">Unidad:</label>
            <input type="text" id="unit" name="unit" class="form-control" value="{{ $tanque->unit }}" disabled>
        </div>

        <!-- Cliente asociado -->
        <div class="form-group">
            <label for="client_id">Cliente:</label>
            <input type="text" id="client_id" name="client_id" class="form-control" value="{{ $tanque->client->name ?? 'Ninguno' }}" disabled>
        </div>

        <!-- Botón Volver -->
        <div class="buttons">
            <button type="button" class="volver">
                <a href="{{ route('tanques.index') }}" class="text-white">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </button>
        </div>
    </form>
</div>

@endsection
