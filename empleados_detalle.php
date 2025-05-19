<?php
if (!isset($_GET['id'])) {
    header('Location: empleados_lista.php');
    exit;
}

$conn = new mysqli("localhost", "root", "", "pauapp");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM empleados WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Empleado no encontrado.";
    exit;
}

$empleado = $result->fetch_assoc();
$nombre_completo = $empleado['nombre'] . ' ' . $empleado['apellidos'];
$correo = $empleado['correo'];
$rol = $empleado['rol'] == 1 ? 'Gerente' : 'Ejecutivo';
$status = $empleado['eliminado'] == 0 ? 'Activo' : 'Inactivo';
$class = $empleado['eliminado'] == 0 ? "aesthetic-pepsi-blue" : "aesthetic-pepsi-red";
$foto_archivo = isset($empleado['archivo_file']) ? $empleado['archivo_file'] : null;


if (empty($foto_archivo)) {
    $ruta_imagen = "no2-0.png";
} else {
    $ruta_default = "uploads/defaults/" . $foto_archivo;
    $ruta_personal = "uploads/" . $foto_archivo;

    if (file_exists($ruta_default)) {
        $ruta_imagen = $ruta_default;
    }
    elseif (file_exists($ruta_personal)) {
        $ruta_imagen = $ruta_personal;
    }
    else {
        $ruta_imagen = "no2-0.png";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Detalle de Empleado</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="aesthetic.css">
        <link rel="stylesheet" href="detalles.css">
    </head>
    <body class="aesthetic-font detalles-container">
        <div class="aesthetic-windows-95-modal detalle-modal">
            <div class="aesthetic-windows-95-modal-title-bar">
                <div class="aesthetic-windows-95-modal-title-bar-text">
                    <h2>Detalle del empleado</h2>
                </div>
            </div>
            <div class="aesthetic-windows-95-modal-content">
                <div class="detalle-fila"><span class="detalle-label">Nombre:</span> <span class="detalle-valor"><?= $nombre_completo ?></span></div>
                <div class="detalle-fila"><span class="detalle-label">Correo:</span> <span class="detalle-valor"><?= $correo ?></span></div>
                <div class="detalle-fila"><span class="detalle-label">Rol:</span> <span class="detalle-valor"><?= $rol ?></span></div>
                <div class="detalle-fila"><span class="detalle-label">Status:</span> <span class="<?= $class ?>-color"><?= $status ?></span></div>
                <div class="detalle-fila">
                    <span class="detalle-label">Foto:</span><br>
                    <img src="<?= $ruta_imagen ?>" alt="Foto del empleado" width="120" style="border: 1px solid #000; padding: 5px;">
                </div>
                <a href="empleados_lista.php" class="aesthetic-windows-95-button"><button>Regresar</button></a>
            </div>
        </div>
    </body>
</html>
