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

// Obtener datos de la cuenta con ID 1
$id_cuenta = 3; // ID de la cuenta que deseas mostrar

// Consulta SQL para obtener datos de la cuenta
$sql_cuenta = "SELECT * FROM Cuenta WHERE ID = $id_cuenta";
$result_cuenta = $conn->query($sql_cuenta);

// Verificar si se encontraron datos de la cuenta
if ($result_cuenta->num_rows > 0) {
    // Mostrar datos de la cuenta
    $row_cuenta = $result_cuenta->fetch_assoc();
    echo "Datos de la Cuenta<br>";
    echo "Nombre: " . $row_cuenta['Nombre'] . "<br>";
    echo "Correo: " . $row_cuenta['Correo'] . "<br>";

    // Consulta SQL para obtener datos del padre
    $sql_padre = "SELECT * FROM Padre WHERE ID_Cuenta = $id_cuenta";
    $result_padre = $conn->query($sql_padre);

    // Verificar si se encontraron datos del padre
    if ($result_padre->num_rows > 0) {
        $row_padre = $result_padre->fetch_assoc();
        echo "<br>Datos del Padre<br>";
        echo "Nombre: " . $row_padre['Nombre'] . "<br>";
        echo "Apellido1: " . $row_padre['Apellido1'] . "<br>";
        echo "Apellido2: " . $row_padre['Apellido2'] . "<br>";
        echo "Edad: " . $row_padre['Edad'] . "<br>";
        echo "NumTel: " . $row_padre['NumTel'] . "<br>";
        echo "Tutor: " . ($row_padre['Tutor'] ? 'Sí' : 'No') . "<br>";
    } else {
        echo "<br>No se encontraron datos del Padre.<br>";
    }

    // Consulta SQL para obtener datos de la madre
    $sql_madre = "SELECT * FROM Madre WHERE ID_Cuenta = $id_cuenta";
    $result_madre = $conn->query($sql_madre);

    // Verificar si se encontraron datos de la madre
    if ($result_madre->num_rows > 0) {
        $row_madre = $result_madre->fetch_assoc();
        echo "<br>Datos de la Madre<br>";
        echo "Nombre: " . $row_madre['Nombre'] . "<br>";
        echo "Apellido1: " . $row_madre['Apellido1'] . "<br>";
        echo "Apellido2: " . $row_madre['Apellido2'] . "<br>";
        echo "Edad: " . $row_madre['Edad'] . "<br>";
        echo "NumTel: " . $row_madre['NumTel'] . "<br>";
        echo "Tutor: " . ($row_madre['Tutor'] ? 'Sí' : 'No') . "<br>";
    } else {
        echo "<br>No se encontraron datos de la Madre.<br>";
    }

    // Consulta SQL para obtener datos del hijo
    $sql_hijo = "SELECT * FROM Hijo WHERE ID_Cuenta = $id_cuenta";
    $result_hijo = $conn->query($sql_hijo);

    // Verificar si se encontraron datos del hijo
    if ($result_hijo->num_rows > 0) {
        while ($row_hijo = $result_hijo->fetch_assoc()) {
            echo "<br>Datos del Hijo<br>";
            echo "Nombre: " . $row_hijo['Nombre'] . "<br>";
            echo "Apellido1: " . $row_hijo['Apellido1'] . "<br>";
            echo "Apellido2: " . $row_hijo['Apellido2'] . "<br>";
            echo "Edad: " . $row_hijo['Edad'] . "<br>";
         
            echo "Datos del Niño: " . $row_hijo['Datos_del_Niño'] . "<br>";
        }
    } else {
        echo "<br>No se encontraron datos del Hijo.<br>";
    }

    // Consulta SQL para obtener datos del cuidador
    $sql_cuidador = "SELECT * FROM Cuidador WHERE ID_Cuenta = $id_cuenta";
    $result_cuidador = $conn->query($sql_cuidador);

    // Verificar si se encontraron datos del cuidador
    if ($result_cuidador->num_rows > 0) {
        while ($row_cuidador = $result_cuidador->fetch_assoc()) {
            echo "<br>Datos del Cuidador<br>";
            echo "Nombre: " . $row_cuidador['Nombre'] . "<br>";
            echo "Apellido1: " . $row_cuidador['Apellido1'] . "<br>";
            echo "Apellido2: " . $row_cuidador['Apellido2'] . "<br>";
            echo "Edad: " . $row_cuidador['Edad'] . "<br>";
            echo "NumTel: " . $row_cuidador['NumTel'] . "<br>";
            echo "Parentesco: " . $row_cuidador['Parentesco'] . "<br>";
        }
    } else {
        echo "<br>No se encontraron datos del Cuidador.<br>";
    }
} else {
    echo "No se encontraron datos de la Cuenta.";
}

// Cerrar conexión
$conn->close();
?>