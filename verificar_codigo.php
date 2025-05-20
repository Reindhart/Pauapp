<?php
if (isset($_POST['correo'])) {
    $conn = new mysqli("localhost", "root", "", "pauapp");
    if ($conn->connect_error) {
        echo "error";
        exit;
    }

    $codigo = $conn->real_escape_string($_POST['codigo']);
    $excluir = isset($_POST['excluir_id']) ? intval($_POST['excluir_id']) : 0;

    $sql = "SELECT id FROM productos WHERE codigo = '$codigo' AND eliminado = 0";
    if ($excluir > 0) {
        $sql .= " AND id != $excluir";
    }

    $res = $conn->query($sql);
    echo ($res->num_rows > 0) ? 'existe' : 'ok';
    $conn->close();
}
?>
