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

// Consultar los hijos vinculados a la cuenta del usuario
$sql_hijos = "SELECT * FROM Hijo WHERE ID_Cuenta = $id_cuenta";
$result_hijos = $conn->query($sql_hijos);

if ($result_hijos->num_rows > 0) {
    // Si hay hijos vinculados, mostrar formulario para cada uno
    while ($row = $result_hijos->fetch_assoc()) {
        $id_hijo = $row['ID_Hijo'];
        $nombre_hijo = $row['Nombre'];
        $apellido1_hijo = $row['Apellido1'];
        $apellido2_hijo = $row['Apellido2'];
        $edad_hijo = $row['Edad'];
        $datos_hijo = $row['Datos_del_Niño'];
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Editar Hijo</title>
        </head>
        <body>
            <h2>Editar Hijo</h2>
            <form action="procesar_edicion_hijo.php" method="POST">
                <input type="hidden" name="id_hijo" value="<?php echo $id_hijo; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre_hijo; ?>"><br><br>

                <label for="apellido1">Apellido Paterno:</label>
                <input type="text" id="apellido1" name="apellido1" value="<?php echo $apellido1_hijo; ?>"><br><br>

                <label for="apellido2">Apellido Materno:</label>
                <input type="text" id="apellido2" name="apellido2" value="<?php echo $apellido2_hijo; ?>"><br><br>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" value="<?php echo $edad_hijo; ?>"><br><br>

                <label for="datos">Datos del Niño:</label>
                <textarea id="datos" name="datos"><?php echo $datos_hijo; ?></textarea><br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
            <a href="./pagina_principal.php">volver</a>
        </body>
        </html>

        <?php
    }
} else {
    echo "No hay hijos vinculados a esta cuenta.";
}

$conn->close();
?>
