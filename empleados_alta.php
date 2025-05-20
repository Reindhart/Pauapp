<?php
include 'verificar_sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Alta de empleados</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="aesthetic.css">
        <link rel="stylesheet" href="empleados_alta.css">
        <script src="jquery-3.7.1.min.js"></script>
        <script src="empleados_alta.js"></script>
    </head>

    <body class="form-agregar">
        <div class="aesthetic-windows-95-modal modal">
            <div class="aesthetic-windows-95-modal-title-bar">
                <div class="aesthetic-windows-95-modal-title-bar-text">
                    <h1>Alta de empleado</h1>
                </div>
                <div class="aesthetic-windows-95-modal-title-bar-controls" style="justify-content: center;">
                    <a href="bienvenido.php" style="text-decoration: none;">
                        <div class="aesthetic-windows-95-button" style="height: 13px; width: 13px;">
                            <button style="display: flex; justify-content: center;">X</button>
                        </div>
                    </a>
                </div>
            </div>

            <div class="aesthetic-windows-95-modal-content">
                <form id="form-empleado" method="POST" action="empleados_guardar.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="aesthetic-windows-95-text-input">
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" class="aesthetic-windows-95-text-input">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" id="correo" class="aesthetic-windows-95-text-input">
                        <div id="correo-error" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="aesthetic-windows-95-text-input">
                    </div>
                    <label>Rol</label>
                    <div class="aesthetic-windows-95-select" style="margin-bottom: 10px;">
                        <select name="rol">
                            <option value="">Selecciona una opción</option>
                            <option value="1">Gerente</option>
                            <option value="2">Ejecutivo</option>
                        </select>
                        <div class="aesthetic-windows-95-select-checkmark">
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Imagen del empleado</label>

                        <!-- Campo oculto para enviar imagen default -->
                        <input type="hidden" name="foto_default" id="foto_default">

                        <!-- Botón que abre el dropdown -->
                        
                        <div id="dropdown-trigger" class="aesthetic-windows-95-select" style="width: 100%;">
                            Seleccionar imagen predeterminada
                            <div class="aesthetic-windows-95-select-checkmark">
                            </div>
                        </div>

                        <!-- Galería visual (dropdown) -->
                        <div id="dropdown-gallery" class="gallery-container">
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                                <div class="img-option aesthetic-effect-crt" data-img="" style="text-align: center; border: 2px solid #ccc; padding: 5px; cursor: pointer;">
                                    <img src="no2-0.png" width="80"><br>
                                    <small>Ninguna</small>
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

                        <!-- Opción personalizada -->
                        <div style="margin-top: 20px;">
                            <label for="foto_personal">O subir una imagen personalizada:</label><br>
                            <input type="file" name="foto_personal" id="foto_personal" accept="image/*" class="aesthetic-windows-95-text-input">
                        </div>

                        <!-- Preview -->
                        <div style="margin-top: 10px;">
                            <strong>Vista previa:</strong><br>
                            <img id="preview" src="" width="120" style="display: none; border: 1px solid #000; padding: 5px;">
                        </div>
                    </div>

                    
                    <button type="submit" style="justify-content: space-between;" class="aesthetic-windows-95-button">Agregar <img src="trust0-0.png" style="height: 15px;" alt="guardar"></button>
                    <div id="form-error" class="error"></div>
                </form>
                <hr>
                <a href="empleados_lista.php" class="aesthetic-windows-95-button"><button>Regresar</button></a>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>