<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "pauapp");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $correo = $conn->real_escape_string(trim($_POST["correo"]));
    $pass = $_POST["pass"];

    $sql = "SELECT id, nombre, apellidos, correo, pass, eliminado FROM empleados WHERE correo = '$correo' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $empleado = $result->fetch_assoc();

        if ((int)$empleado['eliminado'] === 1) {
            echo "inactivo";
        } elseif (password_verify($pass, $empleado['pass'])) {
            // ✅ Crear sesión
            $_SESSION['usuario_id'] = $empleado['id'];
            $_SESSION['usuario_nombre'] = $empleado['nombre'];
            $_SESSION['usuario_apellidos'] = $empleado['apellidos'];
            $_SESSION['usuario_correo'] = $empleado['correo'];
            echo "ok";
        } else {
            echo "error"; // contraseña incorrecta
        }
    } else {
        echo "error"; // usuario no encontrado
    }

    $conn->close();
}
?>
