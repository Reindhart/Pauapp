<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION['usuario_nombre'];
$apellidos = $_SESSION['usuario_apellidos'];
$usuario = "$nombre $apellidos";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="aesthetic.css">
        <link rel="stylesheet" href="bienvenido.css">
        <script src="bienvenido.js"></script>
    </head>
    <body>

        <div id="pantalla-bienvenida">
            Bienvenido <?= htmlspecialchars($usuario) ?>
        </div>

        <div id="escritorio" class="visible aesthetic-arizona-blue-bg-color">
            <div class="iconos">
                <div class="icono" onclick="location.href='empleados_lista.php'">
                    <img src="user_card.png" alt="Empleados">
                    <div>Empleados</div>
                </div>

                <div class="icono" onclick="location.href='empleados_alta.php'">
                    <img src="user_computer-1.png" alt="Alta">
                    <div>Alta Empleado</div>
                </div>

                <div class="icono" onclick="location.href='empleados_detalle.php?id=<?= $_SESSION['usuario_id'] ?>'">
                    <img src="file_eye.png" alt="Alta">
                    <div>Detalle de Empleado</div>
                </div>

                <div class="icono" onclick="cerrarSesion()">
                    <img src="directx_alt-0.png" alt="Logout">
                    <div>Salir</div>
                </div>
                <form id="logout-form" action="logout.php" method="POST" style="display: none;"></form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
