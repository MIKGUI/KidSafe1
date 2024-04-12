<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir si no ha iniciado sesión
    exit();
}

$nombre = $_SESSION['nombre']; // Obtener el nombre del usuario que ha iniciado sesión
$id = $_SESSION['id']; // Obtener el ID de la cuenta del usuario

// Conexión a la base de datos
$servername = "localhost";
$username = "migui";
$password = "locote123";
$dbname = "SafeKid";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si ya existen registros de padre o madre para el usuario actual
$sql_padre = "SELECT * FROM Padre WHERE ID_Cuenta = $id";
$result_padre = $conn->query($sql_padre);

$sql_madre = "SELECT * FROM Madre WHERE ID_Cuenta = $id";
$result_madre = $conn->query($sql_madre);

// Verificar si ya existen registros de cuidador para el usuario actual
$sql_cuidador = "SELECT * FROM Cuidador WHERE ID_Cuenta = $id";
$result_cuidador = $conn->query($sql_cuidador);

// Verificar si ya existen registros de hijo para el usuario actual
$sql_hijo = "SELECT * FROM Hijo WHERE ID_Cuenta = $id";
$result_hijo = $conn->query($sql_hijo);


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
</head>
<body>
    <h2>Bienvenido <?php echo $nombre; ?></h2>

    <!-- Mostrar enlace "Agregar" o "Editar" dependiendo de la existencia de registros -->
    <?php if ($result_padre->num_rows > 0) : ?>
        <a href="editar_padre.php">Editar Padre</a><br>
    <?php else : ?>
        <a href="agregar_padre.php">Agregar Padre</a><br>
    <?php endif; ?>

    <?php if ($result_madre->num_rows > 0) : ?>
        <a href="editar_madre.php">Editar Madre</a><br>
    <?php else : ?>
        <a href="agregar_madre.php">Agregar Madre</a><br>
    <?php endif; ?>

    <!-- Enlace "Agregar" para Cuidador -->
    <a href="agregar_cuidador.php">Agregar Cuidador</a><br>

    <!-- Enlace "Editar" para Cuidador si hay datos -->
    <?php if ($result_cuidador->num_rows > 0) : ?>
        <a href="editar_cuidador.php">Editar Cuidador</a><br>
    <?php endif; ?>

    <!-- Enlace "Agregar" para Hijo -->
    <a href="agregar_hijo.php">Agregar Hijo</a><br>

    <!-- Enlace "Editar" para Hijo si hay datos -->
    <?php if ($result_hijo->num_rows > 0) : ?>
        <a href="editar_hijo.php">Editar Hijo</a><br>
    <?php endif; ?>
    <a href="./Qr.php">Crear Qr</a><br>

    <a href="logout.php">Cerrar Sesión</a><br>
</body>
</html>
