@extends('layouts.layout')
@section('title', 'Editar Sensor')

@section('content')
<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Sensores / Editar</h1>
</div>

<div class="containercreate">
    <form action="{{ route('sensors.update', $sensor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre del Sensor:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $sensor->name }}" required>
        </div>

        <div class="form-group">
            <label for="type">Tipo de Sensor:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="consumo" {{ $sensor->type == 'consumo' ? 'selected' : '' }}>Consumo</option>
                <option value="calidad" {{ $sensor->type == 'calidad' ? 'selected' : '' }}>Calidad</option>
                <option value="nivel" {{ $sensor->type == 'nivel' ? 'selected' : '' }}>Nivel</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tank_id">Tanque Asociado:</label>
            <select id="tank_id" name="tank_id" class="form-control">
                @foreach($tanks as $tank)
                    <option value="{{ $tank->id }}" {{ $sensor->tank_id == $tank->id ? 'selected' : '' }}>{{ $tank->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="buttons">
                <button type="button" class="volver">
                    <a href="{{ route('sensors.index') }}">
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
