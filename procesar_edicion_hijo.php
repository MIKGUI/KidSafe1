<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir si no ha iniciado sesión
    exit();
}

$id_cuenta = $_SESSION['id']; // Obtener el ID de la cuenta del usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['id_hijo']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['edad']) && isset($_POST['datos'])) {
        // Obtener los valores del formulario
        $id_hijo = $_POST['id_hijo'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $edad = $_POST['edad'];
        $datos = $_POST['datos'];

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

        // Actualizar los datos del hijo en la base de datos
        $sql = "UPDATE Hijo SET Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Edad=$edad, Datos_del_Niño='$datos' WHERE ID_Hijo=$id_hijo AND ID_Cuenta=$id_cuenta";

        if ($conn->query($sql) === TRUE) {
            header("Location: editar_hijo.php");
            echo "Datos del hijo actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del hijo: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error: No se recibieron datos del formulario";
    }
} else {
    echo "Error: Método de solicitud incorrecto";
}
?>
