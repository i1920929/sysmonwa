@extends('layouts.layout')
@section('title', 'Histórico de Niveles de Agua')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Niveles de Agua</title>
</head>
<body>
    <div class="container-header">
        <h1 class="text-2xl font-bold mb-4">Histórico de Niveles de Agua</h1>
        <div class="flex justify-end mb-2">
            <form method="GET" action="{{ route('export.water.level.historical.xls') }}">
                <label for="start_date" class="mr-2">Desde:</label>
                <input type="date" name="start_date" required class="border px-2 py-1 rounded-md">
                <label for="end_date" class="mx-2">Hasta:</label>
                <input type="date" name="end_date" required class="border px-2 py-1 rounded-md">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 ml-4">Descargar Histórico en XLS</button>
            </form>
            <a href="{{ route('export.water.consumption') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-200 ml-4">Descargar CSV</a>
            <a href="{{ route('export.water.consumption.xls') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 ml-4">Descargar XLS</a>
        </div>
    </div>
    <div class="container-subheader">
        <h2 class="text-2xl font-bold mb-4">Niveles de Agua Históricos</h2>
    </div>
    <div class="container">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Timestamp</th>
                    <th class="border border-gray-300 px-4 py-2">Nivel (cm)</th>
                    <th class="border border-gray-300 px-4 py-2">Unidad</th>
                    <th class="border border-gray-300 px-4 py-2">ID Sensor</th>
                    <th class="border border-gray-300 px-4 py-2">ID Tanque</th>
                </tr>
            </thead>
            <tbody>
                @foreach($waterLevels as $level)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $level->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $level->timestamp }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $level->level }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $level->unit }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $level->sensor_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $level->tank_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection
