<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código QR con Javascript</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <form action="" id="formulario" class="formulario">
            <input type="text" id="link" placeholder="Escribe el texto o URL">
            <button type="submit" class="btn">Generar QR</button>
        </form>

        <div id="contenedorQR" class="contenedorQR"></div>
    </div>

    <script>
        const id = <?php echo $_SESSION['id']; ?>; // Obtener el ID de la sesión PHP
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
