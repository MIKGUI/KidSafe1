<?php
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

  // Recibir datos del formulario
$nombre = $_POST['nombre']; $correo = $_POST['correo']; $contraseña = $_POST['contraseña'];
$confirmar_contraseña = $_POST['confirmar_contraseña'];

  // Verificar si el correo ya está registrado
  $sql_verificar = "SELECT * FROM Cuenta WHERE Correo='$correo'";
$resultado_verificar = $conn->query($sql_verificar);

if ($resultado_verificar->num_rows > 0) {
    header("Location: registro.html");
    echo '<script>alert("El correo electrónico ya está registrado");</script>';

} else {
      // Verificar si las contraseñas coinciden
    if ($contraseña != $confirmar_contraseña) {
        echo "Las contraseñas no coinciden";
    } else {
        // Insertar datos en la tabla Cuenta
        $sql_insertar = "INSERT INTO Cuenta (Nombre, Correo, Contraseña) VALUES ('$nombre', '$correo', '$contraseña')";

        if ($conn->query($sql_insertar) === TRUE) {
            echo "Registro exitoso";
            header("Location: login.html");
        } else {
            echo "Error: " . $sql_insertar . "<br>" . $conn->error;
    }
}
}

$conn->close();
?>
