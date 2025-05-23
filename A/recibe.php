<?php
$carreras = [
    "1" => "Ing. Informática",
    "2" => "Ing. Computación"
];

$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$boletin = isset($_POST['boletin']) ? 'Sí' : 'No';
$comentario = $_POST['comentario'] ?? '';
$carrera = $_POST['carrera'] ?? '0';
$pasw = $_POST['pasw'] ?? '';
$promedio = $_POST['promedio'] ?? '';
$fecha = $_POST['fecha'] ?? '';

echo "<h1>Información recibida</h1>";
echo "<strong>Nombre:</strong> $nombre<br>";
echo "<strong>Correo:</strong> $correo<br>";
echo "<strong>Género:</strong> " . ($sexo == 'F' ? 'Femenino' : 'Masculino') . "<br>";
echo "<strong>Boletín:</strong> $boletin<br>";
echo "<strong>Comentario:</strong> $comentario<br>";
echo "<strong>Carrera:</strong> " . ($carreras[$carrera] ?? 'No seleccionada') . "<br>";
echo "<strong>Contraseña:</strong> $pasw<br>";
echo "<strong>Promedio:</strong> $promedio<br>";
echo "<strong>Fecha de nacimiento:</strong> $fecha<br>";
?>
