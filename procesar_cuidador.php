<?php
session_start();

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables están definidas y no son nulas
    if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['edad']) && isset($_POST['num_tel']) && isset($_POST['parentesco'])) {
        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : null;
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

        // Insertar datos del cuidador en la tabla Cuidador
        $sql = "INSERT INTO Cuidador (ID_Cuenta, Nombre, Apellido1, Apellido2, Edad, NumTel, Parentesco)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Obtener el ID de la cuenta del usuario actual desde la sesión
        $id_cuenta = $_SESSION['id'];

        $stmt->bind_param("isssiss", $id_cuenta, $nombre, $apellido1, $apellido2, $edad, $num_tel, $parentesco);
        $stmt->execute();

        echo "Cuidador agregado correctamente.";
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
