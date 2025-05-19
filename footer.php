<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nombre = $_SESSION['usuario_nombre'] ?? 'Empleado';
$apellidos = $_SESSION['usuario_apellidos'] ?? '';
?>
<link rel="stylesheet" href="footer.css">
<footer class="taskbar aesthetic-windows-95-container">
    <div class="taskbar-left">
        <div class="aesthetic-windows-95-button">
            <button><img src="windows-0.png" alt="Windows 98" class="start-icon"> Start</button>
        </div>
        <span>| <?= htmlspecialchars("$nombre $apellidos") ?></span>
    </div>
    <div class="taskbar-right">
        <form id="logout-form" action="logout.php" method="POST" style="display: inline;">
            <button type="submit" class="logout-button aesthetic-windows-95-button">Cerrar Sesión</button>
        </form>
    </div>
</footer>