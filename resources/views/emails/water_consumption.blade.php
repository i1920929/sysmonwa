<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta Semanal de Consumo de Agua</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: auto;
        }
        .email-header {
            background-color: #0066cc;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
        }
        h1, h2 {
            margin: 0;
        }
        .consumption-summary {
            background-color: #f0f8ff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .consumption-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .alert {
            background-color: #ffe6e6;
            border-left: 5px solid #ff4d4d;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            background-color: #0066cc;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .chart-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Alerta Semanal de Consumo de Agua</h1>
        </div>
        <div class="email-body">
            <h2>Estimado/a Usuario/a,</h2>
            <p>Esperamos que este correo le encuentre bien. A continuación, le presentamos el resumen semanal del consumo de agua en su institución educativa:</p>
            
            <div class="consumption-summary">
                <h3>Resumen de Consumo</h3>
                <div class="consumption-detail">
                    <span>Consumo Total de la Semana:</span>
                    <strong>{{ $totalConsumptionThisWeek }} litros</strong>
                </div>
                <div class="consumption-detail">
                    <span>Promedio Diario:</span>
                    <strong>{{ $averageDailyConsumption }} litros</strong>
                </div>
                <div class="consumption-detail">
                    <span>Comparación con la Semana Anterior:</span>
                    <strong style="color: {{ $comparisonWithLastWeek > 0 ? '#ff4d4d' : '#00cc66' }};">
                        {{ $comparisonWithLastWeek > 0 ? '+' : '' }}{{ round($comparisonWithLastWeek, 2) }}%
                    </strong>
                </div>
            </div>
            
            @if ($elevatedConsumption)
            <div class="alert">
                <h3>⚠️ Alerta de Consumo Elevado</h3>
                <p>El consumo de esta semana ha superado el promedio habitual en un {{ round($comparisonWithLastWeek, 2) }}%. Le recomendamos revisar posibles fugas o implementar medidas de ahorro de agua.</p>
            </div>
            @endif

            <p>Para obtener más detalles sobre el consumo de agua y acceder a recomendaciones personalizadas, por favor visite nuestro portal de monitoreo:</p>
            <a href="https://www.alertaconsumoagua.edu/portal" class="btn">Acceder al Portal de Monitoreo</a>
            
            <p>Si tiene alguna pregunta o necesita asistencia, no dude en contactarnos.</p>
            <p>Atentamente,<br>El Equipo de Gestión de Recursos Hídricos</p>
        </div>
    </div>
</body>
</html>
