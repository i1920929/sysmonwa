@extends('layouts.layout')

@section('content')
<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios / Editar</h1>
</div>

<div class="containercreate">
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"> <!-- Asegúrate de incluir enctype -->
        @csrf
        @method('PUT')

        <!-- Nombre del Usuario -->
        <div class="form-group mb-3">
            <label for="first_name" class="form-label">Nombre:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
        </div>

        <!-- Apellido del Usuario -->
        <div class="form-group mb-3">
            <label for="last_name" class="form-label">Apellido:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
        </div>

        <!-- Nombre de Usuario -->
        <div class="form-group mb-3">
            <label for="username" class="form-label">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}" required>
        </div>

        <!-- Email del Usuario -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <!-- Contraseña -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">Contraseña (dejar en blanco para no cambiar):</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <!-- Confirmar Contraseña -->
        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <!-- Imagen de Perfil Actual -->
        <div class="form-group mb-3">
            <label for="profile_image" class="form-label">Imagen de Perfil Actual:</label>
            <div>
                <img src="{{ asset('images/' . $user->profile_image) }}" alt="Imagen de perfil" width="150px">
            </div>
        </div>

        <!-- Cargar Nueva Imagen de Perfil -->
        <div class="form-group mb-3">
            <label for="profile_image" class="form-label">Cambiar Imagen de Perfil (opcional):</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror" accept="image/*">
            @error('profile_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Rol -->
        @if(Auth::user()->role === 'Administrador')
        <div class="form-group mb-3">
            <label for="role" class="form-label">Rol:</label>
            <select id="role" name="role" class="form-select" required>
                <option value="Usuario" {{ $user->role == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="Administrador" {{ $user->role == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>
        
        <!-- Lista de Clientes -->
        <div class="form-group mb-3">
            <label for="client_id" class="form-label">Seleccionar Cliente:</label>
            <select id="client_id" name="client_id" class="form-select">
                <option value="">Selecciona un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $user->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <!-- Botones para Guardar y Volver -->
        <div class="buttons">
            <button type="button" class="volver"><a href="{{ route('users.index') }}">< Volver</a></button>
            <button type="submit" class="editar"> <i class="fas fa-edit mr-1"></i> Actualizar</button>
        </div>
    </form>
</div>
@endsection
