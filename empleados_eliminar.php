<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $conn = new mysqli("localhost", "root", "", "pauapp");

    if ($conn->connect_error) {
        http_response_code(500);
        echo "error";
        exit;
    }

    $id = intval($_POST["id"]);
    $sql = "UPDATE empleados SET eliminado = 1 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "ok";
    } else {
        echo "error";
    }

    $conn->close();
} else {
    echo "invalid";
}
?>