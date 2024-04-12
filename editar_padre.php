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

// Consultar si existe un padre vinculado a la cuenta del usuario
$sql_padre = "SELECT ID_Padre FROM Padre WHERE ID_Cuenta = $id_cuenta";
$result_padre = $conn->query($sql_padre);

if ($result_padre->num_rows > 0) {
    // Si hay un padre vinculado, obtener su ID
    $row_padre = $result_padre->fetch_assoc();
    $id_padre = $row_padre['ID_Padre'];

    // Consulta para obtener los datos del padre a editar
    $sql = "SELECT * FROM Padre WHERE ID_Padre = $id_padre";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_padre = $row['Nombre'];
        $apellido1_padre = $row['Apellido1'];
        $apellido2_padre = $row['Apellido2'];
        $edad_padre = $row['Edad'];
        $numtel_padre = $row['NumTel'];
        $tutor_padre = $row['Tutor'];
    } else {
        echo "No se encontraron datos del padre.";
        exit();
    }
} else {
    echo "No hay padre vinculado a esta cuenta.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Padre</title>
</head>
<body>
    <h2>Editar Padre</h2>
    <form action="procesar_edicion_padre.php" method="POST">
        <input type="hidden" name="id_padre" value="<?php echo $id_padre; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre_padre; ?>"><br><br>

        <label for="apellido1">Apellido Paterno:</label>
        <input type="text" id="apellido1" name="apellido1" value="<?php echo $apellido1_padre; ?>"><br><br>

        <label for="apellido2">Apellido Materno:</label>
        <input type="text" id="apellido2" name="apellido2" value="<?php echo $apellido2_padre; ?>"><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="<?php echo $edad_padre; ?>"><br><br>

        <label for="numtel">Número de Teléfono:</label>
        <input type="text" id="numtel" name="numtel" value="<?php echo $numtel_padre; ?>"><br><br>

        <label for="tutor">Es Tutor:</label>
        <input type="checkbox" id="tutor" name="tutor" <?php if ($tutor_padre == 1) echo 'checked'; ?>><br><br>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
