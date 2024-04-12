<?php
session_start();

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables están definidas y no son nulas
    if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['edad']) && isset($_POST['num_tel'])) {
        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : null;
        $edad = $_POST['edad'];
        $num_tel = $_POST['num_tel'];
        $tutor = isset($_POST['tutor']) ? 1 : 0; // Convertir checkbox a valor booleano

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

        // Insertar datos de la madre en la tabla Madre
        $sql = "INSERT INTO Madre (ID_Cuenta, Nombre, Apellido1, Apellido2, Edad, NumTel, Tutor)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Obtener el ID de la cuenta del usuario actual desde la sesión
        $id_cuenta = $_SESSION['id'];

        $stmt->bind_param("issssis", $id_cuenta, $nombre, $apellido1, $apellido2, $edad, $num_tel, $tutor);
        $stmt->execute();

        echo "Madre agregada correctamente.";
        header("Location: pagina_principal.php");

        $stmt->close();
        $conn->close();
    } else {
        echo "Error: No se recibieron datos del formulario";
    }
} else {
    echo "Error: Método de solicitud incorrecto";
}
?>
