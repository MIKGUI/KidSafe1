<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir si no ha iniciado sesión
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_padre = $_POST['id_padre'];
    $nombre_padre = $_POST['nombre'];
    $apellido1_padre = $_POST['apellido1'];
    $apellido2_padre = $_POST['apellido2'];
    $edad_padre = $_POST['edad'];
    $numtel_padre = $_POST['numtel'];
    $tutor_padre = isset($_POST['tutor']) ? 1 : 0; // Si está marcado, asignar 1, sino 0

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

    // Actualizar datos del padre en la base de datos
    $sql = "UPDATE Padre SET Nombre='$nombre_padre', Apellido1='$apellido1_padre', Apellido2='$apellido2_padre', Edad=$edad_padre, NumTel='$numtel_padre', Tutor=$tutor_padre WHERE ID_Padre=$id_padre";

    if ($conn->query($sql) === TRUE) {
        header("Location: pagina_principal.php");
        echo "Datos del padre actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos del padre: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: No se recibieron datos del formulario.";
}
?>
