<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "pauapp");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $id = intval($_POST["id"]);
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $apellidos = $conn->real_escape_string($_POST["apellidos"]);
    $correo = $conn->real_escape_string($_POST["correo"]);
    $rol = intval($_POST["rol"]);

    $campos_sql = "nombre='$nombre', apellidos='$apellidos', correo='$correo', rol=$rol";

    // Nueva contraseña
    if (!empty($_POST["pass"])) {
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
        $campos_sql .= ", pass='$pass'";
    }

    // Nueva imagen
    // Imagen personalizada
    if (!empty($_FILES['foto_personal']['name'])) {
        $foto_original = $_FILES['foto_personal']['name'];
        $ext = strtolower(pathinfo($foto_original, PATHINFO_EXTENSION));
        $foto_encriptado = uniqid() . ".jpg"; // Guardamos siempre como JPG
        $destino = "uploads/" . $foto_encriptado;
        $tmp_name = $_FILES['foto_personal']['tmp_name'];
    
        // Comprobar que sea imagen válida
        if (!@getimagesize($tmp_name)) {
            die("Archivo no es una imagen válida.");
        }
    
        list($ancho_orig, $alto_orig) = getimagesize($tmp_name);
    
        // Crear imagen fuente
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
    
        // Redimensionar con buena calidad
        $dst = imagecreatetruecolor(36, 36);
    
        // Activar suavizado para calidad máxima
        imageinterlace($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, 36, 36, $ancho_orig, $alto_orig);
    
        // Guardar con alta calidad
        imagejpeg($dst, $destino, 95); // calidad 95/100
    
        // Liberar memoria
        imagedestroy($src);
        imagedestroy($dst);
        $campos_sql .= ", archivo_nombre='$foto_original', archivo_file='$foto_encriptado'";

    } elseif (!empty($_POST['foto_default'])) {
        $foto_original = $_POST['foto_default'];
        $foto_encriptado = $_POST['foto_default'];
        $campos_sql .= ", archivo_nombre='$foto_original', archivo_file='$foto_encriptado'";
    }
    

    $sql = "UPDATE empleados SET $campos_sql WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: empleados_lista.php");
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $conn->close();
}
?>
