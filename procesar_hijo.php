<?php
session_start();

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables están definidas y no son nulas
    if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['edad']) && isset($_POST['vinculo']) && isset($_POST['datos_niño'])) {
        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : null;
        $edad = $_POST['edad'];
        $vinculo = $_POST['vinculo'];
        $datos_niño = $_POST['datos_niño'];

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

        // Insertar datos del hijo en la tabla Hijo
        $sql = "INSERT INTO Hijo (ID_Cuenta, Nombre, Apellido1, Apellido2, Edad, Vinculo, Datos_del_Niño)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Obtener el ID de la cuenta del usuario actual desde la sesión
        $id_cuenta = $_SESSION['id'];

        $stmt->bind_param("isssiss", $id_cuenta, $nombre, $apellido1, $apellido2, $edad, $vinculo, $datos_niño);
        $stmt->execute();

        echo "Hijo agregado correctamente.";
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
