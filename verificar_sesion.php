<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['flash_error'] = "Permiso denegado. Inicia sesión primero.";
    header("Location: index.php");
    exit;
}
?>
