@extends('layouts.layout')

@section('content')
<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios / Detalles</h1>
</div>

<div class="containercreate">
    <form>
        <div class="form-group">
            <label for="first_name">Nombre:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $user->first_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="last_name">Apellido:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $user->last_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}" disabled>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <div class="form-group">
            <label for="role">Rol:</label>
            <input type="text" id="role" name="role" class="form-control" value="{{ $user->role }}" disabled>
        </div>

        <div class="form-group">
            <label for="client_id">Cliente:</label>
            <input type="text" id="client_id" name="client_id" class="form-control" value="{{ $user->client ? $user->client->name : 'Sin Cliente' }}" disabled>
        </div>

        <div class="buttons">
            <button type="button" class="volver">
                <a href="{{ route('users.index') }}">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </button>
        
        </div>
    </form>
</div>
@endsection
