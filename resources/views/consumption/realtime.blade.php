@extends('layouts.layout')
@section('title', 'Inicio')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo de Agua en Tiempo Real</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<body>
    <div class="container-header">
        <h1 class="text-2xl font-bold mb-4">Dashboard de Gestión de Consumo de agua</h1>
    </div>
    <div class="container-subheader">
        <h2 class="text-2xl font-bold mb-4">Consumo del agua en tiempo real</h2>
    </div>
    <div class="container">
        <div class="chart-container tooltip">
        <div class="labels">
            <span id="currentRate" class="label">20 L/min</span>
            <span id="todayTotal" class="label">20 Litros hoy</span>
        </div>
            <canvas id="realTimeChart" width="2320" height="1160" style="display: block; box-sizing: border-box; height: 580px; width: 1160px;"></canvas>
        </div>
    </div>

    <script>
        let realTimeChart;

        // Función para obtener datos desde la API
        async function fetchData(apiUrl) {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }
                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                return [];
            }
        }

        // Función para ordenar los datos por timestamp de forma ascendente
        function sortDataByTimestamp(data) {
            return data.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));
        }

        // Configurar y crear el gráfico de consumo en tiempo real
        function createRealTimeChart(labels, data) {
            const realTimeCtx = document.getElementById('realTimeChart').getContext('2d');
            realTimeChart = new Chart(realTimeCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Consumo de Agua (Litros)',
                        data: data,
                        borderColor: '#0066cc',
                        tension: 0.1,
                        fill: false,
                        pointRadius: 4, // Ajustar tamaño de los puntos
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: true,
                            mode: 'index',
                            intersect: true,
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `Consumo: ${tooltipItem.parsed.y.toFixed(2)} Litros`;

                                },
                                title: function(tooltipItem) {
                                    return `Hora: ${tooltipItem[0].label}`;
                                },
                            },
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Litros',
                            },
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Hora',
                            },
                        },
                    },
                },
            });
        }

        // Actualizar datos del gráfico en tiempo real
        function updateRealTimeChart(labels, data) {
            realTimeChart.data.labels = labels;
            realTimeChart.data.datasets[0].data = data;
            realTimeChart.update();
        }

        // Cargar y actualizar los gráficos cada 2 segundos
        async function loadAndUpdateChart() {
    let realTimeData = await fetchData('http://localhost:8000/api/water-consumption');

    // Ordenar los datos por timestamp de forma ascendente
    realTimeData = sortDataByTimestamp(realTimeData);

    const realTimeLabels = realTimeData.map(item => moment(item.timestamp).format('HH:mm:ss'));
    const realTimeVolumes = realTimeData.map(item => item.consumption_volume);
    
    // Calcular el consumo total del día
    const totalToday = realTimeData.reduce((acc, item) => item.consumption_volume, 0);
    // Obtener el último valor de volumen y calcular la tasa (por ejemplo, por minuto)
    const currentRate = realTimeData.reduce((acc, item) => item.flow_rate, 0);

    // Asegurarse de que currentRate y totalToday son números
    const formattedCurrentRate = parseFloat(currentRate).toFixed(2);
    const formattedTotalToday = parseFloat(totalToday).toFixed(2);

    // Actualizar las etiquetas con los nuevos valores, limitando a 2 decimales
    document.getElementById('currentRate').textContent = `${formattedCurrentRate} L/min`;
    document.getElementById('todayTotal').textContent = `${formattedTotalToday} Litros hoy`;

    if (!realTimeChart) {
        createRealTimeChart(realTimeLabels, realTimeVolumes);
    } else {
        updateRealTimeChart(realTimeLabels, realTimeVolumes);
    }
}

        // Cargar las gráficas al cargar la página
        loadAndUpdateChart();

        // Actualizar los gráficos cada 2 segundos
        setInterval(loadAndUpdateChart, 2000);

    </script>
</body>
@endsection
