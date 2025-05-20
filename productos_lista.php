<?php
include 'verificar_sesion.php';
$conn = new mysqli("localhost", "root", "", "pauapp");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM productos WHERE eliminado = 0");
$eliminados = $conn->query("SELECT * FROM productos WHERE eliminado = 1");
$ruta_imagen = "productos/";

$num_productos = $result->num_rows;
?>
                        
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Productos</title>
        <link rel="stylesheet" href="aesthetic.css">
        <link rel="stylesheet" href="productos_lista.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <script src="jquery-3.7.1.min.js"></script>
        <script src="productos_lista.js"></script> 
    </head>

    <body>
        <section class="container">
            <div class="aesthetic-windows-95-modal modal">
                <div class="aesthetic-windows-95-modal-title-bar">
                    <div class="aesthetic-windows-95-modal-title-bar-text">
                        <h1>Listado de productos (<?php echo $num_productos; ?>)</h1>
                    </div>
                    <div class="aesthetic-windows-95-modal-title-bar-controls">
                        <a href="productos_alta.php">
                            <div class="aesthetic-windows-95-button">
                                <button>Crear nuevo registro</button>
                            </div>
                        </a>
                    </div>
                    <div class="aesthetic-windows-95-modal-title-bar-controls" style="margin-left: 10px;">
                        <a href="bienvenido.php">
                            <div class="aesthetic-windows-95-button">
                                <button>X</button>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="aesthetic-windows-95-modal-content">
                    <hr />
                    <div class="aesthetic-windows-95-container-indent">
                        <div class="table-container">
                            <table class="productos-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Costo</th>
                                        <th>Stock</th>
                                        <th>Ver detalle</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($num_productos > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["codigo"] . "</td>";
                                            echo "<td>" . number_format($row["costo"], 2) . "</td>";
                                            echo "<td>" . $row["stock"] . "</td>";
                                            echo "<td><a href='productos_detalle.php?id={$row["id"]}' class='aesthetic-windows-95-button-title-bar'><img src='address_book_user.png' class='detalles-btn' alt='detalles{$row["id"]}'></a></td>";
                                            echo "<td><a href='productos_editar.php?id={$row["id"]}' class='aesthetic-windows-95-button-title-bar'><img src='address_book_pad.png' class='detalles-btn' alt='editar{$row["id"]}'></a></td>";
                                            echo "<td><button class='aesthetic-windows-95-button-title-bar delete-btn' data-id='{$row["id"]}'><img src='msg_error-0.png' alt='eliminar{$row["id"]}'></button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No hay productos registrados</td></tr>";
                                    }
                                    if ($eliminados->num_rows > 0) {
                                        echo "<tr><td colspan='9' class='aesthetic-windows-95-title-bar'>Productos eliminados</td></tr>";
                                        while ($row = $eliminados->fetch_assoc()) {
                                            $rol_texto = ($row["rol"] == 1) ? "Gerente" : "Ejecutivo";
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["codigo"] . "</td>";
                                            echo "<td>" . number_format($row["costo"], 2) . "</td>";
                                            echo "<td>" . $row["stock"] . "</td>";
                                            echo "<td><a href='productos_detalle.php?id={$row["id"]}' class='aesthetic-windows-95-button-title-bar'><img src='address_book_user.png' class='detalles-btn' alt='detalles{$row["id"]}'></a></td>";
                                            echo "<td><a href='productos_editar.php?id={$row["id"]}' class='aesthetic-windows-95-button-title-bar'><img src='address_book_pad.png' class='detalles-btn' alt='editar{$row["id"]}'></a></td>";
                                            echo "<td><button class='btn-blocked'><img src='no2-0.png' alt='blocked'></button></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>

<?php
$conn->close();
?>