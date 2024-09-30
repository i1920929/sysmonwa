<?php
$servername = "mysql-developysa.alwaysdata.net";
$username = "375112_sysmonwa";
$password = "icyeraldsa2502";
$dbname = "developysa_sysmonwa";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer la zona horaria a Perú (America/Lima)
date_default_timezone_set('America/Lima');

// Obtener la fecha y hora actual en formato correcto (para timestamp)
$current_timestamp = date('Y-m-d H:i:s');

// Obtiene los datos del POST
$consumption_volume = $_POST["consumption_volume"];
$sensor_id = $_POST["sensor_id"];
$tank_id = $_POST["tank_id"];
$client_id = $_POST["client_id"];
$flow_rate = $_POST["flow_rate"]; // Nuevo campo

// Valida los datos
if (!is_numeric($consumption_volume) || $consumption_volume <= 0) {
    die("Error: el volumen de consumo debe ser un número positivo.");
}

if (!is_numeric($flow_rate) || $flow_rate < 0) { // Validar flow rate
    die("Error: el caudal debe ser un número no negativo.");
}

if (empty($client_id)) {
    die("Error: el ID del cliente no puede estar vacío.");
}

// Inserta los datos en la base de datos utilizando prepared statements
$stmt = $conn->prepare("INSERT INTO water_consumption (timestamp, consumption_volume, unit, sensor_id, tank_id, client_id, flow_rate, created_at) VALUES (?, ?, 'litros', ?, ?, ?, ?, ?)");
$stmt->bind_param("sdiiids", $current_timestamp, $consumption_volume, $sensor_id, $tank_id, $client_id, $flow_rate, $current_timestamp);

if ($stmt->execute()) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar datos: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>
