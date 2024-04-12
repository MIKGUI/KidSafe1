<?php
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

$id_cuenta = 8; // ID de la cuenta que quieres mostrar, en este caso, ID 1

// Obtener datos del padre
$sql_padre = "SELECT * FROM Padre WHERE ID_Cuenta = $id_cuenta";
$result_padre = $conn->query($sql_padre);

// Obtener datos de la madre
$sql_madre = "SELECT * FROM Madre WHERE ID_Cuenta = $id_cuenta";
$result_madre = $conn->query($sql_madre);

// Obtener datos del hijo
$sql_hijo = "SELECT * FROM Hijo WHERE ID_Cuenta = $id_cuenta";
$result_hijo = $conn->query($sql_hijo);

// Obtener datos del cuidador
$sql_cuidador = "SELECT * FROM Cuidador WHERE ID_Cuenta = $id_cuenta";
$result_cuidador = $conn->query($sql_cuidador);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Cuenta</title>
</head>
<body>
    <h2>Datos de la Cuenta</h2>

    <!-- Mostrar datos del padre -->
    <h3>Datos del Padre</h3>
    <?php if ($result_padre->num_rows > 0) : ?>
        <?php while ($row_padre = $result_padre->fetch_assoc()) : ?>
            <p>Nombre: <?php echo $row_padre['Nombre']; ?></p>
            <p>Apellido: <?php echo $row_padre['Apellido']; ?></p>
            <!-- Agregar más campos según la estructura de tu tabla -->
        <?php endwhile; ?>
    <?php else : ?>
        <p>No se encontraron datos del Padre.</p>
    <?php endif; ?>

    <!-- Mostrar datos de la madre -->
    <h3>Datos de la Madre</h3>
    <?php if ($result_madre->num_rows > 0) : ?>
        <?php while ($row_madre = $result_madre->fetch_assoc()) : ?>
            <p>Nombre: <?php echo $row_madre['Nombre']; ?></p>
            <p>Apellido: <?php echo $row_madre['Apellido']; ?></p>
            <!-- Agregar más campos según la estructura de tu tabla -->
        <?php endwhile; ?>
    <?php else : ?>
        <p>No se encontraron datos de la Madre.</p>
    <?php endif; ?>

    <!-- Mostrar datos del hijo -->
    <h3>Datos del Hijo</h3>
    <?php if ($result_hijo->num_rows > 0) : ?>
        <?php while ($row_hijo = $result_hijo->fetch_assoc()) : ?>
            <p>Nombre: <?php echo $row_hijo['Nombre']; ?></p>
            <p>Apellido: <?php echo $row_hijo['Apellido']; ?></p>
            <!-- Agregar más campos según la estructura de tu tabla -->
        <?php endwhile; ?>
    <?php else : ?>
        <p>No se encontraron datos del Hijo.</p>
    <?php endif; ?>

    <!-- Mostrar datos del cuidador -->
    <h3>Datos del Cuidador</h3>
    <?php if ($result_cuidador->num_rows > 0) : ?>
        <?php while ($row_cuidador = $result_cuidador->fetch_assoc()) : ?>
            <p>Nombre: <?php echo $row_cuidador['Nombre']; ?></p>
            <p>Apellido: <?php echo $row_cuidador['Apellido']; ?></p>
            <!-- Agregar más campos según la estructura de tu tabla -->
        <?php endwhile; ?>
    <?php else : ?>
        <p>No se encontraron datos del Cuidador.</p>
    <?php endif; ?>
</body>
</html>
