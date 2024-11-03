@extends('layouts.layout')

@section('title', 'Datos Históricos del Nivel de Agua')

@section('content')
<div>
    <div class="bg-blue-500 rounded-lg p-4 mb-4">
        <h1 class="text-white text-lg font-bold">Gráfico de Datos Históricos del Nivel de Agua</h1>
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

    <canvas id="historicalChart" class="mb-6"></canvas>
</div>

<div>
    <div class="bg-blue-500 rounded-lg p-4 mb-4">
        <h1 class="text-white text-lg font-bold">Tabla de Datos Históricos del Nivel de Agua</h1>
    </div>

    <div class="flex justify-end mb-2">
        <a href="{{ route('export.water.level') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-200" download>
            Descargar CSV
        </a>
        <a href="{{ route('export.water.level.xls') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 ml-4" download>
            Descargar XLS
        </a>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#C4C4C4] table-header">
            <tr>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel (cm)</th>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Porcentaje (%)</th>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sensor ID</th>
                <th class="border border-gray-300 px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tank ID</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($historicalData as $data)
                @php
                    // Definir altura máxima del sensor y altura máxima del tanque
                    $maxSensorHeight = 17.67; // El tanque está vacío a 17.67 cm
                    $maxHeight = 7; // Altura máxima del tanque en cm

                    // Calcular el nivel real del agua (en cm), invirtiendo la lógica del sensor
                    $nivelCm = $maxSensorHeight - $data->level;

                    // Calcular el porcentaje (max 100%)
                    $porcentaje = ($nivelCm / $maxHeight) * 100; // Porcentaje de llenado
                    if ($porcentaje > 100) $porcentaje = 100; // Limitar a 100%

                    // Determinar estado
                    $estado = '';
                    if ($nivelCm <= 0) {
                        $estado = 'Vacio';
                    } elseif ($nivelCm > 0 && $nivelCm <= 2) {
                        $estado = 'Casi Vacio';
                    } elseif ($nivelCm > 2 && $nivelCm <= 4) {
                        $estado = 'Medio Lleno';
                    } elseif ($nivelCm > 4 && $nivelCm <= 5) {
                        $estado = 'Casi Lleno';
                    } else {
                        $estado = 'Lleno';
                    }
                @endphp
                <tr>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ $data->id }}</td>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ $data->timestamp }}</td>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ round($nivelCm, 2) }} cm</td>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ round($porcentaje, 2) }}%</td>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ $estado }}</td>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ $data->sensor_id }}</td>
                    <td class="border border-gray-300 px-2 py-1 whitespace-nowrap">{{ $data->tank_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $historicalData->links() }} <!-- Para la paginación -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const historicalCtx = document.getElementById('historicalChart').getContext('2d');
    const historicalChart = new Chart(historicalCtx, {
        type: 'line',
        data: {
            labels: [
                @foreach($historicalData as $data)
                    '{{ $data->timestamp }}',
                @endforeach
            ],
            datasets: [{
                label: 'Nivel Máximo (cm)',
                data: [
                    @foreach($historicalData as $data)
                        {{ round($maxSensorHeight - $data->level, 2) }},
                    @endforeach
                ],
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 7, // Limitar el eje Y a la altura máxima del tanque
                    title: {
                        display: true,
                        text: 'Nivel Máximo (cm)'
                    }
                }
            }
        }
    });
</script>
@endsection
