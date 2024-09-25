@extends('layouts.layout')
@section('title', 'Ver Sensor')

@section('content')

<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Sensores / Detalles </h1>
</div>

<div class="containercreate">
    <form>
        <!-- Nombre del sensor -->
        <div class="form-group">
            <label for="name">Nombre del sensor:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $sensor->name }}" disabled>
        </div>

        <!-- Tipo de sensor -->
        <div class="form-group">
            <label for="type">Tipo de sensor:</label>
            <input type="text" id="type" name="type" class="form-control" value="{{ ucfirst($sensor->type) }}" disabled>
        </div>

        <!-- Tanque asociado -->
        <div class="form-group">
            <label for="tank_id">Tanque asociado:</label>
            <input type="text" id="tank_id" name="tank_id" class="form-control" value="{{ $sensor->tank->name ?? 'Ninguno' }}" disabled>
        </div>


        <!-- Botón Volver -->
        <div class="buttons">
            <button type="button" class="volver">
                <a href="{{ route('sensors.index') }}">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </button>
        </div>
    </form>
</div>

@endsection
