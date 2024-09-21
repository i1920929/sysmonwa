@extends('layouts.layout')

@section('content')
    <div class="container-header">
        <h1 class="text-2xl font-bold mb-4">Gestión de Clientes / Editar</h1>
    </div>

    <div class="containercreate">
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre del Cliente:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $client->name }}" required>
            </div>

            <div class="form-group">
                <label for="location">Ubicación:</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ $client->location }}">
            </div>

            <div class="form-group">
                <label for="contact_info">Número de Contacto:</label>
                <input type="text" id="contact_info" name="contact_info" class="form-control" value="{{ $client->contact_info }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $client->email }}">
            </div>


            <div class="buttons">
                <button type="button" class="volver">
                    <a href="{{ route('clients.index') }}">
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
