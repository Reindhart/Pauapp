<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "pauapp");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $nombre = trim($conn->real_escape_string($_POST['nombre']));
    $descripcion = trim($conn->real_escape_string($_POST['descripcion']));
    
    $codigo = filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
    $costo_raw = $_POST['costo'];
    $costo = number_format((float)$costo_raw, 2, '.', '');

    if (!$nombre || !$descripcion || $codigo === false || $stock === false || $costo < 0) {
        die("Datos inválidos. Verifica que todos los campos estén llenos y correctamente formateados.");
    }

    $foto_encriptado = "";
    $foto_original = "";

    if (!empty($_FILES['imagen_producto']['name'])) {
        $foto_original = $_FILES['imagen_producto']['name'];
        $ext = strtolower(pathinfo($foto_original, PATHINFO_EXTENSION));
        $foto_encriptado = uniqid() . ".jpg";
        $destino = "uploads/" . $foto_encriptado;
        $tmp_name = $_FILES['imagen_producto']['tmp_name'];
    
        $mime = mime_content_type($tmp_name);
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mime, $tipos_permitidos)) {
            die("Formato MIME no permitido ($mime).");
        }
        
        list($ancho_orig, $alto_orig) = getimagesize($tmp_name);
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $src = imagecreatefromjpeg($tmp_name);
                break;
            case 'png':
                $src = imagecreatefrompng($tmp_name);
                break;
            case 'gif':
                $src = imagecreatefromgif($tmp_name);
                break;
            case 'webp':
                if (function_exists('imagecreatefromwebp')) {
                    $src = imagecreatefromwebp($tmp_name);
                } else {
                    die("Tu servidor no soporta imágenes WebP.");
                }
                break;
            default:
                die("Formato de imagen no soportado.");
        }
    
        $dst = imagecreatetruecolor($ancho_orig, $alto_orig);
        imagecopy($dst, $src, 0, 0, 0, 0, $ancho_orig, $alto_orig);
        imageinterlace($dst, true);
        imagejpeg($dst, $destino, 95);

        imagedestroy($src);
        imagedestroy($dst);
    } else {
        die("Debes seleccionar o subir una imagen.");
    }

    $sql = "INSERT INTO productos (nombre, codigo, descripcion, costo, stock, archivo_n, archivo)
            VALUES ('$nombre', $codigo, '$descripcion', $costo, $stock, '$foto_original', '$foto_encriptado')";

    if ($conn->query($sql) === TRUE) {
        header("Location: productos_lista.php");
        exit;
    } else {
        echo "Error al guardar: " . $conn->error;
    }

    $conn->close();
}
?>
