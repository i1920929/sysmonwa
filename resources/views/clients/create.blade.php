@extends('layouts.layout')

@section('content')
    <div class="container-header">
        <h1 class="text-2xl font-bold mb-4">Gestión de Cliente / Registro</h1>
    </div>

    <div class="containercreate">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <!-- Nombre del Cliente -->
            <div class="form-group">
                <label for="name">Nombre del Cliente:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Ubicación del Cliente -->
            <div class="form-group">
                <label for="location">Ubicación:</label>
                <input type="text" id="location" name="location" class="form-control" required>
            </div>
            <!-- Información de Contacto -->
            <div class="form-group">
                <label for="contact_info">Número de Contacto:</label>
                <input type="text" id="contact_info" name="contact_info" class="form-control" required></input>
            </div>

            <!-- Email del Cliente -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            

            <!-- Botones para Guardar y Volver -->

            <div class="buttons">
                <button type="button" class="volver"> <a href="{{ route('clients.index')}}" >< Volver</a></button>
                <button type="submit" class="agregar"> + Agregar</button>
            </div>

        </form>
    </div>
@endsection
