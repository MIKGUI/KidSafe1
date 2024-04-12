<?php
session_start();

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables están definidas y no son nulas
    if (isset($_POST['correo']) && isset($_POST['contraseña'])) {
        // Obtener los valores del formulario
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

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

        // Consultar si las credenciales son válidas
        $sql = "SELECT ID, Nombre FROM Cuenta WHERE Correo='$correo' AND Contraseña='$contraseña'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Inicio de sesión exitoso
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['ID']; // Almacenar el ID de la cuenta en la sesión
            $_SESSION['nombre'] = $row['Nombre']; // Almacenar el nombre del usuario en la sesión
            echo "Inicio de sesión exitoso. Redireccionando...";
            header("Location: pagina_principal.php"); // Redireccionar a la página principal
            exit();
        } else {
            echo "Correo o contraseña incorrectos";
        }

        $conn->close();
    } else {
        echo "Error: No se recibieron datos del formulario";
    }
} else {
    echo "Error: Método de solicitud incorrecto";
}
?>
