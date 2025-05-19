<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Empleados</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="aesthetic.css">
    <link rel="stylesheet" href="login.css">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="login.js"></script>
    <style>
        
    </style>
</head>
<body class="aesthetic-font form-login">
        <div class="aesthetic-windows-95-modal detalle-modal">
            <div class="aesthetic-windows-95-modal-title-bar">
                <div class="aesthetic-windows-95-modal-title-bar-text">
                    <h2>Iniciar Sesión</h2>
                </div>
            </div>
            <div class="aesthetic-windows-95-modal-content">
            <form id="form-login">
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" id="correo" class="aesthetic-windows-95-text-input">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" id="pass" class="aesthetic-windows-95-text-input">
                </div>
                <div id="mensaje" class="error"></div>
                <button type="submit" style="justify-content: space-between;" class="aesthetic-windows-95-button"> <img src="keys-1.png" alt="">Ingresar</button>
            </form>
            </div>
        </div>
    </body>
</html>
