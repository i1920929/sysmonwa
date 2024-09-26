@extends('layouts.layout')

@section('content')
<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios / Registro</h1>
</div>

<div class="containercreate">
    
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"> <!-- Asegúrate de incluir enctype -->
        @csrf

        <!-- Nombre del Usuario -->
        <div class="form-group mb-3">
            <label for="first_name" class="form-label">Nombre:</label>
            <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Apellido del Usuario -->
        <div class="form-group mb-3">
            <label for="last_name" class="form-label">Apellido:</label>
            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Nombre de Usuario -->
        <div class="form-group mb-3">
            <label for="username" class="form-label">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Email del Usuario -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Contraseña -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Rol -->
        <div class="form-group mb-3">
            <label for="role" class="form-label">Rol:</label>
            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="Usuario" {{ old('role') == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="Administrador" {{ old('role') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Lista de Clientes -->
        <div class="form-group mb-3">
            <label for="client_id" class="form-label">Seleccionar Cliente:</label>
            <select id="client_id" name="client_id" class="form-select @error('client_id') is-invalid @enderror">
                <option value="" disabled selected>Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Imagen de Perfil -->
        <div class="form-group mb-3">
            <label for="profile_image" class="form-label">Imagen de Perfil:</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror" accept="image/*">
            @error('profile_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Botones para Guardar y Volver -->
        <div class="buttons">
            <button type="button" class="volver"> <a href="{{ route('users.index') }}"> < Volver</a></button>
            <button type="submit" class="agregar"> + Agregar</button>
        </div>
    </form>
</div>
@endsection
