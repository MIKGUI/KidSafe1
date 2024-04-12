<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir si no ha iniciado sesión
    exit();
}

$nombre = $_SESSION['nombre']; // Obtener el nombre del usuario que ha iniciado sesión
$id_cuenta = $_SESSION['id']; // Obtener el ID de la cuenta del usuario

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

// Consultar si existe una madre vinculada a la cuenta del usuario
$sql_madre = "SELECT ID_Madre FROM Madre WHERE ID_Cuenta = $id_cuenta";
$result_madre = $conn->query($sql_madre);

if ($result_madre->num_rows > 0) {
    // Si hay una madre vinculada, obtener su ID
    $row_madre = $result_madre->fetch_assoc();
    $id_madre = $row_madre['ID_Madre'];

    // Consulta para obtener los datos de la madre a editar
    $sql = "SELECT * FROM Madre WHERE ID_Madre = $id_madre";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_madre = $row['Nombre'];
        $apellido1_madre = $row['Apellido1'];
        $apellido2_madre = $row['Apellido2'];
        $edad_madre = $row['Edad'];
        $numtel_madre = $row['NumTel'];
        $tutor_madre = $row['Tutor'];
    } else {
        echo "No se encontraron datos de la madre.";
        exit();
    }
} else {
    echo "No hay madre vinculada a esta cuenta.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Madre</title>
</head>
<body>
    <h2>Editar Madre</h2>
    <form action="procesar_edicion_madre.php" method="POST">
        <input type="hidden" name="id_madre" value="<?php echo $id_madre; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre_madre; ?>"><br><br>

        <label for="apellido1">Apellido Paterno:</label>
        <input type="text" id="apellido1" name="apellido1" value="<?php echo $apellido1_madre; ?>"><br><br>

        <label for="apellido2">Apellido Materno:</label>
        <input type="text" id="apellido2" name="apellido2" value="<?php echo $apellido2_madre; ?>"><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="<?php echo $edad_madre; ?>"><br><br>

        <label for="numtel">Número de Teléfono:</label>
        <input type="text" id="numtel" name="numtel" value="<?php echo $numtel_madre; ?>"><br><br>

        <label for="tutor">Es Tutor:</label>
        <input type="checkbox" id="tutor" name="tutor" <?php if ($tutor_madre == 1) echo 'checked'; ?>><br><br>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
