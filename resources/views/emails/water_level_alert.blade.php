<!DOCTYPE html>
<html>
<head>
    <title>Alerta de Nivel de Agua</title>
</head>
<body>
    <h1>Alerta de Nivel de Agua</h1>

    <p>Estimado usuario,</p>

    @if ($alertType === 'high')
        <p>El nivel del agua está por alcanzar los 17 cm. El nivel actual es: <strong>{{ $waterLevel }} cm</strong>.</p>
        <p>Por favor, tome las medidas necesarias.</p>
    @elseif ($alertType === 'low')
        <p>El nivel del agua está muy bajo. El nivel actual es: <strong>{{ $waterLevel }} cm</strong>.</p>
        <p>Por favor, considere rellenarlo pronto.</p>
    @endif

    <p>Saludos,</p>
    <p>El equipo de monitoreo.</p>
</body>
</html>