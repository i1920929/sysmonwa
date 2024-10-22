@extends('layouts.layout')
@section('title', 'Nivel de Agua en Tiempo Real')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel de Agua en Tiempo Real</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<body>
    <div class="container-header">
        <h1 class="text-2xl font-bold mb-4">Dashboard de Gestión de Nivel de Agua</h1>
    </div>
    <div class="container-subheader">
        <h2 class="text-2xl font-bold mb-4">Nivel de Agua en Tiempo Real</h2>
    </div>
    <div class="container">
        <div class="chart-container tooltip">
            <div class="labels">
                <span id="currentLevel" class="label">0 cm</span>
                <span id="todayAvgLevel" class="label">Promedio hoy: 0 cm</span>
            </div>
            <canvas id="realTimeLevelChart" width="2320" height="1160" style="display: block; box-sizing: border-box; height: 580px; width: 1160px;"></canvas>
        </div>
    </div>

    <script>
        let realTimeLevelChart;

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

        // Configurar y crear el gráfico de nivel en tiempo real
        function createRealTimeLevelChart(labels, data) {
            const realTimeLevelCtx = document.getElementById('realTimeLevelChart').getContext('2d');
            realTimeLevelChart = new Chart(realTimeLevelCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nivel de Agua (cm)',
                        data: data,
                        borderColor: '#ff5733',
                        tension: 0.1,
                        fill: false,
                        pointRadius: 4,
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
                                    return `Nivel: ${tooltipItem.parsed.y.toFixed(2)} cm`;
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
                                text: 'cm',
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
        function updateRealTimeLevelChart(labels, data) {
            realTimeLevelChart.data.labels = labels;
            realTimeLevelChart.data.datasets[0].data = data;
            realTimeLevelChart.update();
        }

        // Cargar y actualizar los gráficos cada 2 segundos
        async function loadAndUpdateLevelChart() {
            let realTimeLevelData = await fetchData('http://localhost:8000/api/water-level');

            // Ordenar los datos por timestamp de forma ascendente
            realTimeLevelData.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));

            const realTimeLevelLabels = realTimeLevelData.map(item => moment(item.timestamp).format('HH:mm:ss'));
            const realTimeLevelValues = realTimeLevelData.map(item => item.level);
            
            // Calcular el nivel promedio del día
            const totalToday = realTimeLevelData.reduce((acc, item) => acc + item.level, 0);
            const avgToday = totalToday / (realTimeLevelData.length || 1);

            // Actualizar las etiquetas con los nuevos valores
            document.getElementById('currentLevel').textContent = `${realTimeLevelValues[realTimeLevelValues.length - 1] || 0} cm`;
            document.getElementById('todayAvgLevel').textContent = `Promedio hoy: ${avgToday.toFixed(2)} cm`;

            if (!realTimeLevelChart) {
                createRealTimeLevelChart(realTimeLevelLabels, realTimeLevelValues);
            } else {
                updateRealTimeLevelChart(realTimeLevelLabels, realTimeLevelValues);
            }
        }

        // Cargar las gráficas al cargar la página
        loadAndUpdateLevelChart();

        // Actualizar los gráficos cada 2 segundos
        setInterval(loadAndUpdateLevelChart, 2000);
    </script>
</body>
@endsection

