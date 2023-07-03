<?php
session_start();

// Procesar datos del formulario de pago
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $numeroTarjeta = $_POST['numeroTarjeta'];
    $fechaVencimiento = $_POST['fechaVencimiento'];
    $codigoSeguridad = $_POST['codigoSeguridad'];
    $cantidadPagar = $_POST['cantidadPagar'];

    // Verificar si la conexión a la base de datos existe en $_SESSION
    if (isset($_SESSION['conn'])) {
        $conn = $_SESSION['conn'];

        // Insertar los datos en la tabla de la base de datos
        $query = "INSERT INTO tabla_pagos (nombre, direccion, correo, numero_tarjeta, fecha_vencimiento, codigo_seguridad, cantidad_pagar)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$nombre, $direccion, $correo, $numeroTarjeta, $fechaVencimiento, $codigoSeguridad, $cantidadPagar]);

        echo "Datos del pago almacenados correctamente en la base de datos.";
    } else {
        echo "No se encontró la conexión a la base de datos en la sesión.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Pago</title>
</head>
<body>
    <h1>Formulario de Pago</h1>
    <form method="POST" action="">
        <!-- Campos del formulario -->
        <input type="submit" value="Enviar Pago">
    </form>
</body>
</html>
