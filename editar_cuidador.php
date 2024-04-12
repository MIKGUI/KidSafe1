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

// Consultar los cuidadores vinculados a la cuenta del usuario
$sql_cuidadores = "SELECT * FROM Cuidador WHERE ID_Cuenta = $id_cuenta";
$result_cuidadores = $conn->query($sql_cuidadores);

if ($result_cuidadores->num_rows > 0) {
    // Si hay cuidadores vinculados, mostrar formulario para cada uno
    while ($row = $result_cuidadores->fetch_assoc()) {
        $id_cuidador = $row['ID_Cuidador'];
        $nombre_cuidador = $row['Nombre'];
        $apellido1_cuidador = $row['Apellido1'];
        $apellido2_cuidador = $row['Apellido2'];
        $edad_cuidador = $row['Edad'];
        $num_tel_cuidador = $row['NumTel'];
        $parentesco_cuidador = $row['Parentesco'];
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Editar Cuidador</title>
        </head>
        <body>
            <h2>Editar Cuidador</h2>
            <form action="procesar_edicion_cuidador.php" method="POST">
                <input type="hidden" name="id_cuidador" value="<?php echo $id_cuidador; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre_cuidador; ?>"><br><br>

                <label for="apellido1">Apellido Paterno:</label>
                <input type="text" id="apellido1" name="apellido1" value="<?php echo $apellido1_cuidador; ?>"><br><br>

                <label for="apellido2">Apellido Materno:</label>
                <input type="text" id="apellido2" name="apellido2" value="<?php echo $apellido2_cuidador; ?>"><br><br>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" value="<?php echo $edad_cuidador; ?>"><br><br>

                <label for="num_tel">Número de Teléfono:</label>
                <input type="text" id="num_tel" name="num_tel" value="<?php echo $num_tel_cuidador; ?>"><br><br>

                <label for="parentesco">Parentesco:</label>
                <input type="text" id="parentesco" name="parentesco" value="<?php echo $parentesco_cuidador; ?>"><br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
            <a href="./pagina_principal.php">volver</a>
        </body>
        </html>

        <?php
    }
} else {
    echo "No hay cuidadores vinculados a esta cuenta.";
}

$conn->close();
?>
