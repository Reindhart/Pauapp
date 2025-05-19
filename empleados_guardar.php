<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "pauapp");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellidos = $conn->real_escape_string($_POST['apellidos']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $rol = intval($_POST['rol']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $foto_encriptado = "";
    $foto_original = "";

    if (!empty($_FILES['foto_personal']['name'])) {
        $foto_original = $_FILES['foto_personal']['name'];
        $ext = strtolower(pathinfo($foto_original, PATHINFO_EXTENSION));
        $foto_encriptado = uniqid() . ".jpg";
        $destino = "uploads/" . $foto_encriptado;
        $tmp_name = $_FILES['foto_personal']['tmp_name'];
    
        // Comprobar que sea imagen válida
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
    
        // Guardar imagen con suavizado para mayor calidad
        $dst = imagecreatetruecolor(36, 36);
        imageinterlace($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, 36, 36, $ancho_orig, $alto_orig);    
        imagejpeg($dst, $destino, 95);
    
        // Liberar memoria
        imagedestroy($src);
        imagedestroy($dst);
    }
    elseif (!empty($_POST['foto_default'])) {
        $foto_original = $_POST['foto_default'];
        $foto_encriptado = $_POST['foto_default'];
    }
    else {
        die("Debes seleccionar o subir una imagen.");
    }

    $sql = "INSERT INTO empleados (nombre, apellidos, correo, pass, rol, archivo_nombre, archivo_file)
            VALUES ('$nombre', '$apellidos', '$correo', '$pass', $rol, '$foto_original', '$foto_encriptado')";

    if ($conn->query($sql) === TRUE) {
        header("Location: empleados_lista.php");
        exit;
    } else {
        echo "Error al guardar: " . $conn->error;
    }

    $conn->close();
}
?>