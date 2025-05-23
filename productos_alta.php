<?php
include 'verificar_sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de producto</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="aesthetic.css">
        <link rel="stylesheet" href="productos_alta.css">
        <script src="jquery-3.7.1.min.js"></script>
        <script src="productos_alta.js"></script>
    </head>

    <body class="form-agregar">
        <div class="aesthetic-windows-95-modal modal">
            <div class="aesthetic-windows-95-modal-title-bar">
                <div class="aesthetic-windows-95-modal-title-bar-text">
                    <h1>Registrar producto</h1>
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
                <form id="form-producto" method="POST" action="productos_guardar.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="aesthetic-windows-95-text-input">
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea id="txtArea" rows="3" name="descripcion" class="aesthetic-windows-95-text-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Código</label>
                        <input type="number" name="codigo" id="codigo" class="aesthetic-windows-95-text-input" step="1" min="0">
                        <div id="codigo-error" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Costo</label>
                        <input id="costo" type="number" name="costo" class="aesthetic-windows-95-text-input" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label>Stock Inicial</label>
                        <input type="number" name="stock" id="stock" class="aesthetic-windows-95-text-input" step="1" min="0">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="imagen_producto">Imagen del Producto</label><br>
                            <input type="file" name="imagen_producto" id="imagen_producto" accept="image/*" class="aesthetic-windows-95-text-input">
                        </div>
                        <div>
                            <strong>Vista previa:</strong><br>
                            <img id="preview" src="" width="120" style="display: none; border: 1px solid #000; padding: 5px;">
                        </div>
                    </div>
                    <button type="submit" style="justify-content: space-between;" class="aesthetic-windows-95-button">Agregar <img src="trust0-0.png" style="height: 15px;" alt="guardar"></button>
                    <div id="form-error" class="error"></div>
                </form>
                <hr>
                <a href="productos_lista.php" class="aesthetic-windows-95-button"><button>Regresar</button></a>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>