<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Hijo</title>
</head>
<body>
    <h2>Agregar Hijo</h2>
    <form action="procesar_hijo.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido1">Apellido 1:</label>
        <input type="text" id="apellido1" name="apellido1" required><br><br>

        <label for="apellido2">Apellido 2:</label>
        <input type="text" id="apellido2" name="apellido2"><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>

        <label for="vinculo">Vínculo:</label>
        <!-- Autollenar con la URL específica -->
        <input type="text" id="vinculo" name="vinculo" value="server actual:Kidsafe(5)/<?php echo $_SESSION['id']; ?>/Datos.php" readonly><br><br>

        <label for="datos_niño">Datos del Niño:</label><br>
        <textarea id="datos_niño" name="datos_niño" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Agregar Hijo">
    </form>
</body>
</html>
