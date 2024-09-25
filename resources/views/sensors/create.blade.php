@extends('layouts.layout')
@section('title', 'Crear Sensor')

@section('content')
<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Sensores / Registro</h1>
</div>

<div class="containercreate">
    <form action="{{ route('sensors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Sensor:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type">Tipo de Sensor:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="">Seleccione un tipo de sensor</option>
                <option value="consumo">Consumo</option>
                <option value="calidad">Calidad</option>
                <option value="nivel">Nivel</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tank_id">Tanque Asociado:</label>
            <select id="tank_id" name="tank_id" class="form-control">
            <option value="">Seleccione un tanque</option>
                @foreach($tanks as $tank)
                    <option value="{{ $tank->id }}">{{ $tank->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="buttons">
            <button type="button" class="volver"> <a href="{{ route('sensors.index') }}" >< Volver</a></button>
            <button type="submit" class="agregar"> + Agregar</button>
        </div>
    </form>
</div>
@endsection
