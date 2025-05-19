<?php
if (!isset($_GET['id'])) {
    header("Location: empleados_lista.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "pauapp");
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM empleados WHERE id = $id");

if ($result->num_rows === 0) {
    echo "Empleado no encontrado.";
    exit;
}

$emp = $result->fetch_assoc();

$foto_actual = isset($emp['archivo_file']) ? $emp['archivo_file'] : null;
$ruta_imagen = '';

if (!$foto_actual) {
    $ruta_imagen = "no2-0.png";
} elseif (file_exists("uploads/defaults/$foto_actual")) {
    $ruta_imagen = "uploads/defaults/$foto_actual";
} elseif (file_exists("uploads/$foto_actual")) {
    $ruta_imagen = "uploads/$foto_actual";
} else {
    $ruta_imagen = "no2-0.png";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Edición de empleados</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="aesthetic.css">
        <link rel="stylesheet" href="editar.css">
        <script src="jquery-3.7.1.min.js"></script>
        <script src="editar.js"></script>
    </head>
    <body class="aesthetic-font form-editar">
        <div class="aesthetic-windows-95-modal">
            <div class="aesthetic-windows-95-modal-title-bar">
                <div class="aesthetic-windows-95-modal-title-bar-text">
                    <h1>Edición de empleados</h1>
                </div>
            </div>
            <div class="aesthetic-windows-95-modal-content">
                <form id="form-edit" method="POST" action="empleados_actualizar.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?= $emp['nombre'] ?>" class="aesthetic-windows-95-text-input">
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" value="<?= $emp['apellidos'] ?>" class="aesthetic-windows-95-text-input">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" id="correo" value="<?= $emp['correo'] ?>" class="aesthetic-windows-95-text-input">
                        <div id="correo-error" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Nueva contraseña (opcional)</label>
                        <input type="password" name="pass" class="aesthetic-windows-95-text-input">
                    </div>
                    <label>Rol</label>
                    <div class="aesthetic-windows-95-select" style="margin-bottom: 10px;">
                        <select name="rol">
                            <option value="1" <?= $emp['rol'] == 1 ? 'selected' : '' ?>>Gerente</option>
                            <option value="2" <?= $emp['rol'] == 2 ? 'selected' : '' ?>>Ejecutivo</option>
                        </select>
                        <div class="aesthetic-windows-95-select-checkmark">
                        </div>
                    </div>

                    <div class="form-group">
                    <label>Imagen del empleado</label>

                    <input type="hidden" name="foto_default" id="foto_default">

                    <div id="dropdown-trigger" class="aesthetic-windows-95-select" style="width: 100%;">
                        Seleccionar imagen predeterminada
                        <div class="aesthetic-windows-95-select-checkmark">
                        </div>
                    </div>

                    <div id="dropdown-gallery" class="gallery-container">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                            <div class="img-option aesthetic-effect-crt" data-img="" style="text-align: center; border: 2px solid #ccc; padding: 5px; cursor: pointer;">
                                <img src="no2-0.png" width="80"><br>
                                <small>Actual</small>
                            </div>

                            <?php
                            $default_dir = "uploads/defaults/";
                            $imagenes = array_diff(scandir($default_dir), ['.', '..']);
                            foreach ($imagenes as $img): ?>
                                <div class="img-option aesthetic-effect-crt" data-img="<?= $img ?>" style="text-align: center; border: 2px solid #ccc; padding: 5px; cursor: pointer;">
                                    <img src="<?= $default_dir . $img ?>" width="80"><br>
                                    <small><?= $img ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <label for="foto_personal">O subir una imagen personalizada:</label><br>
                        <input type="file" name="foto_personal" id="foto_personal" accept="image/*" class="aesthetic-windows-95-text-input">
                    </div>

                    <div style="margin-top: 10px;">
                        <strong>Vista previa:</strong><br>
                        <img id="preview" src="<?= $ruta_imagen ?>" width="120" style="display: block; border: 1px solid #000; padding: 5px;">
                    </div>
                </div>
                    <button type="submit" class="aesthetic-windows-95-button" style="justify-content: space-between;">Guardar<img src="floppy.png" style="height: 15px;" alt="guardar"></button>
                    <div id="form-error" class="error"></div>
                </form>
                <hr>
                <a href="empleados_lista.php" class="aesthetic-pepsi-blue-color">Regresar</a>
            </div>
        </div>
    </body>
</html>
