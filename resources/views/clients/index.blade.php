@extends('layouts.layout')
@section('title', 'Inicio')

@section('content')

<div class="container-header">
    <h1 class="text-2xl font-bold mb-4">Gestión de Clientes</h1>
</div>

<!-- Contenedor para el formulario de búsqueda y botón de agregar -->
<div class="border border-[#3E7FF5] p-4 rounded-lg mb-4 flex items-center space-x-2">
    <form action="{{ route('clients.index') }}" method="GET" class="flex-grow">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o ubicación"
               class="border border-gray-300 rounded-lg px-4 py-2 w-full" />

    </form>
    
    <a href="{{ route('clients.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Agregar
    </a>
</div>

<!-- Tabla de Clientes -->
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#C4C4C4] table-header">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Información de Contacto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($clients as $client)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->contact_info }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->location }}</td>
                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                        <!-- Ver -->
                        <a href="{{ route('clients.show', $client) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>
                            Ver
                        </a>

                        <!-- Editar -->
                        <a href="{{ route('clients.edit', $client) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 4.879l-9.192 9.192 1.415 1.415 9.192-9.192z" />
                            </svg>
                            Editar
                        </a>

                        <!-- Eliminar -->
                        <form id="deleteForm-{{ $client->id }}" action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="deleteBtn bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded hover:bg-yellow-600 flex items-center" data-form-id="deleteForm-{{ $client->id }}">
                                <svg class="h-4 w-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center px-6 py-4">No hay clientes disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pop-up -->
    <div id="deleteModal" style="display: none;">
        <div class="modal-content">
            <div class="container-header">
                <h2 class="text-2xl font-bold mb-4"><i class="fas fa-trash mr-1"></i> Eliminando Registro</h2>
            </div>
            <p>¿Estás seguro de eliminar el cliente seleccionado?</p>
            <button id="cancelBtn" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Cancelar
            </button>
            <button id="confirmDeleteBtn" class="btn btn-danger">
                <i class="fas fa-trash mr-1"></i> Eliminar
            </button>
        </div>
    </div>
</div>

<!-- Enlaces de Paginación -->
<div class="mt-4">
    {{ $clients->links() }}
</div>

@endsection
