@extends('layouts.layout')
@section('title', 'Inicio')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo de Agua en Tiempo Real</title>
</head>
<body>
    <div class="container-header">
        <h1 class="text-2xl font-bold mb-4">Dashboard de Gestión de Consumo de agua</h1>
    </div>
    <div class="container-subheader">
        <h2 class="text-2xl font-bold mb-4">Gráfico Histórico de consumo de agua</h2>
    </div>
    <form id="historicalDataForm" method="GET" action="{{ route('historical.data') }}" class="mb-4">
    <div class="flex-container">
        <div class="form-field">
            <label for="start_date" class="block text-sm font-medium text-gray-700">De:</label>
            <input type="date" name="start_date" id="start_date" class="input-date">
        </div>
        <div class="form-field">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Hasta:</label>
            <input type="date" name="end_date" id="end_date" class="input-date">
        </div>
        <div class="form-field">
            <button type="submit" class="filter-button">Filtrar</button>
        </div>
    </div>
</form>



    <div id="app">
        <daily-consumption-chart></daily-consumption-chart>
    </div>
    <div class="container-subheader2">
        <h2 class="text-2xl font-bold mb-4">Tabla Histórico de consumo de agua</h2>
    </div>
    <div class="flex justify-end mb-2">
    <a href="{{ route('export.water.consumption') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-200" download>
        Descargar CSV
    </a>
    <a href="{{ route('export.water.consumption.xls') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 ml-4" download>
        Descargar XLS
    </a>
</div>

    <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-[#C4C4C4] table-header">
        <tr>
            <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
            <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consumo</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($historicalData as $data)
            <tr>
                <td class="px-2 py-1 whitespace-nowrap">{{ $data->created_at }}</td>
                <td class="px-2 py-1 whitespace-nowrap">{{ $data->consumption_volume }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center px-2 py-1">No hay datos disponibles.</td>
            </tr>
        @endforelse
    </tbody>
</table>

    {{ $historicalData->links() }}

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
@endsection