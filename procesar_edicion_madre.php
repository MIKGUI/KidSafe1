<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir si no ha iniciado sesión
    exit();
}

$id_cuenta = $_SESSION['id']; // Obtener el ID de la cuenta del usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['id_madre']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['edad']) && isset($_POST['numtel']) && isset($_POST['tutor'])) {
        // Obtener los valores del formulario
        $id_madre = $_POST['id_madre'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $edad = $_POST['edad'];
        $numtel = $_POST['numtel'];
        $tutor = $_POST['tutor'] ? 1 : 0; // Convertir el valor del checkbox a entero (1 o 0)

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

        // Actualizar los datos de la madre en la base de datos
        $sql = "UPDATE Madre SET Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Edad=$edad, NumTel='$numtel', Tutor=$tutor WHERE ID_Madre=$id_madre AND ID_Cuenta=$id_cuenta";

        if ($conn->query($sql) === TRUE) {
            header("Location: pagina_principal.php");
            echo "Datos de la madre actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la madre: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error: No se recibieron datos del formulario";
    }
} else {
    echo "Error: Método de solicitud incorrecto";
}
?>
