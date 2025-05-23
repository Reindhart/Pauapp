<?php
// Verificamos si se recibió un valor válido
if (!isset($_POST['numero']) || !is_numeric($_POST['numero']) || $_POST['numero'] <= 0) {
    echo "<p style='color:red;'>Error: Debes enviar un número mayor a 0 desde el formulario.</p>";
    echo "<a href='formulario.php'>Volver al formulario</a>";
    exit;
}

$n = intval($_POST['numero']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tabla Generada</title>
  <style>
    table {
      border-collapse: collapse;
      width: 200px;
    }
    td, th {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>Tabla de <?php echo $n; ?> filas</h1>
  <table>
    <?php
      for ($i = 1; $i <= $n; $i++) {
        echo "<tr><td>$i</td></tr>";
      }
    ?>
  </table>
  <br>
  <a href="formulario.php">Volver al formulario</a>
</body>
</html>
