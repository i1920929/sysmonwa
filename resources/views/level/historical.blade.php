@extends('layouts.layout')
@section('title', 'Histórico de Nivel de Agua')

@section('content')
<h1>Histórico de Nivel de Agua</h1>

<div class="flex justify-end mb-2">
    <a href="{{ route('export.water.level') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-200">
        Descargar CSV
    </a>
</div>

<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Nivel</th>
            <th>Unidad</th>
        </tr>
    </thead>
    <tbody>
        @forelse($historicalData as $data)
            <tr>
                <td>{{ $data->timestamp }}</td>
                <td>{{ $data->level }}</td>
                <td>{{ $data->unit }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No hay datos disponibles.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $historicalData->links() }}
@endsection
