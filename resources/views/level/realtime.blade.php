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
        <h1 class="text-2xl font-bold mb-4">Dashboard de Gestión de Nivel de Agua</h1>
    </div>
    <div class="container-subheader">
        <h2 class="text-2xl font-bold mb-4">Nivel del Agua en Tiempo Real</h2>
    </div>
    <div class="container">
        <div class="chart-container tooltip">
            <div id="tank">
                <div id="water" style="height: 0%; background-color: rgb(231, 76, 60);"></div>
            </div>
            <div id="labels">
                <div class="indicator">
                    <h3>Nivel</h3>
                    <p class="label"><span id="levelCm">0</span> cm</p>
                    <p class="label"><span id="levelPercent">0</span>%</p>
                </div>
                <div class="indicator">
                    <h3>Estado</h3>
                    <p id="status" class="label">Bajo</p>
                </div>
            </div>
        </div>

        <style>
            #labels {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .indicator {
                flex: 1;
                text-align: center;
                background-color: #f8f8f8;
                padding: 10px;
                margin: 0 10px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            #tank {
                width: 200px;
                height: 300px;
                background-color: #e0e0e0;
                border: 2px solid #333;
                border-radius: 10px;
                margin: 20px auto;
                position: relative;
                overflow: hidden;
            }

            #water {
                width: 100%;
                position: absolute;
                bottom: 0;
                transition: height 0.5s ease-in-out;
            }
        </style>
    </div>

    <script>
        const tank = document.getElementById('water');
        const levelCm = document.getElementById('levelCm');
        const levelPercent = document.getElementById('levelPercent');
        const status = document.getElementById('status');

        const maxWaterLevel = 5.4; // cm (nivel máximo real)
        const sensorReadingAtMaxLevel = 6.72; // cm
        const sensorReadingAtMinLevel = 16.57; // cm

        async function updateTank() {
            try {
                const response = await fetch('/api/water-level/latest');
                const data = await response.json();

                // Medición del sensor
                const measuredLevel = parseFloat(data.level); // cm

                // Calcular el nivel real del agua
                const realWaterLevel = maxWaterLevel - ((sensorReadingAtMaxLevel - measuredLevel) * (maxWaterLevel / (sensorReadingAtMaxLevel - sensorReadingAtMinLevel)));

                // Limitar el nivel real a 0 y maxWaterLevel
                const clampedLevel = Math.max(0, Math.min(realWaterLevel, maxWaterLevel));
                const percentage = (clampedLevel / maxWaterLevel) * 100; // porcentaje de llenado

                // Actualizar la altura visual del agua
                tank.style.height = `${percentage}%`;

                // Actualizar color basado en el nivel de llenado
                if (percentage === 0) {
                    tank.style.backgroundColor = '#e74c3c'; // Rojo
                } else if (percentage < 25) {
                    tank.style.backgroundColor = '#f39c12'; // Naranja
                } else if (percentage < 75) {
                    tank.style.backgroundColor = '#f1c40f'; // Amarillo
                } else {
                    tank.style.backgroundColor = '#3498db'; // Azul
                }

                // Actualizar indicadores
                levelCm.textContent = clampedLevel.toFixed(2); // Mostrar nivel real en cm
                levelPercent.textContent = percentage.toFixed(2);

                // Actualizar el estado basado en el porcentaje
                if (percentage === 0) {
                    status.textContent = 'Vacío';
                } else if (percentage < 25) {
                    status.textContent = 'Bajo';
                } else if (percentage < 75) {
                    status.textContent = 'Normal';
                } else {
                    status.textContent = 'Lleno';
                }

            } catch (error) {
                console.error('Error al obtener los datos:', error);
            }

            setTimeout(updateTank, 2000); // Actualizar cada 2 segundos
        }

        updateTank(); // Ejecutar inmediatamente al cargar la página
    </script>
</body>
@endsection
