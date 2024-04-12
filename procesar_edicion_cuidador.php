<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir si no ha iniciado sesión
    exit();
}

$id_cuenta = $_SESSION['id']; // Obtener el ID de la cuenta del usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['id_cuidador']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['edad']) && isset($_POST['num_tel']) && isset($_POST['parentesco'])) {
        // Obtener los valores del formulario
        $id_cuidador = $_POST['id_cuidador'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $edad = $_POST['edad'];
        $num_tel = $_POST['num_tel'];
        $parentesco = $_POST['parentesco'];

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

        // Actualizar los datos del cuidador en la base de datos
        $sql = "UPDATE Cuidador SET Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Edad=$edad, NumTel='$num_tel', Parentesco='$parentesco' WHERE ID_Cuidador=$id_cuidador AND ID_Cuenta=$id_cuenta";

        if ($conn->query($sql) === TRUE) {
            header("Location: editar_cuidador.php");
            echo "Datos del cuidador actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del cuidador: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error: No se recibieron datos del formulario";
    }
} else {
    echo "Error: Método de solicitud incorrecto";
}
?>
